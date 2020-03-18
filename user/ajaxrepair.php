<?php
include_once "../connect.php";
session_start();
$_SESSION['location']=(isset($_POST['location']))?$_POST['location']:NULL;
$_SESSION['check']=(isset($_POST['Check']))?$_POST['Check']:NULL;
$_SESSION['eq_id']=(isset($_POST['eq_id']))?$_POST['eq_id']:NULL;
$_SESSION['labelpri']=(isset($_POST['labelpri']))?$_POST['labelpri']:NULL;
$_SESSION['slotpri']=(isset($_POST['slotpri']))?$_POST['slotpri']:NULL;
$_SESSION['labelsec']=(isset($_POST['labelsec']))?$_POST['labelsec']:NULL;
$_SESSION['slotsec']=(isset($_POST['slotsec']))?$_POST['slotsec']:NULL;

$_SESSION['slot']=(isset($_POST['slot']))?$_POST['slot']:NULL;
$_SESSION['label']=(isset($_POST['label']))?$_POST['label']:NULL;
$_SESSION['newtel']=(isset($_POST['tel']))?$_POST['tel']:NULL;
$tel= $_SESSION['tel'];
//print_r($_POST);
$_SESSION['labelpri_die']=array();
$_SESSION['slotpri_die']=array();
$alllocation=count($_SESSION['location'])-1;
//echo $alllocation;
//print_r($check);
if(count($_SESSION['check'])>0){
    foreach($_SESSION['check'] as $key=>$value){
        if($_SESSION['check'][$key]==$alllocation){
            //echo $_SESSION['check'][$key];
            array_pop($_SESSION['location']);
            array_pop($_SESSION['eq_id']);
        }
            
        
        array_push($_SESSION['labelpri_die'],$_SESSION['labelpri'][$value]);
        array_push($_SESSION['slotpri_die'],$_SESSION['slotpri'][$value]);
        
    }
}

// print_r($_SESSION['eq_id']);
// print_r($_SESSION['location']);
//  print_r($location);
//  echo "<br>";
//  print_r($_SESSION['eq_id']);
// echo "<br>";
// print_r($_SESSION['slotpri']);
// echo "<br>";
// print_r($_SESSION['labelsec']);
// echo "<br>";
// print_r($_SESSION['slotsec']);
// echo "<br>";

