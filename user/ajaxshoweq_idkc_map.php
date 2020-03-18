<?php
include '../connect.php';
$b_eq_id=$_POST['b_eq_id'];
$floor=$_POST['floor'];
//หา eq_id ทั้งหมด
$sql=$mysqli->query("SELECT terminal.eq_id,equipment.location
                    FROM terminal
                    INNER JOIN equipment
                    ON terminal.eq_id=equipment.eq_id
                    WHERE terminal.eq_id LIKE '".$b_eq_id."F".$floor."C%'
                    GROUP BY terminal.eq_id
                    ");
$eq_info=array();
$result=$sql->num_rows;
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($eq_info,$row);
}

?>
<div class="row justify-content-center">
                    <div class="col-12">
                      <span class="title-add_edit">ที่อยู่ Equipment<span class="star">*</span> </span>
                      <select name="eq_id"class="form-control">
                        <option value="" selected>----------เลือกที่อยู่ equipment---------</option>
                      <?php
                        foreach($eq_info as $value){
                        ?>
                        <option value="<?=$value['eq_id'];?>"><?=$value['location'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>

<?php
?>