<?php
include '../connect.php';
session_start();

$location=$_POST['location'];
$eq_id=$_POST['eq_id'];
$labelpri=$_POST['labelpri'];
$slotpri=$_POST['slotpri'];
$labelsec=$_POST['labelsec'];
$slotsec=$_POST['slotsec'];
$memo=$_POST['memo'];


//เบอร์ใหม่
$label=$_POST['label'];
$slot=$_POST['slot'];
//หาเบอร์ใหม่
$sql=$mysqli->query("SELECT tel
                    FROM terminal
                    WHERE label='$label' AND slot='$slot'
                    ");
while($row=$sql->fetch_assoc()){
    $newtel=$row['tel'];
}
//เอาเบอร์เก่าออกจากเส้นทาง
$labelpri_old=array_shift($labelpri);
$slotpri_old=array_shift($slotpri);
//เอาเบอร์ใหม่เข้าเส้นทาง
array_unshift($labelpri,$label);
array_unshift($slotpri,$slot);

?>
<div class="form-group">
            <?php
            if($_SESSION['type_change']=='emp'){
            ?>
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
                <div class="col-5">
                เบอร์โทรใหม่ : <span class="star"><?=$newtel;?></span>
                </div>
              </div>
              <?php
              }
              ?>
            <?php
            }elseif($_SESSION['type_change']=='hotel'){
            ?>
                <div class="row justify-content-center">
                    <h3>ข้อมูลหอพัก/โรงแรม</h3>
                </div>
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <span class="info-around">ชื่ออาคาร : <?=$_SESSION['hotel_info']['hotel_name'];?></span>
                    </div>
                    <div class="col-5">
                        <span class="info-around">เบอร์ห้อง : <?=$_SESSION['hotel_info']['hotel_no'];?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-4">
                        <span class="info-around">เบอร์โทร : <?=$_SESSION['tel'];?></span>
                    </div>
                    <div class="col-5">
                        <span class="info-around">เบอร์โทรใหม่ : <span class="star"><?=$newtel;?></span></span>
                    </div>
                </div>
            <?php
            }else{
                ?>
            <div class="row justify-content-center">
                <h3>ข้อมูลเบอร์ประจำชั้น</h3>
            </div>
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-4">
                    <span class="info-around">ชื่ออาคาร : <?=$_SESSION['private_info']['location'];?></span>
                </div>
                <div class="col-5">
                    <span class="info-around">เบอร์โทร : <?=$_SESSION['tel'];?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-4">
                    <span class="info-around">เบอร์โทรใหม่ : <span class="star"><?=$newtel;?></span></span>
                </div>
            </div>
            <?php
            }
            ?>
            <hr>
</div>
<form action="updatenewtel.php" method="post">
<div class="form-group">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="form-group">
                <div class="row justify-content-center">
                        <h3>เส้นทาง</h3>
                </div>
                <div class="row">
                    <div class="col-4 head_title">สถานที่</div>
                    <div class="col-4 head_title">Terminal Primary</div>
                    <div class="col-4 head_title">Terminal Secondary</div>            
                </div>
            </div>
        <?php
        foreach($location as $key => $value ){
                              
            ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-4 location_name">
                        <label><?=$location[$key];?></label>
                        <input type="hidden" name="eq_id[]" value="<?=$eq_id[$key];?>"/>
                    </div>
                    <div class="col-4">
                        <span class="label_slot"><?=$labelpri[$key];?>/slot :<?=$slotpri[$key];?></span>
                    </div>
                    <?php
                        if(isset($slotsec[$key])){
                    ?>
                    <div class="col-4">
                        <span class="label_slot"><?=$labelsec[$key];?>/slot :<?=$slotsec[$key];?></span>
                    </div>
                    <?php
                        }else{
                    ?>
                    <div class="col-4">
                        <span class="label_slot"><?=$memo;?></span>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php
        }
        unset($location);
        unset($eq_id);
        unset($labelpri);
        unset($slotpri);
        unset($labelsec);
        unset($slotsec);
        unset($_SESSION['emp_info']);
        unset($memo);
        ?>
        </div>
    </div>
    <input type="hidden" name="newtel" value="<?=$newtel;?>">
    <input type="hidden" name="labelpri_old" value="<?=$labelpri_old;?>">
    <input type="hidden" name="slotpri_old" value="<?=$slotpri_old;?>">
    <input type="hidden" name="label" value="<?=$label;?>">
    <input type="hidden" name="slot" value="<?=$slot;?>">
</div>
<div class="form-group">
    <div class="row justify-content-center">
        <button type="button" class="btn btn-facebook" onclick="backpage('3','2')">ย้อนกลับ</button>
        <button type="submit" class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกหรือไม่ ?')" >บันทึก</button>
    </div> 
</div>
</form>