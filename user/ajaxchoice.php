<?php
include '../connect.php';
session_start();
$location=(isset($_POST['location']))?$_POST['location']:NULL;
$check=(isset($_POST['Check']))?$_POST['Check']:NULL;
$eq_id=(isset($_POST['eq_id']))?$_POST['eq_id']:NULL;
$labelpri=(isset($_POST['labelpri']))?$_POST['labelpri']:NULL;
$slotpri=(isset($_POST['slotpri']))?$_POST['slotpri']:NULL;
$labelsec=(isset($_POST['labelsec']))?$_POST['labelsec']:NULL;
$slotsec=(isset($_POST['slotsec']))?$_POST['slotsec']:NULL;
$_SESSION['location']=array();
$_SESSION['sel_eq_id']=array();
$_SESSION['sel_labelpri']=array();
$_SESSION['sel_slotpri']=array();
$_SESSION['sel_labelsec']=array();
$_SESSION['sel_slotsec']=array();
if(count($check)>0){
    foreach($check as $key=>$value){
        array_push($_SESSION['location'],$location[$value]);
        array_push($_SESSION['sel_eq_id'],$eq_id[$value]);
        array_push($_SESSION['sel_labelpri'],$labelpri[$value]);
        array_push($_SESSION['sel_slotpri'],$slotpri[$value]);
        if(isset($labelsec[$value]) && isset($slotsec[$value])){
            array_push($_SESSION['sel_labelsec'],$labelsec[$value]); 
            array_push($_SESSION['sel_slotsec'],$slotsec[$value]);
            unset($labelsec[$value]);
            unset($slotsec[$value]);
        }
        unset($eq_id[$value]);
        unset($labelpri[$value]);
        unset($slotpri[$value]);
    }
}
$_SESSION['check']=array_pop($check);

