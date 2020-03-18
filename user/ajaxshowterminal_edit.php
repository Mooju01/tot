<?php
include_once '../connect.php';
$t_id=$_POST["t_id"];
if($t_id!=""){
$sql=$mysqli->query("SELECT slot , status , tel , label,memo
                    FROM terminal
                    WHERE t_id='$t_id'");
?>
<div class="form-group">
    <div class="row justify-content-center">
        <div class="col-5">
            <span class="title-add_edit"> เลือกสถานะที่ต้องการเปลี่ยน</span>
            <select name="status" class="form-control" required>
                <option value="">---------------เลือกสถานะ-------------</option>
                <option value="available">ว่าง</option>
                <option value="die">เสีย</option>
                <option value="unavailable">ไม่ได้ใช้งาน</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <span class="star">เลือกเบอร์ที่ต้องการแก้ไข</span>
            </div>
        </div>
        <div class ="row">
            <div class ="col-12">
            สถานะ : <span class="available">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>ว่าง
                <span class="used">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>ใช้งาน
                <span class="die">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>เสีย
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12">
        <?php
        //if($t_id>="pt001" && $t_id<="pt006"){
            ?>
            <!-- <h3 style="font-size:16px; text-align:center;color:red;">ไม่สามารถแก้ไข E1-E6 ได้</h3> -->
            <?php
        //}
        //else{
        ?>
        <div class="table-responsive">
            <table class="align-items-center">
                <tbody>
                <?php
                    $count=0;
                        while($row=$sql->fetch_assoc()){
                            if($count==0){
                                echo "<tr>";
                            }   
                    ?>
                                <td class="<?=$row['status'];?>" id="td<?=$row['slot'];?>">
                                <input type="checkbox" name="slot[]" class="check_slot" value="<?=$row['slot'];?>" id="check<?=$row['slot'];?>" 
                                        onclick="check('check<?=$row['slot'];?>','<?=$row['status'];?>','td<?=$row['slot'];?>');" 
                                        
                                        required>
                                <label for="check<?=$row['slot'];?>" style="display:block;width:auto;height:50px;">
                                <?php 
                                                                    if($row['status']=='available'){
                                                                        ?><?=$row['slot'];?><br><?=$row['tel'];?><br><?=$row['memo'];?>
                                                                        <?php 
                                                                        }else{ 
                                                                            echo $row['slot'].'<br>';
                                                                            if($row['tel']=='unavailable'){
                                                                                echo 'ไม่ได้ใช้งาน';
                                                                            }else{
                                                                                echo $row['tel'].'<br>';
                                                                            }
                                                                            echo $row['memo'];
                                                                        }?>
                                </label>
                                </td>
                                
                                
                    <?php
                            $count++;
                            if($count==10){
                                echo "</tr>";
                                $count=0;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        //}
        ?>
    </div>
</div>
<?php
}
?>