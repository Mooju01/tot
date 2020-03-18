<?php
include '../connect.php';
session_start();
$eq_id=$_POST['eq_id'];
$slot=$_POST['slot'];
if($_SESSION['type']=='emp'){
    $sql=$mysqli->query("SELECT employee.emp_id,employee.emp_name,route_tel.tel,employee.location
                        FROM route_tel
                        INNER JOIN emp_tel
                        ON route_tel.route=emp_tel.route
                        INNER JOIN employee
                        ON emp_tel.emp_id=employee.emp_id
                        WHERE eq_id='$eq_id' AND slot='$slot'
                        ");
  }
  elseif($_SESSION['type']=='hotel'){
    $sql=$mysqli->query("SELECT distination.distination_name,hotel.hotel_no,hotel_tel.tel
                        FROM route_tel
                        INNER JOIN hotel_tel
                        ON route_tel.route=hotel_tel.route
                        INNER JOIN hotel
                        ON hotel_tel.hotel_id=hotel.hotel_id AND hotel_tel.hotel_no=hotel.hotel_no
                        INNER JOIN distination
                        ON hotel.hotel_id=distination.b_eq_id
                        WHERE eq_id='$eq_id' AND slot='$slot'
                        ");
  }else{
    $sql=$mysqli->query("SELECT private_point.location,private_tel.tel
                        FROM route_tel
                        INNER JOIN private_tel
                        ON route_tel.route=private_tel.route
                        INNER JOIN private_point
                        ON private_tel.p_id=private_point.p_id
                        WHERE eq_id='$eq_id' AND slot='$slot'
                        ");
  }

$result=$sql->num_rows;
?>
<div class="form-control">
    <div class="row">
    <?php
    if($_SESSION['type']=='emp'){
    ?>
        <div class="col-3">
            รหัสพนักงาน
        </div>
        <div class="col-3">
            ชื่อ-นามสกุล
        </div>
        <div class="col-3">
            เบอร์โทร
        </div>
        <div class="col-3">
            สถานที่นั่ง
        </div>
    <?php
    }elseif($_SESSION['type']=='hotel'){
    ?>
        <div class="col-3">
            ชื่อหอพัก
        </div>
        <div class="col-3">
            หมายเลขห้อง
        </div>
        <div class="col-3">
            เบอร์โทรศัพท์
        </div>
    <?php
    }else{
    ?>
        <div class="col-3">
            ชื่อสถานที่
        </div>
        <div class="col-3">
            เบอร์โทรศัพท์
        </div>
    <?php
    }
    ?>
    </div>
</div>
<?php
while($row=$sql->fetch_assoc()){
?>
<div class="form-control">
    <div class="row">
    <?php
    if($_SESSION['type']=='emp'){
    ?>
        <div class="col-3">
            <?=$row['emp_id'];?>
        </div>
        <div class="col-3">
            <?=$row['emp_name'];?>
        </div>
        <div class="col-3">
            <?=$row['tel'];?>
        </div>
        <div class="col-3">
            <?=$row['location'];?>
        </div>
    <?php
    }elseif($_SESSION['type']=='hotel'){
    ?>
        <div class="col-3">
            <?=$row['distination_name'];?>
        </div>
        <div class="col-3">
            <?=$row['hotel_no'];?>
        </div>
        <div class="col-3">
            <?=$row['tel'];?>
        </div>
    <?php
    }else{
    ?>
        <div class="col-3">
            <?=$row['location'];?>
        </div>
        <div class="col-3">
            <?=$row['tel'];?>
        </div>
    <?php
    }
    ?>
    </div>
</div>
<?php
}
?>