//เช็ค จำนวน labelpri และ slotpri ถ้า ไม่มี ไปหน้าสรุป ถ้ามี 1 ตัว ไปหน้า เลือก kc ถ้า > 1 ตัว เลือกปลายทางใหม่
if(count($labelpri)==0 && count($slotpri)==0){
    $memo=$_POST['memo'];
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
        <div class="form-group">
            <div class="row justify-content-center">
                <h3>กำหนดเส้นทาง</h3>
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
<form action="" method="post" id="frm_chkall">
        <?php
        foreach($location as $key=>$value){
        ?>
        <div class="form-group">
            <div class="row" style="height:60%;">
                <div class="col-4 location_name"> 
                    <?=$_SESSION['location'][$key];?>
                    <input type="hidden" name="location_root[]" value="<?=$_SESSION['location'][$key];?>"/>
                    <input type="hidden" name="eq_id[]" value="<?=$_SESSION['sel_eq_id'][$key];?>"/>
                </div>
                <div class="col-4" >
                <?php 
                    if(isset($_SESSION['sel_labelpri'][$key])){
                ?>
                        <span class="label_slot"><?=$_SESSION['sel_labelpri'][$key];?>/slot :<?=$_SESSION['sel_slotpri'][$key];?></span>
                        <input type="hidden" name="selectlabelpri[]" value="<?=$_SESSION['sel_labelpri'][$key];?>"/>
                        <input type="hidden" name="selectslotpri[]" value="<?=$_SESSION['sel_slotpri'][$key];?>"/>
                <?php
                    }
                ?>
                </div>
                <div class="col-4">
                <?php 
                    if(isset($_SESSION['sel_labelsec'][$key])){
                        ?>
                        <span class="label_slot"><?=$_SESSION['sel_labelsec'][$key];?>/slot :<?=$_SESSION['sel_slotsec'][$key];?></span>
                        <input type="hidden" name="selectlabelsec[]" value="<?=$_SESSION['sel_labelsec'][$key];?>"/>
                        <input type="hidden" name="selectslotsec[]" value="<?=$_SESSION['sel_slotsec'][$key];?>"/>
                        <?php
                    }else{
                        ?>
                        <input type="text" name="memo" class="form-control" placeholder="รายละเอียดปลายทาง"/>
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
        <button type="button" class="btn btn-facebook" id="backblock2" onclick="backpage('block_choice','block_sharedtel');">ย้อนกลับ</button>
        <button type="button" id="nextblock2" class="btn btn-facebook" onclick="conclusion('block_conclusion','block_choice','frm_chkall')">ถัดไป</button>
    </div>
</div>

<?php
}else if(count($labelpri)==1 && count($slotpri)==1){
    array_pop($_SESSION['sel_labelsec']);
    array_pop($_SESSION['sel_slotsec']);
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
                    <div class="form-group">
            <div class="row justify-content-center">
                <h3>กำหนดเส้นทาง</h3>
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
    <form action="#" method="post" id="frm_con_kc">
        <?php
        $count=0;
        for($i=0;$i<count($_SESSION['location']);$i++){
        ?>
        <div class="form-group">
            <div class="row" style="height:60%;">
                <div class="col-4 location_name"> 
                   <?=$_SESSION['location'][$i];?>
                    <input type="hidden" name="location_root[]" value="<?=$_SESSION['location'][$i];?>"/>
                    <input type="hidden" name="eq_id[]" value="<?=$_SESSION['sel_eq_id'][$i];?>"/>
                </div>
        <div class="col-4" >
                <?php 
                    if(isset($_SESSION['sel_labelpri'][$i])){
                ?>
                        <span class="label_slot"><?=$_SESSION['sel_labelpri'][$i];?>/slot :<?=$_SESSION['sel_slotpri'][$i];?></span>
                        <input type="hidden" name="selectlabelpri[]" value="<?=$_SESSION['sel_labelpri'][$i];?>"/>
                        <input type="hidden" name="selectslotpri[]" value="<?=$_SESSION['sel_slotpri'][$i];?>"/>
                <?php
                    }else{
                ?>
                        <span id="showfirst<?=$i;?>" class="label_slot"></span>
                        <input type="hidden" name="selectlabelpri[]" class="label<?=$i;?>"/>
                        <input type="hidden" name="selectslotpri[]"  class="slot<?=$i;?>"/>
                <?php
                    }
                ?>
                </div>
                <div class="col-4" id="<?=$_SESSION['sel_eq_id'][$i];?>" <?php if($count!=0){?>style="display: none;"<?php } ?>>
                <?php 
                    if(isset($_SESSION['sel_labelsec'][$i])){
                        ?>
                        <span class="label_slot"><?=$_SESSION['sel_labelsec'][$i];?>/slot :<?=$_SESSION['sel_slotsec'][$i];?></span>
                        <input type="hidden" name="selectlabelsec[]" value="<?=$_SESSION['sel_labelsec'][$i];?>"/>
                        <input type="hidden" name="selectslotsec[]" value="<?=$_SESSION['sel_slotsec'][$i];?>"/>
                        <?php
                    }else{
                ?>
                       <span id="show<?=$i;?>" class="label_slot"></span>
                        <input type="hidden" name="selectlabelsec[]" id="label<?=$i;?>"/>
                        <input type="hidden" name="selectslotsec[]" id="slot<?=$i;?>"/>
                        <button type="button" 
                            value="<?php if($i==count($_SESSION['sel_eq_id'])-1){echo $_SESSION['sel_eq_id'][$i];}else{echo $_SESSION['sel_eq_id'][$i+1];} ?>" 
                            onclick="slectslot(this.value,'<?=$_SESSION['sel_eq_id'][$i];?>','show<?=$i;?>','showfirst<?=$i+1?>','label<?=$i;?>','slot<?=$i;?>','<?php if($i==count($_SESSION['sel_eq_id'])-1){echo 'stop';}else{echo 'next';} ?>');"
                            data-toggle="modal" 
                            data-target="#modal_terminal"
                            class="btn btn-facebook">เลือก</button>
                <?php
                    $count++;
                    }
                ?>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
<div class="row">
    <div id="showkc" class="col-12"></div>
  </div>
<div class="form-group">
    <div class="row justify-content-center">         
        <button type="button" class="btn btn-facebook" id="backblock2" onclick="backpage('block_choice','block_sharedtel');">ย้อนกลับ</button>
        <button type="button" id="nextblock2" class="btn btn-facebook" onclick="conclusion('block_conclusion','block_choice','frm_con_kc')">ถัดไป</button>
    </div>
</div>
</form>
<!--================================ modal ==================================-->
<?php
include_once 'modal.php';
?>
<!--================================ modal ==================================-->
<?php
}else if(count($labelpri)>1 && count($slotpri)>1){
    array_pop($_SESSION['sel_labelsec']);
    array_pop($_SESSION['sel_slotsec']);
    $eq_id=array_pop($_SESSION['sel_eq_id']);
    $sql=$mysqli->query("SELECT b_eq_id
                        FROM route_map
                        WHERE eq_id='$eq_id'
                        ORDER BY b_eq_id ASC");
    $result=$sql->num_rows;
    $b_eq_id=array();
    for($i=0;$i<$result;$i++){
        $row=$sql->fetch_assoc();
        array_push($b_eq_id,$row);
    }
    ?>

    <form action="#" method="post" id="selectnewmap">
    <?php
    if(count($_SESSION['sel_labelpri'])>0){
        foreach($_SESSION['sel_labelpri'] as $key=>$value){
            ?>
            
            <input type="hidden" name="labelpri[]" value="<?=$_SESSION['sel_labelpri'][$key];?>">
            <input type="hidden" name="slotpri[]" value="<?=$_SESSION['sel_slotpri'][$key];?>">
            <?php
        }
    }
    if(count($_SESSION['sel_labelsec'])>0){
        foreach($_SESSION['sel_labelsec'] as $key=>$value){
            ?>
            <input type="hidden" name="labelsec[]" value="<?=$_SESSION['sel_labelsec'][$key];?>">
            <input type="hidden" name="slotsec[]" value="<?=$_SESSION['sel_slotsec'][$key];?>">
            <?php
        }
    }
    ?>
    <div class="form-group">
        <div class="row justify-content-center">
            <div class="col-8">
            <label>เลือกเส้นทาง</label>
                <select name="b_eq_id" id="" class="form-control" onchange="showfloor(this.value)">
                    <option value="" selected>-----กรุณาเลือกอาคาร-----</option>
                <?php
                    foreach($b_eq_id as $value){
                    $sql=$mysqli->query("SELECT b_eq_id,distination_name
                                    FROM distination
                                    WHERE b_eq_id='".$value['b_eq_id']."'
                                    ORDER BY b_eq_id ASC");
                        while($row=$sql->fetch_assoc()){
                            ?>
                            <option value="<?=$row['b_eq_id'];?>"><?=$row['distination_name'];?></option>
                            <?php
                        }
                    }
                unset($b_eq_id);
                ?>
                </select>
                <label id="error_buile" class="select-error2" style="display:none;">กรุณาเลือกอาคาร</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row justify-content-center">
            <div class="col-8">
                <div id="selectfloor"></div>
            </div>
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
            <button type="button" class="btn btn-facebook" id="backblock2" onclick="backpage('block_choice','block_sharedtel');">ย้อนกลับ</button>
            <button type="button" id="nextblock2" class="btn btn-facebook" onclick="addnewmap();">ถัดไป</button>
            
        </div>
    </div>
    </form>
   
<?php
}
unset($location);
unset($eq_id);
unset($labelpri);
unset($slotpri);
unset($labelsec);
unset($slotsec);
?>
