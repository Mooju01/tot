<?php
include "../connect.php";
session_start();
?>
<?php
    $report=$_POST['report'];
    $date=$_POST['date'];
    $type=$_POST['type'];
    $username=$_POST['username'];
    $location=$_POST['location_root'];
    $_SESSION['eq_id']=$_POST['eq_id'];
    $selectlabelpri=$_POST['selectlabelpri'];

    $selectslotpri=$_POST['selectslotpri'];
    $selectlabelsec=$_POST['selectlabelsec'];
    $selectslotsec=$_POST['selectslotsec'];

    $tel=$_POST['tel'];
    $emp_id=$_POST['emp_id'];
    $memo=$_POST['memo'];
    $Check=$_POST['Check'];
    $page=$_POST['page'];
    ?>
    <?php
    $sql=$mysqli->query("SELECT * FROM employee where emp_id = '".$username."'");
    while($row = $sql->fetch_assoc())
{
    $employee = $row['emp_name'];
}
    ?>
    <div class="form-group">
               <div class="row justify-content-center" >
                 <h3>รายละเอียดการปฏิบัติงาน</h3>
                </div>

              <div class="row">
                <div class="col-6">
                 รายละเอียดการปฏิบัติงาน : <?php echo $report;?>
                <input type="hidden" name="report" value="<?=$report;?>"/>
                </div>
                </div>
                <?php
                 if(isset($_SESSION['telnew'])){
                ?>
                <div class="row">
                <div class="col-6">
                 มีการเปลียนแปลงเบอร์ใหม่: จาก <?php echo $tel;?> เป็น<span style="color: red"><?php echo $_SESSION['telnew'];?></span>
                </div>
                </div>
                <?php
                 }
                ?>
                <div class="row">
                <div class="col-6">
                ประเภทความเสียหาย : <?php echo $type;?>
               <input type="hidden" name="type" value="<?=$type;?>"/>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                วันนที่ในการปฏิบัติงาน : <?php echo $date;?>
                <input type="hidden" name="date" value="<?=$date;?>"/>
                </div>
                </div>
                <div class="row">
                <div class="col-6">
                ชื่อผู้ปฏิบัติงาน : <?php echo $employee;?>
                <input type="hidden" name="employee" value="<?=$employee;?>"/>
                <input type="hidden" name="tel" value="<?=$tel;?>"/>
                <input type="hidden" name="emp_id" value="<?=$emp_id;?>"/>
                </div>
              </div>
              <hr>
</div>
<?php
if($type=='เทอร์มินอลเสียหาย'){
?>
<div class="form-group">
    <div class="row justify-content-center">
            <h3>สรุปเส้นทางใหม่</h3>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-4 head_title">
            <b>สถานที่</b>
        </div>
        <div class="col-4 head_title">
            Terminal Primary
        </div>
        <div class="col-4 head_title">
            Terminal Secondary
        </div>
    </div>
</div>

<form action="updatenewmap.php" method="post">
<?php
foreach($location as $key=>$value){
    ?>
        <div class="form-group">
            <div class="row" style="height:60%;">
                <div class="col-4"> 
                  <?=$location[$key];?>
                  <input type="hidden" name="location[]" value="<?=$location[$key];?>"/>
                </div>
                <div class="col-4" >
                <?php 
                    if(isset($selectlabelpri[$key])){
                        echo $selectlabelpri[$key]."/ หมุด:".$selectslotpri[$key];
                ?>
                        <input type="hidden" name="selectlabelpri[]" value="<?=$selectlabelpri[$key];?>"/>
                        <input type="hidden" name="selectslotpri[]" value="<?=$selectslotpri[$key];?>"/>
                <?php
                    }
                ?>
                </div>
                <div class="col-4">
                <?php 
                    if(isset($selectlabelsec[$key])){
                        echo $selectlabelsec[$key]."/ หมุด:".$selectslotsec[$key];
                        ?>
                        <input type="hidden" name="selectlabelsec[]" value="<?=$selectlabelsec[$key];?>"/>
                        <input type="hidden" name="selectslotsec[]" value="<?=$selectslotsec[$key];?>"/>
                        <?php
                    }
                    else{
                        ?>
                            <?php echo $memo;?>
                        <?php
                        }
                        ?>
                </div>
            </div>
        </div>
        <?php
}
}
?>

<div class="form-group">
    <div class="row justify-content-center">
        
           <button type="button" class="btn btn-facebook" onclick="backpage('5','<?php echo $page; ?>')">ย้อนกลับ</button>  
            <button type="button" class="btn btn-success" onclick="updatnew('5','chechblock1','showdata')">บันทึก</button>

    </div>
</div>
</form>



