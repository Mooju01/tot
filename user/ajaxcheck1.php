<?php
include "../connect.php";
session_start();
// $_SESSION['location']=(isset($_POST['location']))?$_POST['location']:NULL;
// $_SESSION['check']=(isset($_POST['Check']))?$_POST['Check']:NULL;
// $_SESSION['eq_id']=(isset($_POST['eq_id']))?$_POST['eq_id']:NULL;
// $_SESSION['labelpri']=(isset($_POST['labelpri']))?$_POST['labelpri']:NULL;
// $_SESSION['slotpri']=(isset($_POST['slotpri']))?$_POST['slotpri']:NULL;
// $_SESSION['labelsec']=(isset($_POST['labelsec']))?$_POST['labelsec']:NULL;
// $_SESSION['slotsec']=(isset($_POST['slotsec']))?$_POST['slotsec']:NULL;

$_SESSION['slot']=(isset($_POST['slot']))?$_POST['slot']:NULL;
$_SESSION['label']=(isset($_POST['label']))?$_POST['label']:NULL;
$_SESSION['newtel']=(isset($_POST['tel']))?$_POST['tel']:NULL;
array_shift($_SESSION['labelpri']);
array_shift($_SESSION['slotpri']);
array_unshift($_SESSION['labelpri'],$_SESSION['label']);
array_unshift($_SESSION['slotpri'],$_SESSION['slot']);

$tel= $_SESSION['tel'];
$newtel= $_POST['tel'];
$_SESSION['telnew']=$newtel;
//print_r($_POST);

//print_r($_SESSION['eq_id']);
//print_r($_SESSION['location']);
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
//echo '<br>';
//print_r($_SESSION['labelpri_die']);
if($_SESSION['check'][0]==0&&count($_SESSION['labelpri_die'])>1)
{
?>
                    </div>
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
                if($i==0){
                    echo $_SESSION['labelpri'][$i]."/ หมุด:".$_SESSION['slotpri'][$i];
                ?>
                        <input type="hidden" name="selectlabelpri[]" value="<?=$_SESSION['labelpri'][$i];?>"/>
                        <input type="hidden" name="selectslotpri[]" value="<?=$_SESSION['slotpri'][$i];?>"/>
                <?php
                }
                else{
                    if(isset($_SESSION['labelpri'][$i])){
                        $checkdie=false;
                        for($j=0;$j<count($_SESSION['labelpri_die']);$j++){
                            if($_SESSION['labelpri'][$i]==$_SESSION['labelpri_die'][$j]){
                                
                                ?>
                                <span id="showfirst<?=$i;?>"></span>
                                <input type="hidden" name="selectlabelpri[]" class="label<?=$i;?>"/>
                                <input type="hidden" name="selectslotpri[]"  class="slot<?=$i;?>"/>
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
                        <input type="hidden" name="selectlabelsec[]" id="label<?=$i+1;?>"/>
                        <input type="hidden" name="selectslotsec[]" id="slot<?=$i+1;?>"/>
                        <button type="button" 
                            value="<?php if($i==count($_SESSION['eq_id'])-1){echo $_SESSION['eq_id'][$i];}else{echo $_SESSION['eq_id'][$i+1];} ?>" 
                            onclick="slectslot(this.value,'<?=$_SESSION['eq_id'][$i];?>','show<?=$i;?>','showfirst<?=$i+1?>','label<?=$i+1;?>','slot<?=$i+1;?>','<?php if($i==count($_SESSION['eq_id'])-1){echo 'stop';}else{echo 'next';} ?>');"
                            data-toggle="modal" 
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
                              <?=$_SESSION['memo'];?>
                              <input type="hidden" name="memo" value="<?=$_SESSION['memo'];?>">
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
        <button type="button" class="btn btn-facebook" id="backblock2" onclick="backpage('4','2')">ย้อนกลับ</button>
        <button type="button" id="nextblock2" class="btn btn-success" onclick="conclusion('4','chechblock1','showdata')">ถัดไป</button>
    </div>
</div>

<!--================================ modal ==================================-->

<!--================================ modal ==================================-->
<?php
}
else{
?>
                    </div>
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
                        
                        echo $_SESSION['labelpri'][$i]."/ slot:".$_SESSION['slotpri'][$i];
                ?>
                        <input type="hidden" name="selectlabelpri[]" value="<?=$_SESSION['labelpri'][$i];?>"/>
                        <input type="hidden" name="selectslotpri[]" value="<?=$_SESSION['slotpri'][$i];?>"/>
                <?php
                        
                    }
                ?>
                </div>
                <div class="col-4">
                <?php 
                    if(isset($_SESSION['labelsec'][$i])){
                        echo $_SESSION['labelsec'][$i]."/ slot:".$_SESSION['slotsec'][$i];
                        ?>
                        <input type="hidden" name="selectlabelsec[]" value="<?=$_SESSION['labelsec'][$i];?>"/>
                        <input type="hidden" name="selectslotsec[]" value="<?=$_SESSION['slotsec'][$i];?>"/>
                        <?php
                        
                    }
                    else{
                        ?>
                      
                          <?=$_SESSION['memo'];?>
                          <input type="hidden" name="memo" value="<?=$_SESSION['memo'];?>">
                    
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
        <button type="button" class="btn btn-facebook" id="backblock2" onclick="backpage('4','3')">ย้อนกลับ</button>
        <button type="button" id="nextblock2" class="btn btn-facebook" onclick="conclusion('4','chechblock1','showdata')">ถัดไป</button>
    </div>
</div>
<?php
}
?>