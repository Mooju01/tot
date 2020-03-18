<?php
include '../connect.php';
session_start();
$type=$_POST['type'];
$_SESSION['type']=$type;
?>
<div class="form-group">
    <div class="row justify-content-center">
          <?php
          if(isset($type)){
            if($type=='emp'){
              ?>
              <h3>สรุปการเพิ่มเบอร์พนักงาน</h3>
              <?php
            }
            elseif($type=='hotel'){
              ?>
              <h3>สรุปการเพิ่มเบอร์หอพัก/โรงแรม</h3>
              <?php
            }
            elseif($type=='private'){
              ?>
              <h3>สรุปการเพิ่มเบอร์เบอร์ประจำชั้น</h3>
              <?php
            }
          }
          ?>
    </div>
</div>
<?php
  if($type=='emp'){
    //----------------------------------------------เบอร์พนักงาน------------------------------------------------------
    $location=isset($_POST['location_root'])?$_POST['location_root']:NULL;
    $eq_id=isset($_POST['eq_id'])?$_POST['eq_id']:NULL;
    $selectlabelpri=isset($_POST['selectlabelpri'])?$_POST['selectlabelpri']:NULL;
    $selectslotpri=isset($_POST['selectslotpri'])?$_POST['selectslotpri']:NULL;
    $selectlabelsec=isset($_POST['selectlabelsec'])?$_POST['selectlabelsec']:NULL;
    $selectslotsec=isset($_POST['selectslotsec'])?$_POST['selectslotsec']:NULL;
    $memo=isset($_POST['memo'])?$_POST['memo']:NULL;
    if($_SESSION['type_phone']=='ipphone'){
      $_SESSION['tel']=$_POST['tel'];
    }
?>
<form action="save_newtel.php" method="post">
<div class="form-group">
              <?php
              foreach($_SESSION['emp_info'] as $value){
              ?>
              <div class="row">
                <div class="col-3">
                </div>
                <div class="col-4">
                  <span class="info-around">รหัสพนักงาน : <?=$value['emp_id'];?></span> 
                </div>
                <div class="col-5">
                <span class="info-around">ชื่อพนักงาน : <?=$value['emp_name'];?></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">อีเมล์ : <?=$value['emp_email'];?></span> 
                </div>
                <div class="col-5">
                <span class="info-around">ส่วนงานที่สังกัด : <?=$value['div_code'];?></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">สถานที่นั่ง : <?=$value['location'];?></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">เบอร์โทร: <?=$_SESSION['tel'];?></span> 
                </div>
              </div>
              <?php
              }
              ?>
              <hr>
                    </div>
<?php
  if($_SESSION['type_phone']!='ipphone'){
  ?>
  <div class="row justify-content-center">
      <h3>เส้นทาง</h3>
  </div>
  <div class="row">
    <div class="col-4 head_title">
      สถานที่
    </div>
    <div class="col-4 head_title">
    Primary Terminal
    </div>
    <div class="col-4 head_title">
    Secondary Terminal
    </div>
  </div>
<?php
foreach($location as $key=>$value){
    ?>
        <div class="form-group">
            <div class="row" style="height:60%;">
                <div class="col-4 location_name"> 
                  <?=$location[$key];?>
                  <input type="hidden" name="eq_id[]" value="<?=$eq_id[$key];?>">
                </div>
                <div class="col-4" >
                <?php 
                    if(isset($selectlabelpri[$key])){
                ?>
                        <span class="label_slot"><?=$selectlabelpri[$key];?>/slot :<?=$selectslotpri[$key];?></span>
                        <input type="hidden" name="selectlabelpri[]" value="<?=$selectlabelpri[$key];?>"/>
                        <input type="hidden" name="selectslotpri[]" value="<?=$selectslotpri[$key];?>"/>
                <?php
                    }
                ?>
                </div>
                <div class="col-4">
                <?php 
                    if(isset($selectlabelsec[$key])){
                        ?>
                        <span class="label_slot"><?=$selectlabelsec[$key];?>/slot :<?=$selectslotsec[$key];?></span>
                        <input type="hidden" name="selectlabelsec[]" value="<?=$selectlabelsec[$key];?>"/>
                        <input type="hidden" name="selectslotsec[]" value="<?=$selectslotsec[$key];?>"/>
                        <?php
                    }else{
                      ?>
                      <span class="label_slot"><?=$memo;?></span>
                      <input type="hidden" name="memo" value="<?=$memo;?>"/>
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
if($_SESSION['type_phone']=='ipphone'){
  $thispage='block_conclusion';
  $backpage='1';
}elseif($_SESSION['type_phone']=='normal_tel'){
  $thispage='block_conclusion';
  $backpage='block_telecom';
}else{
  ?>
  <hr>
  <div class="row justify-content-center">
      <h3>การดำเนินการ</h3>
  </div>
  <div class="row">
    <div class="col-4 head_title">
      สถานที่
    </div>
    <div class="col-4 head_title">
    Primary Terminal
    </div>
    <div class="col-4 head_title">
    Secondary Terminal
    </div>
  </div>
  <?php
  for($i=$_SESSION['check'];$i<count($location);$i++){
    ?>
    <div class="form-group">
            <div class="row" style="height:60%;">
                <div class="col-4 location_name"> 
                  <?=$location[$i];?>
                </div>
                <div class="col-4" >
                <?php 
                    if(isset($selectlabelpri[$i])){
                        ?>
                        <span class="label_slot"><?=$selectlabelpri[$i];?>/slot :<?=$selectslotpri[$i];?></span>
                        <?php
                    }
                ?>
                </div>
                <div class="col-4">
                <?php 
                    if(isset($selectlabelsec[$i])){
                        ?>
                        <span class="label_slot"><?=$selectlabelsec[$i];?>/slot :<?=$selectslotsec[$i];?></span>
                        <?php
                    }else{
                      ?>
                      <span class="label_slot"><?=$memo;?></span>
                      <?php
                    }
                ?>
                </div>
            </div>
    </div>
    <?php
  }

  $thispage=isset($_POST['thispage'])?$_POST['thispage']:NULL;
  $backpage=isset($_POST['oldpage'])?$_POST['oldpage']:NULL;
}
?>
<div class="form-group">
    <div class="row justify-content-center">
            <button type="button" class="btn btn-facebook" onclick="backpage('<?=$thispage;?>','<?=$backpage;?>')">ย้อนกลับ</button>
            <button type="submit" class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกหรือไม่ ?');">บันทึก</button>
    </div>
</div>
</form>
    <?php
  }else if($type=='hotel'){
    //----------------------------------------------เบอร์โรงแรม-------------------------------------------------------
      $location=isset($_POST['location_root'])?$_POST['location_root']:NULL;
      $eq_id=isset($_POST['eq_id'])?$_POST['eq_id']:NULL;
      $selectlabelpri=isset($_POST['selectlabelpri'])?$_POST['selectlabelpri']:NULL;
      $selectslotpri=isset($_POST['selectslotpri'])?$_POST['selectslotpri']:NULL;
      $selectlabelsec=isset($_POST['selectlabelsec'])?$_POST['selectlabelsec']:NULL;
      $selectslotsec=isset($_POST['selectslotsec'])?$_POST['selectslotsec']:NULL;
      $memo=isset($_POST['memo'])?$_POST['memo']:NULL;
      if($_SESSION['type_phone']=='ipphone'){
        $_SESSION['tel']=$_POST['tel'];
      }
  ?>
  
  <div class="form-group">
    <div class="row">
      <div class="col-3">
      </div>
      <div class="col-4">
        <span class="info-around">ชื่ออาคาร : <?=$_SESSION['location'];?></span>
      </div>
      <div class="col-5">
        <span class="info-around">เบอร์ห้อง : <?=$_SESSION['hotel_no'];?></span>
      </div>
    </div>
    <div class="row">
      <div class="col-3">
      </div>
      <div class="col-4">
        <span class="info-around">เบอร์โทร : <?=$_SESSION['tel'];?></span>
      </div>
    </div>
  </div>

  <hr/>
  <div class="form-group">
    <div class="row justify-content-center">
        <h3>เส้นทาง</h3>
    </div>
    <div class="row">
      <div class="col-4 head_title">
        สถานที่
      </div>
      <div class="col-4 head_title">
        Primary Terminal
      </div>
      <div class="col-4 head_title">
        Secondary Terminal
      </div>
    </div>
  </div>
  <form action="save_newtel.php" method="post">
  <?php
  foreach($location as $key=>$value){
      ?>
          <div class="form-group">
              <div class="row" style="height:60%;">
                  <div class="col-4 location_name"> 
                    <?=$location[$key];?>
                    <input type="hidden" name="eq_id[]" value="<?=$eq_id[$key];?>">
                  </div>
                  <div class="col-4" >
                  <?php 
                      if(isset($selectlabelpri[$key])){
                  ?>
                          <span class="label_slot"><?=$selectlabelpri[$key];?>/slot :<?=$selectslotpri[$key];?></span>
                          <input type="hidden" name="selectlabelpri[]" value="<?=$selectlabelpri[$key];?>"/>
                          <input type="hidden" name="selectslotpri[]" value="<?=$selectslotpri[$key];?>"/>
                  <?php
                      }
                  ?>
                  </div>
                  <div class="col-4">
                  <?php 
                      if(isset($selectlabelsec[$key])){
                          ?>
                          <span class="label_slot"><?=$selectlabelsec[$key];?>/slot :<?=$selectslotsec[$key];?></span>
                          <input type="hidden" name="selectlabelsec[]" value="<?=$selectlabelsec[$key];?>"/>
                          <input type="hidden" name="selectslotsec[]" value="<?=$selectslotsec[$key];?>"/>
                          <?php
                      }else{
                        ?>
                        <span class="label_slot"><?=$memo;?></span>
                        <input type="hidden" name="memo" value="<?=$memo;?>"/>
                        <?php
                      }
                  ?>
                  </div>
              </div>
          </div>
          <?php
  }
  
  ?>
  <div class="form-group">
      <div class="row justify-content-center">
              <button type="button" class="btn btn-facebook" onclick="backpage('3','2')">ย้อนกลับ</button>
              <button type="submit" class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกหรือไม่ ?');">บันทึก</button>
      </div>
  </div>
  </form>
<?php
}else if($type=='private'){
  //----------------------------------------------เบอร์ประจำชั้น-------------------------------------------------------
    $location=isset($_POST['location_root'])?$_POST['location_root']:NULL;
    $eq_id=isset($_POST['eq_id'])?$_POST['eq_id']:NULL;
    $selectlabelpri=isset($_POST['selectlabelpri'])?$_POST['selectlabelpri']:NULL;
    $selectslotpri=isset($_POST['selectslotpri'])?$_POST['selectslotpri']:NULL;
    $selectlabelsec=isset($_POST['selectlabelsec'])?$_POST['selectlabelsec']:NULL;
    $selectslotsec=isset($_POST['selectslotsec'])?$_POST['selectslotsec']:NULL;
    $memo=isset($_POST['memo'])?$_POST['memo']:NULL;
    if($_SESSION['type_phone']=='ipphone'){
      $_SESSION['tel']=$_POST['tel'];
    }
?>

<div class="form-group">
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-4">
        <span class="info-around">สถานที่ : <?=$_SESSION['location'];?></span>
        </div>
        <div class="col-5">
        <span class="info-around">เบอร์โทร : <?=$_SESSION['tel'];?></span>
        </div>
    </div>
</div>
<hr/>
<form action="save_newtel.php" method="post">
<?php
  if($_SESSION['type_phone']!='ipphone'){
  ?>
<div class="form-group">
  <div class="row justify-content-center">
      <h3>เส้นทาง</h3>
  </div>
  <div class="row">
    <div class="col-4 head_title">
      สถานที่
    </div>
    <div class="col-4 head_title">
      Primary Terminal
    </div>
    <div class="col-4 head_title">
      Secondary Terminal
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
                  <input type="hidden" name="eq_id[]" value="<?=$eq_id[$key];?>">
                </div>
                <div class="col-4" >
                <?php 
                    if(isset($selectlabelpri[$key])){
                ?>
                        <span class="label_slot"><?=$selectlabelpri[$key];?>/slot :<?=$selectslotpri[$key];?></span>
                        <input type="hidden" name="selectlabelpri[]" value="<?=$selectlabelpri[$key];?>"/>
                        <input type="hidden" name="selectslotpri[]" value="<?=$selectslotpri[$key];?>"/>
                <?php
                    }
                ?>
                </div>
                <div class="col-4">
                <?php 
                    if(isset($selectlabelsec[$key])){
                        ?>
                        <span class="label_slot"><?=$selectlabelsec[$key];?>/slot :<?=$selectslotsec[$key];?></span>
                        <input type="hidden" name="selectlabelsec[]" value="<?=$selectlabelsec[$key];?>"/>
                        <input type="hidden" name="selectslotsec[]" value="<?=$selectslotsec[$key];?>"/>
                        <?php
                    }else{
                      ?>
                      <span class="label_slot"><?=$memo;?></span>
                      <input type="hidden" name="memo" value="<?=$memo;?>"/>
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
if($_SESSION['type_phone']=='ipphone'){
  $thispage='block_con';
  $backpage='1';
}elseif($_SESSION['type_phone']=='normal_tel'){
  $thispage='block_con';
  $backpage='2';
}
?>
<div class="form-group">
    <div class="row justify-content-center">
    <button type="button" class="btn btn-facebook" onclick="backpage('<?=$thispage;?>','<?=$backpage;?>')">ย้อนกลับ</button>
            <button type="submit" class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกหรือไม่ ?');">บันทึก</button>
    </div>
</div>
</form>
<?php
}   
?>




