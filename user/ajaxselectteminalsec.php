<?php 
//ซ้ำajaxselectteminalsectest.php
session_start();
include_once '../connect.php';
$_SESSION["eq_id_next"]=$_POST['eq_id_next'];
$_SESSION["eq_id"]=$_POST['eq_id'];
$_SESSION["labelid"]=$_POST['labelid'];
$_SESSION["slotid"]=$_POST['slotid'];
$_SESSION["showid"]=$_POST['showid'];
$_SESSION["showfirstid"]=$_POST['showfirstid'];

$status=$_POST['status'];
$_SESSION["status"]=$status;
if($status=='stop'){
    $sql=$mysqli->query("SELECT t_id , label
                        FROM terminal
                        WHERE eq_id='".$_SESSION['eq_id_next']."' AND t_id 
                        LIKE 'st%'
                        GROUP BY label");
}else{
$sql=$mysqli->query("SELECT t_id , label
                    FROM terminal
                    WHERE eq_id='".$_SESSION['eq_id_next']."' AND t_id 
                    LIKE 'pt%'
                    GROUP BY label");
}
?>
<div class="form-group">
    <div class="row justify-content-center">
        <div class="col-6">
            <label> เลือก label</label>
            <select 
            class="form-control form-control-alternative"
            id="selectlocation"
            name="location"
            onchange="showterminalsec(this.value)"
            >
                <option value="" selected
                >-----กรุณาเลือก label-----</option
                >
                    <?php
                    while($row=$sql->fetch_assoc()){
                    ?>
                    <option value="<?php echo $row['label'];?>"><?php echo $row["label"]?></option>
                    <?php
                    }
                    ?>
            </select>
        </div>
    </div>
</div>
<div id="SelectTerminalsec"></div>