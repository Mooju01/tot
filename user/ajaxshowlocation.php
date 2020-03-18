<?php
include '../connect.php';
session_start();
$_SESSION['tel']=$_POST['tel'];
$_SESSION['slot']=$_POST['slot'];
$_SESSION['label']=$_POST['label'];
//search all building
$src_building=array();
$sql=$mysqli->query("SELECT *
                    FROM distination");
$result=$sql->num_rows;
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($src_building,$row);
}
//search all building end
?>
<div class="form-group">
                      <div class="row justify-content-center">
                        <h3>ข้อมูลพนักงาน</h3>
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

<form action="#" method="post" id="frm_location">
<div class="form-group">
    <div class="row justify-content-center">
        <div class="col-7">
            <label>เลือกสถานที่ปลายทาง
                <span class="star">*</span></label>
            <select class="form-control form-control-alternative" id="selectlocation" name="location"
                onchange="showfloor(this.value)">
                <option value="" selected>-----กรุณาเลือกอาคาร-----</option>
                <?php
                                foreach($src_building as $value ){
                              ?>
                <option value="<?=$value["b_eq_id"];?>"><?=$value["distination_name"];?></option>
                <?php
                                }
                              ?>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row justify-content-center">
        <div class="col-7" id="selectfloor"></div>
    </div>
</div>
<div class="form-group">
    <div class="row justify-content-center">
        <div class="col-7">
          <div class="row" style="color: red;">*Outside เลือกปลายทางเป็น CAB01</div>
          <div class="row" style="color: red;">*โรงยิม เลือกปลายทางเป็น อาคารหอพัก 35</div>
          <div class="row" style="color: red;"> *อาคาร 3 A เลือกปลายทางเป็น อาคาร 1</div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row justify-content-center">
        <button type="button" class="btn btn-facebook " id="backblock2" onclick="backpage('2','1');">
            ย้อนกลับ
        </button>
        <button type="button" class="btn btn-facebook " id="nextblock2" onclick='maptelecom();'>
            ถัดไป
        </button>
    </div>
</div>
</form>
