<?php
include_once '../connect.php';
session_start();
$label=$_POST['label'];
$slot=$_POST['slot'];
$sql=$mysqli->query("SELECT equipment.location,terminal.eq_id
                    FROM terminal
                    INNER JOIN equipment
                    ON terminal.eq_id=equipment.eq_id
                    WHERE terminal.label='$label' AND t_id LIKE 'tt%' AND slot='$slot'
                    ");
while($row=$sql->fetch_assoc()){
    $location=$row['location'];
    $last_eq_id=$row['eq_id'];
}

// $sql=$mysqli->query("SELECT memo
//                     FROM jkc_map
//                     WHERE label='$label' AND slot='$slot' 
//                     ");
// $result=$sql->num_rows;
// if($result>0){
//   while($row=$sql->fetch_assoc()){
//     //เจอจุดที่ fig
//     $show_location=$row['memo'];
//   }
// }else{
//   $sql=$mysqli->query("SELECT max(memo)
//                       FROM jkc_map
//                       WHERE memo LIKE 'C%'
//                       ");
//   $result=$sql->num_rows;
//   //kc สายลอย หาตัวมากสุด
//   if($result>0){
//    //ถ้าเจอ 
//    while($row=$sql->fetch_assoc()){
//     $sub_cable=substr($row['memo'],0,1);
//     $sum=$sub_cable+1;
//     $show_location=sprintf('cable%03d',$sum);

//   }
//   }else{
//     $show_location='cable001';
//   }
// }
?>

<div class="form-group">
  <div class="row">
    <div class="col-4 location_name">
      <?=$location;?>
      <input type="hidden" name="location_root[]" value="<?=$location;?>"/>
      <input type="hidden" name="eq_id[]" value="<?=$last_eq_id;?>"/>
    </div>
    <div class="col-4">
      <span class="label_slot"><?=$label;?>/ slot :<?=$slot;?></span>
      <input type="hidden" name="selectlabelpri[]" value="<?=$label;?>"/>
      <input type="hidden" name="selectslotpri[]" value="<?=$slot;?>"/>
    </div>
    <div class="col-4">
      <input type="text" name="memo" class="form-control" placeholder="รายละเอียดปลายทาง"/>
    </div>
  </div>
</div>
<div class="form-group">
  <div class="row justify-content-end">
    <div class="col-md-4">
      <button type="button" data-toggle="modal" data-target="#modal_kcmap" class="btn btn-primary" style="font-size:16px;">
        แผนผัง kc
      </button>
    </div>
  </div>
</div>

<?php
if($_SESSION['b_eq_id']=='AB011' || $_SESSION['b_eq_id']=='AB012'){
?>
<div class="form-group">
            <div class="row justify-content-center">
                <div class="col-12" style="color:red;">
                *หมายเหตุ อาคารหอพัก 37-38 kc จะเชื่อมไปแต่ละชั้น
                </div>
            </div>
</div>
        
<?php
}
?>


<?php
$type=isset($_POST['type'])?$_POST['type']:NULL;

if(isset($type)){
  if($type=='move'){
    ?>
<div class="form-group">
  <div class="row">
    <div class="col-md-4">
      รายละเอียดสถานที่นั่งใหม่<label class="star">*</label>
      <input type="text" name="location_detail" class="form-control"/>
    </div>
  </div>
</div>
    <?php
  }
}
?>


<?php
include_once './modal_kcmap.php';
?>