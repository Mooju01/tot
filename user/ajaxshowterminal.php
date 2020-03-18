<?php
include '../connect.php';
session_start();
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
                <span class="star">เลือกเบอร์ที่ต้องการ</span>
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
                                if($_SESSION['user_status']=='3'){
                                    ?>
                                    <td class="<?=$row['status'];?>">
                                        <a href="#" onclick="sel_terminal('<?=$row['tel'];?>','<?=$row['slot'];?>','<?=$row['label'];?>');"> 
                                            <?=$row['slot'];?>
                                            <br>
                                            <?=$row['tel'];?>
                                        </a>
                                    </td>
                                    <?php
                                }else{
                    ?>
                                <td class="<?=$row['status'];?>">
                                <?php 
                                if($row['status']=='available'){
                                    ?>
                                <a href="#" onclick="sel_terminal('<?=$row['tel'];?>','<?=$row['slot'];?>','<?=$row['label'];?>');"> <?=$row['slot'];?><br><?=$row['tel'];?></a>
                                <?php
                                }else{
                                    echo $row['slot'].'<br>';
                                    if($row['tel']=='unavailable'){
                                        echo 'ไม่ได้ใช้งาน';
                                    }else{
                                        echo $row['tel'];
                                    }
                                }
                                }?>
                                </td>
                    <?php
                            }elseif($action=='show'){
                    ?>
                                <td class="<?=$row['status'];?>"><a href="#" data-toggle="modal" 
                                                                data-target="#modal_test"
                                                                onclick="viewslot('<?=$row['slot'];?>','<?=$t_id;?>');"><?=$row['slot'];?><br><?=$row['tel'];?></a></td>
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
                            }elseif($action=='repair'){
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
                                }elseif($action=='repair_hotel'){
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