//กรณีไม่เอา kc
if($_SESSION['check'][0]!=0){
?>
                    </div>
                    <div class="form-group">
            <div class="row ">
                <div class="col-8">
                <h3>เส้นทาง</h3>
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

        <?php
        $count=0;
        for($i=0;$i<count($_SESSION['eq_id']);$i++){
        ?>
        <div class="form-group">
            <div class="row">
                <div class="col-4 location_name"> 
                    <?=$_SESSION['location'][$i];?>
                    <input type="hidden" name="location_root[]" value="<?=$_SESSION['location'][$i];?>"/>
                </div>
        <div class="col-4" >
                <?php 
                    if(isset($_SESSION['labelpri'][$i])){
                        $checkdie=false;
                        for($j=0;$j<count($_SESSION['labelpri_die']);$j++){
                            if($_SESSION['labelpri'][$i]==$_SESSION['labelpri_die'][$j]){
                                ?>
                                <span id="showfirst<?=$i;?>"></span>
                                <input type="hidden" name="selectlabelpri[]" class="label<?=$i;?>" value="<?=$i;?>"/>
                                <input type="hidden" name="selectslotpri[]"  class="slot<?=$i;?>" value="<?=$i;?>"/>
                                <?php
                                $checkdie=true;
                            }
                        }
                        if($checkdie==false){
                        echo $_SESSION['labelpri'][$i]."/ หมุด:".$_SESSION['slotpri'][$i];
                ?>
                        <input type="hidden" name="selectlabelpri[]" value="<?=$_SESSION['labelpri'][$i];?>"/>
                        <input type="hidden" name="selectslotpri[]" value="<?=$_SESSION['slotpri'][$i];?>"/>
                <?php
                        }
                    }
                ?>
                </div>
                <div class="col-4" id="<?=$_SESSION['eq_id'][$i];?>">
                <?php 
                    if(isset($_SESSION['labelsec'][$i])){
                        $checkdie=false;
                        for($j=0;$j<count($_SESSION['labelpri_die']);$j++){
                            if($_SESSION['labelsec'][$i]==$_SESSION['labelpri_die'][$j]){
                                ?>
                                <span id="show<?=$i;?>"></span>
                        <input type="hidden" name="selectlabelsec[]" id="label<?=$i+1;?>"  value="<?=$i;?>"/>
                        <input type="hidden" name="selectslotsec[]" id="slot<?=$i+1;?>" value="<?=$i;?>"/>
                        <button type="button" 
                            value="<?php if($i==count($_SESSION['eq_id'])-1){echo $_SESSION['eq_id'][$i];}else{echo $_SESSION['eq_id'][$i+1];} ?>" 
                            onclick="slectslot(this.value,'<?=$_SESSION['eq_id'][$i];?>','show<?=$i;?>','showfirst<?=$i+1?>','label<?=$i+1;?>','slot<?=$i+1;?>','<?php if($i==count($_SESSION['eq_id'])-1){echo 'stop';}else{echo 'next';} ?>');"                            data-toggle="modal" 
                            data-target="#modal_terminal"
                            class="btn btn-facebook">เลือก</button>
                            
                                <?php
                                $checkdie=true;
                            }
                        }
                        if($checkdie==false){
                          if(isset($_SESSION['slotsec'][$i])){
                        echo $_SESSION['labelsec'][$i]."/ หมุด:".$_SESSION['slotsec'][$i];
                        ?>
                        <input type="hidden" name="selectlabelsec[]" value="<?=$_SESSION['labelsec'][$i];?>"/>
                        <input type="hidden" name="selectslotsec[]" value="<?=$_SESSION['slotsec'][$i];?>"/>
                        <?php
                        }
                    }
                  }
                  else{
                    ?>
                        <div class="col-4">
                          <?=$_SESSION['mimo'];?>
                          <input type="hidden" name="memo" value="<?=$_SESSION['mimo'];?>">
                        </div>
                        <?php
                  }
                ?>
                </div>
            </div>
        </div>
        <?php
        $count++;
            }
        ?>

<div class="row">
    <div id="showkc" class="col-12"></div>
  </div>
<div class="form-group">
    <div class="row justify-content-center">
        <button type="button" class="btn btn-facebook" id="backblock2" onclick="backpage('3','2')">ย้อนกลับ</button>
        <button type="button" id="nextblock2" class="btn btn-facebook" onclick="conclusion('3','chechblock1')">ถัดไป</button>
    </div>
</div>
<?php
}
elseif($_SESSION['check'][0]==0){
  $src_terminal=array();
$sql=$mysqli->query("SELECT t_id,label
FROM terminal
WHERE eq_id='AB001F01A001' AND t_id LIKE 'pt%'
GROUP BY label ORDER BY t_id ASC");
$result=$sql->num_rows;
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($src_terminal,$row);
}
?>
<div class="form-group">
                        <div class="row justify-content-center">
                          <div class="col-7">
                            <label>เลือกเบอร์โทรศัพท์</label>
                            <select
                              class="form-control form-control-alternative"
                              id="selectteminal"
                              name="teminal"
                              onchange="showterminal(this.value,'repair')"
                            >
                              <option value="" selected>-----เลือกเบอร์โทรศัพท์-----</option>
                              <?php
                                foreach($src_terminal as $value ){
                              ?>
                                <option value="<?=$value["t_id"];?>"><?=$value["label"];?></option>
                              <?php
                                }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row justify-content-center">
                          <div class="col-12" id="SelectTerminal"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row justify-content-center">
                        <button type="button" class="btn btn-facebook" id="backblock2" onclick="backpage('3','2')">ย้อนกลับ</button>
                        </div>
                      </div>
<?php
}
?>




<?php
?>