<?php
include_once "../connect.php";
$t_id=$_POST["t_id"];
$action=$_POST["action"];
if($t_id!=""){
$sql=$mysqli->query("SELECT slot , status , tel , label
                    FROM terminal
                    WHERE t_id='$t_id'");
?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <<span class="star">เลือกเบอร์ที่ต้องการ</<span>
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
        <div class="table-responsive">
            <table class="align-items-center">
                <tbody>
                <?php
                    $count=0;
                        while($row=$sql->fetch_assoc()){
                            if($count==0){
                                echo "<tr>";
                            }
                            if($action=='add'){
                    ?>
                                <td class="<?=$row['status'];?>">
                                    <a href="#" onclick="sel_terminal('<?=$row['tel'];?>','<?=$row['slot'];?>','<?=$row['label'];?>');"> 
                                        <?=$row['slot'];?><br><?=$row['tel'];?>
                                    </a>
                                </td>
                    <?php
                            }elseif($action=='show'){
                    ?>
                                <td class="<?=$row['status'];?>"><a href="#" data-toggle="modal" 
                                                                data-target="#modal_test"
                                                                onclick="viewslot('<?=$row['slot'];?>','<?=$t_id;?>');"><?=$row['slot'];?><br><?=$row['tel'];?></a></td>
                                <!--modal add slot-->
                                <div class="modal fade" id="modal_test" tabindex="1" role="dialog" aria-labelledby="Modalterminal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Terminal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="showslot"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                    <?php
                            }elseif($action=='move'){
                    ?>
                                <td class="<?=$row['status'];?>">
                                <?php 
                                if($row['status']=='available'){
                                    ?>
                                    <a href="#" onclick="selectprimaryterminal('<?=$row['slot'];?>','<?=$row['label'];?>','<?=$row['tel'];?>');"><?=$row['slot'];?><br><?=$row['tel'];?></a>
                                    <?php
                                }else{
                                    echo $row['slot'].'<br>';
                                    if($row['tel']=='unavailable'){
                                        echo 'ไม่ได้ใช้งาน';
                                    }else{
                                        echo $row['tel'];
                                    }
                                }?> 
                                </td>
                    <?php
                            }elseif($action=='change'){
                    ?>
                                <td class="<?=$row['status'];?>">
                                <?php
                                if($row['status']=='available'){
                                ?>
                                    <a href="#" onclick="selectprimaryterminal('<?=$row['slot'];?>','<?=$row['label'];?>');"><?=$row['slot'];?><br><?=$row['tel'];?></a></td>
                                <?php
                                }else{
                                    echo $row['slot'].'<br>';
                                    if($row['tel']=='unavailable'){
                                        echo 'ไม่ได้ใช้งาน';
                                    }else{
                                        echo $row['tel'];
                                    }
                                }
                                ?>
                                
                    <?php
                            }
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
    </div>
</div>
<?php
}
?>