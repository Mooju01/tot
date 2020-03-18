<?php
include '../connect.php';
session_start();
$b_eq_id=(isset($_POST['b_eq_id']))?$_POST['b_eq_id']:NULL;
$eq_id=(isset($_POST['eq_id']))?$_POST['eq_id']:NULL;
$labelpri=(isset($_POST['labelpri']))?$_POST['labelpri']:NULL;
$slotpri=(isset($_POST['slotpri']))?$_POST['slotpri']:NULL;
$labelsec=(isset($_POST['labelsec']))?$_POST['labelsec']:NULL;
$slotsec=(isset($_POST['slotsec']))?$_POST['slotsec']:NULL;
$slot=(isset($_POST['slot']))?$_POST['slot']:NULL;
$label=(isset($_POST['label']))?$_POST['label']:NULL;
$newtel=(isset($_POST['newtel']))?$_POST['newtel']:NULL;
$mapArray=array();

//หาจำนวน MDF ของอาคาร
$sql=$mysqli->query("SELECT eq_id
                    FROM terminal
                    WHERE eq_id LIKE '".$b_eq_id."F__B%' 
                    GROUP BY eq_id");
$count_MDF=$sql->num_rows;


$sql=$mysqli->query("SELECT equipment.location,route_map.eq_id
                    FROM route_map
                    INNER JOIN equipment
                    ON route_map.eq_id=equipment.eq_id
                    WHERE route_map.b_eq_id='$b_eq_id'
                    ORDER BY route_map.eq_id ASC");
$nummap=$sql->num_rows;
if($count_MDF>1){
  for($i=0;$i<$nummap;$i++){
    $row=$sql->fetch_assoc();
    array_push($mapArray,$row);
  }

  $sql=$mysqli->query("SELECT location
                      FROM equipment
                      WHERE eq_id='$eq_id'");
  while($row=$sql->fetch_assoc()){
    $add_route=array(
      'location'=>$row['location'],
      'eq_id'=>$eq_id
    );
  }
  array_push($mapArray,$add_route);
}else{
  //กรณีเจอ MDF ตัวเดียว
  for($i=0;$i<$nummap;$i++){
    $row=$sql->fetch_assoc();
    array_push($mapArray,$row);
  }
}
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
                <span class="info-around">เบอร์โทรศัพท์ : <?=$_SESSION['tel'];?></span> 
                </div>
                <?php
                if(isset($newtel)){
                  $_SESSION['newtel']=$newtel;
                ?>
                <div class="col-5">
                <span class="info-around">เบอร์โทรศัพท์ใหม่ : <span class='star'><?=$newtel;?></span></span> 
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
<form action="#" method="post" id="end_conclusion">
        <?php
        $count=0;
        for($i=0;$i<count($mapArray);$i++){
        ?>
        <div class="form-group">
            <div class="row" style="height:60%;">
                <div class="col-4 location_name"> 
                  <?=$mapArray[$i]["location"];?>
                  <input type="hidden" name="location_root[]" value="<?=$mapArray[$i]['location']?>"/>
                  <input type="hidden" name="eq_id[]" value="<?=$mapArray[$i]['eq_id']?>"/>
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
                      if(isset($label) && isset($slot) ){
                        ?>
                          <span class="label_slot"><?=$label;?>/slot :<?=$slot;?></span>
                          <input type="hidden" name="selectlabelpri[]" value="<?=$label;?>"/>
                          <input type="hidden" name="selectslotpri[]" value="<?=$slot;?>"/>
                        <?php
                        unset($label);
                        unset($slot);
                      }else{
                ?>
                        <span id="showfirst<?=$i;?>" class="label_slot"></span>
                        <input type="hidden" name="selectlabelpri[]" class="label<?=$i;?>"/>
                        <input type="hidden" name="selectslotpri[]"  class="slot<?=$i;?>"/>
                <?php
                      }
                    }
                ?>
                </div>
                <div class="col-4" id="<?=$mapArray[$i]['eq_id'];?>" <?php if($count!=0){?>style="display: none;"<?php } ?>>
                <?php 
                    if(isset($labelsec[$i])){
                        ?>
                        <span class="label_slot"><?=$labelsec[$i];?>/slot :<?=$slotpri[$i];?></span>
                        <input type="hidden" name="selectlabelsec[]" value="<?=$labelsec[$i];?>"/>
                        <input type="hidden" name="selectslotsec[]" value="<?=$slotpri[$i];?>"/>
                        <?php
                    }else{

                ?>
                       <span id="show<?=$i;?>" class="label_slot"></span>
                        <input type="hidden" name="selectlabelsec[]" id="label<?=$i+1;?>"/>
                        <input type="hidden" name="selectslotsec[]" id="slot<?=$i+1;?>"/>
                        <button type="button" 
                            value="<?php if($i==count($mapArray)-1){echo $mapArray[$i]['eq_id'];}else{echo $mapArray[$i+1]['eq_id'];} ?>" 
                            onclick="slectslot(this.value,'<?=$mapArray[$i]['eq_id'];?>','show<?=$i;?>','showfirst<?=$i+1?>','label<?=$i+1;?>','slot<?=$i+1;?>','<?php if($i==count($mapArray)-1){echo 'stop';}else{echo 'next';} ?>');"
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
            unset($mapArray);
        ?>

  <div class="row">
    <div id="showkc" class="col-12"></div>
  </div>

<div class="form-group">
    <div class="row justify-content-center">
        <?php
        $type=isset($_POST['type'])?$_POST['type']:NULL;
        if($type=='add'){
        ?>
            <button type="button" class="btn btn-facebook" onclick="backpage('block_addnewmap','block_choice')">ย้อนกลับ</button>
            <button type="button" class="btn btn-facebook" onclick="conclusion('block_conclusion','block_addnewmap','end_conclusion')">ถัดไป</button>
        <?php
        }elseif($type=='move'){
          $oldpage=(isset($_POST['oldpage']))?$_POST['oldpage']:NULL;
        ?>
          <button type="button" class="btn btn-facebook" onclick="backpage('3','<?=$oldpage;?>')">ย้อนกลับ</button>
          <button type="button" class="btn btn-facebook" onclick="conclusion('3','end_conclusion')">ถัดไป</button>
        <?php
        }
        ?>
    </div>
</div>
</form>


<!--================================ modal ==================================-->
<?php
include_once 'modal.php';
?>
<!--================================ modal ==================================-->