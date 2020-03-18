<?php
include '../connect.php';
session_start();
?>
<div class="form-group">
    <div class="row justify-content-center">
        <h3>ข้อมูลพนักงาน</h3>
    </div>
</div>
<?php
    $_SESSION['emp_id']=$_POST['emp_id'];    
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

    //search tel emp
    $sql=$mysqli->query("SELECT emp_tel.tel,emp_tel.route,emp_tel.type_phone
                        FROM employee
                        INNER JOIN emp_tel
                        ON employee.emp_id=emp_tel.emp_id
                        WHERE employee.emp_id='".$_SESSION['emp_id']."'
                        ORDER BY emp_tel.type_phone ASC");
    $total_tel=$sql->num_rows;
    $tel_info=array();
    while($row=$sql->fetch_assoc()){
        array_push($tel_info,$row);
    }
    $_SESSION['tel_info']=$tel_info;
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
              <?php
              if($total_tel>0){
                ?>
                จำนวนเบอร์โทรศัพท์ที่ใช้งานอยู่ <?=$total_tel;?> เบอร์
                <?php
              }else{
                ?>
                ไม่มีเบอร์โทรศัพท์ที่ใช้งานอยู่
                <?php
              }
              ?>
            
          </div>
        </div>
      <?php
      }
      ?>
    </div>
<hr>
<form action="updatedeletetel.php" method="post" id="frm_delete_tel">
<?php
    if($total_tel>0){
        foreach($tel_info as $key=>$value){
            ?>
            เบอร์โทรศัพท์ : <?=$value['tel'];?>&nbsp;&nbsp;&nbsp;
            <?php
            if($value['type_phone']!='ipphone'){
                ?>
                ประเภทโทรศัพท์ : เบอร์ธรรมดา
                <?php
                $sql=$mysqli->query("SELECT *
                                    FROM route_tel
                                    WHERE route='".$value['route']."' ");
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
                

                $sql=$mysqli->query("SELECT equipment.location 
                                    FROM route_tel
                                    INNER JOIN equipment
                                    ON route_tel.eq_id=equipment.eq_id
                                    WHERE route_tel.route='".$value['route']."' 
                                    GROUP BY route_tel.eq_id
                                    ORDER BY route_tel.eq_id ASC");
                $location=array();
                while($row=$sql->fetch_assoc()){
                    array_push($location,$row['location']);
                }
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
                    
            }else{
                ?>
                ประเภทโทรศัพท์ : IP Phone
                <?php
            }?>
            <hr>
            <?php
        }
    }
    ?>
<div id="show_result_delete"></div>                     
  <div class="form-group">
    <div class="row justify-content-center">
            <button type="button" class="btn btn-facebook" data-dismiss="modal" >ยกเลิก</button>
            <button type="button" class="btn btn-danger" onclick="chkConfirm();">ลบ</button>
    </div>
  </div>
</form>



