<?php
include '../connect.php';
session_start();
$_SESSION['type_phone']=$_POST['type_phone'];
//search tel
$src_terminal=array();
$sql=$mysqli->query("SELECT t_id,label
                    FROM terminal
                    WHERE eq_id='AB001F01A001' AND t_id LIKE 'pt%'
                    GROUP BY label");
$result=$sql->num_rows;
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($src_terminal,$row);
}
//search tel end

if($_SESSION['type_phone']=='ipphone'){
    ?>
<form action="#" method="post" id="frm_ipphone">
<div class="form-group">
    <div class="row justify-content-center">
        <div class="col-7">
            <span class="title-add">
                กรอกเบอร์โทรศัพท์<span class="star">*</span>
            </span>
            <input type="text" name="ip_tel" id="ip_tel" class="form-control" maxlength="4">
        </div>
    </div>
</div>
<div class="from-group">
    <div class="row justify-content-center">
            <a href="AddTel.php" class="btn btn-facebook"> ย้อนกลับ</a>
            <button type="button" class="btn btn-facebook" onclick="addiptel();">
                ถัดไป
            </button>
    </div>
</div>
</form>
<?php
}else{
    ?>
<div class="row" id="block3">
    <div class="col-12">
        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-7">
                    <span class="title-add">เลือกเบอร์โทรศัพท์<span class="star">*</span></span>
                    <select class="form-control form-control-alternative" id="selectteminal" name="teminal"
                        onchange="showterminal(this.value,'add')">
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
                <a href="AddTel.php" class="btn btn-facebook"> ย้อนกลับ</a>
            </div>
        </div>
    </div>
</div>
<?php
}
?>