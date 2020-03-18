<?php 
include_once "../connect.php";
session_start();
$label=$_POST["label"];
echo $_SESSION['eq_id'];
if($label!=""){
    $sql=$mysqli->query("SELECT slot , status , label,memo
                        FROM terminal
                        WHERE label='$label' AND eq_id='".$_SESSION['eq_id']."'");
?>
<div class="row">
    <div class="col-md-12">
        สถานะ : <span class="available">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>ว่าง
                <span class="used">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>ใช้งาน
                <span class="die">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>เสีย
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="align-items-center">
                <tbody>     
        <?php
        $count=0;
        while($data=$sql->fetch_assoc()){
            if($count==0){
                echo "<tr>";
            }
        ?>
                        <td class="<?=$data['status'];?>"><a href="#" onclick="selectsec('<?=$data['slot'];?>','<?=$data['label'];?>','<?=$_SESSION['showid'];?>','<?=$_SESSION['showfirstid'];?>','<?=$_SESSION['labelid'];?>','<?=$_SESSION['slotid'];?>','<?=$_SESSION['eq_id_next'];?>','<?=$_SESSION['status'];?>');" 
                                                            data-dismiss="modal"><?=$data['slot'];?><br>
                                                                                <?=$data['memo'];?></a>                      
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
    </div>
</div>
<?php 
}
?>
