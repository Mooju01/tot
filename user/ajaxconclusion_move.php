<?php
include '../connect.php';
session_start();
$type=$_POST['type'];
?>
<div class="form-group">
    <div class="row justify-content-center">
      <h3>สรุปการย้ายเบอร์</h3>
    </div>
</div>
<?php
    $location=$_POST['location_root'];
    $selectlabelpri=$_POST['selectlabelpri'];
    $selectslotpri=$_POST['selectslotpri'];
    $selectlabelsec=$_POST['selectlabelsec'];
    $selectslotsec=$_POST['selectslotsec'];
    $eq_id=$_POST['eq_id'];
    $page=$_POST['page'];
    $_SESSION['location_detail']=$_POST['location_detail'];
    $memo=isset($_POST['memo'])?$_POST['memo']:NULL;
    ?>
    <div class="form-group">
    <div class="row justify-content-center">
            </div>      
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
                <div class="col-5">
                <span class="info-around">สถานที่นั่งใหม่ : <span class="star"><?=$_SESSION['location_detail'];?></span></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">เบอร์โทร: <?=$_SESSION['tel'];?></span> 
                </div>
                <?php
                if(isset($_SESSION['newtel']) && $_SESSION['select']=='all'){
                ?>
                  <div class="col-5">
                  <span class="info-around">เบอร์ใหม่ : <span style="color:red;"><?=$_SESSION['newtel'];?></span></span>
                  </div>
                <?php
                }
                ?>
              </div>
              <?php
              }
              ?>
              <hr>
          </div>
          <div class="form-group">
            <div class="row justify-content-center">
                <h3>สรุปเส้นทางใหม่</h3>
            </div>
          </div>
          <div class="form-group">
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
<form action="updatenewmap.php" method="post">
<?php
foreach($location as $key=>$value){
    ?>
        <div class="form-group">
            <div class="row location_name">
                <div class="col-4"> 
                  <?=$location[$key];?>
                  <input type="hidden" name="location[]" value="<?=$location[$key];?>"/>
                  <input type="hidden" name="eq_id[]" value="<?=$eq_id[$key];?>"/>
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
                      echo $memo;
                      ?>
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
  $check=array_shift($_SESSION['check']);
  if($check>0){
    $check=$check-1;
  }else{
    $check=0;
  }
  for($i=$check;$i<count($location);$i++){
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
?>
<div class="form-group">
    <div class="row justify-content-center">
            <button type="button" class="btn btn-facebook" onclick="backpage('4','<?=$page;?>')">ย้อนกลับ</button>
            <button type="submit" class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกหรือไม่ ?');">บันทึก</button>
    </div>
</div>
</form>




