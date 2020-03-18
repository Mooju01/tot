<?php
include_once '../connect.php';
session_start();
$location=(isset($_POST['location']))?$_POST['location']:NULL;
$check=(isset($_POST['Check']))?$_POST['Check']:NULL;
$eq_id=(isset($_POST['eq_id']))?$_POST['eq_id']:NULL;
$labelpri=(isset($_POST['labelpri']))?$_POST['labelpri']:NULL;
$slotpri=(isset($_POST['slotpri']))?$_POST['slotpri']:NULL;
$labelsec=(isset($_POST['labelsec']))?$_POST['labelsec']:NULL;
$slotsec=(isset($_POST['slotsec']))?$_POST['slotsec']:NULL;
$tel= $_SESSION['tel'];
$_SESSION['eq_id_old']=array();
$_SESSION['labelpri_old']=array();
$_SESSION['slotpri_old']=array();
$_SESSION['labelsec_old']=array();
$_SESSION['slotsec_old']=array();
$_SESSION['check']=$check;

if(count($check)>0){
    foreach($check as $key=>$value){
        array_push($_SESSION['eq_id_old'],$eq_id[$value]);
        array_push($_SESSION['labelpri_old'],$labelpri[$value]);
        array_push($_SESSION['slotpri_old'],$slotpri[$value]);
        if(isset($labelsec[$value]) && isset($slotsec[$value])){
            array_push($_SESSION['labelsec_old'],$labelsec[$value]); 
            array_push($_SESSION['slotsec_old'],$slotsec[$value]);
            unset($labelsec[$value]);
            unset($slotsec[$value]);
        }
        unset($eq_id[$value]);
        unset($labelpri[$value]);
        unset($slotpri[$value]);
    }
}
array_push($_SESSION['labelsec_old'],array_pop($labelsec)); 
array_push($_SESSION['slotsec_old'],array_pop($slotsec));
$counteq_id=count($eq_id);

if(count($_SESSION['labelsec_old'])>1 && count($_SESSION['labelsec_old'])>1){
    $eq_id=array_pop($eq_id);
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
    if(count($labelpri)>0){
        foreach($labelpri as $key=>$value){
            ?>
            
            <input type="hidden" name="labelpri[]" value="<?=$labelpri[$key];?>">
            <input type="hidden" name="slotpri[]" value="<?=$slotpri[$key];?>">
            <?php
        }
    }
    if(count($labelsec)>0){
        foreach($labelsec as $key=>$value){
            ?>
            <input type="hidden" name="labelsec[]" value="<?=$labelsec[$key];?>">
            <input type="hidden" name="slotsec[]" value="<?=$slotsec[$key];?>">
            <?php
        }
    }
    unset($labelpri);
    unset($slotpri);
    unset($labelsec);
    unset($slotsec);
    
    ?>
    <div class="form-group">
        <div class="row justify-content-center">
            <div class="col-8">
            <label >เลือกเส้นทางใหม่<span class="star">*</span></label>
            
                <select name="b_eq_id" id="" class="form-control" onchange="showfloor(this.value)">
                    <option value="" selected>------เลือก-------</option>
                <?php
                if($counteq_id==0){
                    $sql=$mysqli->query("SELECT b_eq_id,distination_name
                                    FROM distination ORDER BY b_eq_id ASC");
                    while($row=$sql->fetch_assoc()){
                        ?>
                        <option value="<?=$row['b_eq_id'];?>"><?=$row['distination_name'];?></option>
                        <?php
                    }
                }else{
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
    </form>
    <div class="form-group">
        <div class="row justify-content-center">
            <button type="button" class="btn btn-facebook" id="backblock2" onclick="backpage('2','1')">ย้อนกลับ</button>
            <?php
            if($counteq_id==0){
                $_SESSION['select']='all';
            ?>
                <button type="button" id="nextblock2" class="btn btn-facebook" onclick="addnewtel()">ถัดไป</button>
            <?php
            }else{
                $_SESSION['select']='notall';
            ?>
                <button type="button" id="nextblock2" class="btn btn-facebook" onclick="addnewmap()">ถัดไป</button>
            <?php
            }
            ?>
            
        </div>
    </div>

<?php
}
else{
    $_SESSION['select']='notall';
//กรณีไม่เอา kc
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
            <div class="row">
            <div class="col-12">
                <h3>กำหนดเส้นทาง</h3>
            </div>
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
<form action="#" method="post" id="frm_conclusion">
        <?php
        $count=0;
        for($i=0;$i<count($eq_id);$i++){
        ?>
        <div class="form-group">
            <div class="row">
                <div class="col-4 location_name"> 
                    <?=$location[$i];?>
                    <input type="hidden" name="location_root[]" value="<?=$location[$i];?>"/>
                    <input type="hidden" name="eq_id[]" value="<?=$eq_id[$i];?>"/>
                </div>
        <div class="col-4" >
                <?php 
                    if(isset($labelpri[$i])){
                ?>
                        <span class="label_slot"><?=$labelpri[$i];?>/slot :<?=$slotpri[$i];?></span>
                        <input type="hidden" name="selectlabelpri[]" value="<?=$labelpri[$i];?>"/>
                        <input type="hidden" name="selectslotpri[]" value="<?=$slotpri[$i];?>"/>
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
                <div class="col-4" id="<?=$eq_id[$i];?>" <?php if($count!=0){?>style="display: none;"<?php } ?>>
                <?php 
                    if(isset($labelsec[$i])){
                        ?>
                        <span class="label_slot"><?=$labelsec[$i];?>/slot :<?=$slotsec[$i];?></span>
                        <input type="hidden" name="selectlabelsec[]" value="<?=$labelsec[$i];?>"/>
                        <input type="hidden" name="selectslotsec[]" value="<?=$slotsec[$i];?>"/>
                        <?php
                    }else{
                ?>
                       <span id="show<?=$i;?>" class="label_slot"></span>
                        <input type="hidden" name="selectlabelsec[]" id="label<?=$i;?>"/>
                        <input type="hidden" name="selectslotsec[]" id="slot<?=$i;?>"/>
                        <button type="button" 
                            value="<?php if($i==count($eq_id)-1){echo $eq_id[$i];}else{echo $eq_id[$i+1];} ?>" 
                            onclick="slectslot(this.value,'<?=$eq_id[$i];?>','show<?=$i;?>','showfirst<?=$i+1?>','label<?=$i;?>','slot<?=$i;?>','<?php if($i==count($eq_id)-1){echo 'stop';}else{echo 'next';} ?>');"
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
        <button type="button" class="btn btn-facebook" id="backblock2" onclick="backpage('2','1')">ย้อนกลับ</button>
        <button type="button" id="nextblock2" class="btn btn-facebook" onclick="conclusion('2','frm_conclusion')">ถัดไป</button>
    </div>
</div>
</form>

<!--================================ modal ==================================-->
<?php
include_once 'modal.php';
?>
<!--================================ modal ==================================-->



<?php
}
?>