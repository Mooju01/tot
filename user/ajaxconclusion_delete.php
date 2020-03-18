<?php
include '../connect.php';
session_start();
$type=$_POST['type'];
$_SESSION['type']=$type;
$_SESSION['route']=$_POST['route'];
$_SESSION['tel']=$_POST['tel'];
?>
<div class="form-group">
    <div class="row justify-content-center">
          <?php
            if($type=='emp'){
              ?>
              <h3>ข้อมูลพนักงาน</h3>
              <?php
            }else if($type=='hotel'){
              ?>
              <h3>ข้อมูลหอพัก/โรงแรม</h3>
              <?php
            }else if($type=='private'){
              ?>
              <h3>ข้อมูลเบอร์ประจำชั้น</h3>
              <?php
            }
          ?>
    </div>
</div>
<?php
  if($type=='emp'){
    $_SESSION['emp_id']=$_POST['emp_id'];    
    $_SESSION['type_phone']=$_POST['type_phone'];
    //search employee
    $sql=$mysqli->query("SELECT *
                        FROM employee
                        INNER JOIN center
                        ON employee.center_id=center.center_id
                        WHERE emp_id='".$_SESSION['emp_id']."'");
    $result=$sql->num_rows;
    $emp_info=array();
    if($result>0){
      for($i=0;$i<$result;$i++){
        $row=$sql->fetch_assoc();
        array_push($emp_info,$row);
      }
    }else{
      echo 'ไม่พบข้อมูล';
    }
    ?>
    <div class="form-group">
      <?php
      foreach($emp_info as $value){
      ?>
        <div class="row">
          <div class="col-2">
          </div>
          <div class="col-5">
            รหัสพนักงาน : <?=$value['emp_id'];?>
          </div>
          <div class="col-5">
            ชื่อพนักงาน : <?=$value['emp_name'];?>
          </div>
        </div>
        <div class="row">
          <div class="col-2">
          </div>
          <div class="col-5">
            อีเมล์ : <?=$value['emp_email'];?>
          </div>
          <div class="col-5">
                รหัสตำแหน่ง : <?=$value['position_code'];?>
          </div>
        </div>
        <div class="row">
          <div class="col-2">
          </div>
          <div class="col-5">
            ส่วนงานที่สังกัด : <?=$value['div_code'];?>
          </div>
          <div class="col-5">
            สถานที่นั่ง : <?=$value['location'];?>
          </div>
        </div>
        <div class="row">
          <div class="col-2">
          </div>
          <div class="col-5">
            เบอร์โทร: <?=$_SESSION['tel'];?>
          </div>
        </div>
      <?php
      }
      ?>
      
    </div>
    <?php
  }elseif($type=='hotel'){
    $_SESSION['hotel_id']=$_POST['hotel_id'];
    $_SESSION['hotel_no']=$_POST['hotel_no'];
    $_SESSION['hotel_name']=$_POST['hotel_name'];
    ?>
    <div class="form-group">
      <div class="row">
          <div class="col-3">
          </div>
          <div class="col-4">
              ชื่ออาคาร : <?=$_SESSION['hotel_name'];?>
          </div>
          <div class="col-5">
              เบอร์ห้อง : <?=$_SESSION['hotel_no'];?>
          </div>
      </div>
      <div class="row">
          <div class="col-3">
          </div>
          <div class="col-4">
              เบอร์โทร : <?=$_SESSION['tel'];?>
          </div>
      </div>
    </div>               
    <?php
  }else{
    $_SESSION['p_id']=$_POST['p_id'];
    $_SESSION['location']=$_POST['location'];
    $_SESSION['type_phone']=$_POST['type_phone'];
    ?>
    <div class="form-group">
      <div class="row">
          <div class="col-2">
          </div>
          <div class="col-5">
              ชื่ออาคาร : <?=$_SESSION['location'];?>
          </div>
          <div class="col-5">
              เบอร์โทร : <?=$_SESSION['tel'];?>
          </div>
      </div>
    </div>               
    <?php
  }
?>
<hr>
<?php
    if($_SESSION['type_phone']!='ipphone'){
      //search map
      $sql=$mysqli->query("SELECT *
                          FROM route_tel
                          WHERE route='".$_SESSION['route']."' ");
      $labelpri=array();
      $slotpri=array();
      $labelsec=array();
      $slotsec=array();
      while($row=$sql->fetch_assoc()){
      if($row['type']=='pt' || $row['type']=='tt'){
      array_push($labelpri,$row['label']);
      array_push($slotpri,$row['slot']);
        if($row['type']=='tt'){
          $memo=$row['memo'];
        }
      }else{
      array_push($labelsec,$row['label']);
      array_push($slotsec,$row['slot']);
      }
      }
      //search location
      $sql=$mysqli->query("SELECT equipment.location FROM route_tel
          INNER JOIN equipment
          ON route_tel.eq_id=equipment.eq_id
          WHERE route_tel.route='".$_SESSION['route']."' 
          GROUP BY route_tel.eq_id
          ORDER BY route_tel.eq_id ASC");
      $location=array();
      while($row=$sql->fetch_assoc()){
      array_push($location,$row['location']);
      }
    }
    ?>
    <?php
      if($_SESSION['type_phone']!='ipphone'){
      ?>
        <div class="form-group">
            <div class="row justify-content-center">
                    <h3>เส้นทาง</h3>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-4 head_title">
                    สถานที่
                </div>
                <div class="col-4 head_title">
                    Terminal Primary
                </div>
                <div class="col-4 head_title">
                    Terminal Secondary
                </div>
            </div>
        </div>
    <form action="updatedeletetel.php" method="post" id="frm_delete_tel">
    <?php
      foreach($location as $key=>$value){
        ?>
            <div class="form-group">
                <div class="row" style="height:60%;">
                    <div class="col-4 location_name"> 
                      <?=$location[$key];?>
                      <input type="hidden" name="location[]" value="<?=$location[$key];?>"/>
                    </div>
                    <div class="col-4" >
                    <?php 
                        if(isset($labelpri[$key])){
                            echo $labelpri[$key]."/ slot :".$slotpri[$key];
                    ?>
                            <input type="hidden" name="labelpri[]" value="<?=$labelpri[$key];?>"/>
                            <input type="hidden" name="slotpri[]" value="<?=$slotpri[$key];?>"/>
                    <?php
                        }
                    ?>
                    </div>
                    <div class="col-4">
                    <?php 
                        if(isset($labelsec[$key])){
                            echo $labelsec[$key]."/ slot :".$slotsec[$key];
                            ?>
                            <input type="hidden" name="labelsec[]" value="<?=$labelsec[$key];?>"/>
                            <input type="hidden" name="slotsec[]" value="<?=$slotsec[$key];?>"/>
                            <?php
                        }else{
                          echo $memo;
                          ?>
                          <input type="hidden" name="memo" value="<?=$slotsec[$key];?>"/>
                          <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
        <?php
      }
      }
  ?>
<?php
//if($type=='emp'){
?>
  <!-- <div class="form-group">
    <div class="row justify-content-center">
          <div class="custom-control custom-radio mb-6">
            <input name="radio_check" class="custom-control-input" id="customRadio1" type="radio" value="all">
            <label class="custom-control-label" for="customRadio1">ลบเบอร์และพนักงาน</label>
          </div>
          &emsp;
          <div class="custom-control custom-radio mb-6">
            <input name="radio_check" class="custom-control-input" id="customRadio2" type="radio" value="onlytel">
            <label class="custom-control-label" for="customRadio2">ลบเฉพาะเบอร์</label>
          </div>
    </div>
  </div> -->
<?php
//}
?>
  <div id="show_result_delete"></div>                     
    <hr/>
  <div class="form-group">
    <div class="row justify-content-center">
            <button type="button" class="btn btn-facebook" data-dismiss="modal" >ยกเลิก</button>
            <button type="button" class="btn btn-danger" onclick="chkConfirm();">ลบ</button>
    </div>
  </div>
  </form>
  <?php

?>




