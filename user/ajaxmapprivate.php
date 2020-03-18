<?php
include_once '../connect.php';
session_start();
    $_SESSION['tel']=$_POST['tel'];
    $_SESSION['label']=$_POST['label'];
    $_SESSION['slot']=$_POST['slot'];

    //search route checkว่าสถานที่นั้นมีกี่ MDF
$sql=$mysqli->query("SELECT *
                    FROM terminal
                    WHERE eq_id LIKE '".$_SESSION['b_eq_id']."F__B%'
                    GROUP BY eq_id");
$count_MDF=$sql->num_rows;



$sql=$mysqli->query("SELECT eq_id
                    FROM route_map
                    WHERE b_eq_id='".$_SESSION['b_eq_id']."'
                    ORDER BY eq_id ASC");
$result=$sql->num_rows;

$array_routemap=array();
if($count_MDF>1){
  //กรณีเจอ MDF หลายตัว
  for($i=0;$i<$result;$i++){
    $row=$sql->fetch_assoc();
    array_push($array_routemap,$row);
  }
  $add_route=array(
    'eq_id'=>$_SESSION['eq_id']
  );
  array_push($array_routemap,$add_route);
//นำตัวที่ได้จอยกับ equipment หาlocation
}else{
  //กรณีเจอ MDF ตัวเดียว
  for($i=0;$i<$result;$i++){
    $row=$sql->fetch_assoc();
    array_push($array_routemap,$row);
  }
}

//search location
$mapArray = array();
foreach($array_routemap as $key){
  $sql=$mysqli->query("SELECT eq_id,location
                    FROM equipment WHERE eq_id='".$key['eq_id']."'");
  $result=$sql->num_rows;
  $row=$sql->fetch_assoc();
  array_push($mapArray,$row);
}
//end search location
unset($array_routemap);

?>



<div class="form-group">
  <div class="row justify-content-center">
    <h3>ข้อมูลจุดประจำชั้น</h3>
  </div>
  <div class="row">
    <div class="col-3">
    </div>
    <div class="col-4">
      สถานที่ : <?=$_SESSION['location'];?>
    </div>
    <div class="col-5">
      เบอร์โทร : <?=$_SESSION['tel'];?>
    </div>
  </div>
</div>
  <hr/>
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

<?php
for($i=0;$i<count($mapArray);$i++){
?>
<div class="form-group">
  <div class="row">
    <div class="col-4 location_name">
      <?=$mapArray[$i]['location'];?>
      <input type="hidden" name="location_root[]" value="<?=$mapArray[$i]['location'];?>"/>
    </div>
    <div class="col-4" id="<?=$mapArray[$i]['eq_id']?>" <?php if($i!=0){?>style="display: none;"<?php } ?>>
      <input type="hidden" name="eq_id[]" value="<?=$mapArray[$i]['eq_id'];?>"/>
      
      <?php if($i==0){
        ?>
        <span class="label_slot"><?=$_SESSION['label'];?>/slot :<?=$_SESSION['slot'];?></span>
        <input type="hidden" name="selectlabelpri[]" value="<?=$_SESSION['label'];?>"/>
        <input type="hidden" name="selectslotpri[]" value="<?=$_SESSION['slot'];?>"/>
        <?php
        }else{
        ?>
        <span id="showfirst<?=$i;?>" class="label_slot"></span>
        <input type="hidden" name="selectlabelpri[]" class="label<?=$i;?>"/>
        <input type="hidden" name="selectslotpri[]"  class="slot<?=$i;?>"/>
        <?php
        }?>
     
    </div>
    <div class="col-4" id="<?=$mapArray[$i]['eq_id']?>" <?php if($i!=0){?>style="display: none;"<?php } ?>>
      <span id="show<?=$i;?>" class="label_slot"></span>
      <input type="hidden" name="selectlabelsec[]" id="label<?=$i+1;?>"/>
      <input type="hidden" name="selectslotsec[]" id="slot<?=$i+1;?>"/>
      <button type="button" 
              value="<?php if($i==count($mapArray)-1){
                             echo $mapArray[$i]['eq_id'];
                            }else{echo $mapArray[$i+1]['eq_id'];} 
                      ?>" 
              onclick="slectslot(this.value,'<?=$mapArray[$i]['eq_id'];?>','show<?=$i;?>','showfirst<?=$i+1?>','label<?=$i+1;?>','slot<?=$i+1;?>','<?php if($i==count($mapArray)-1){echo 'stop';}else{echo 'next';} ?>');" 
              data-toggle="modal" 
              data-target="#modal_terminal"
              class="btn btn-facebook">เลือก</button>
    </div>
  </div>
</div>
<?php
}
unset($mapArray);
?>
<div class="form-group">
  <div class="row">
    <div id="showkc" class="col-12"></div>
  </div>
</div>

<!--================================ modal ==================================-->
<?php
include_once './modal.php';
?>
<!--================================ modal ==================================-->

