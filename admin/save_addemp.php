<?php
include '../connect.php';
session_start();

$emp_id=$_POST['emp_id'];
$emp_name=$_POST['emp_name'];
$email=$_POST['email'];
$center_id=$_POST['center_id'];
$location=$_POST['location'];
$position_code=$_POST['position_code'];


//บันทึกข้อมูลลงใน employee
$insert="INSERT INTO employee(emp_id,emp_name,emp_email,position_code,center_id,location)
        VALUES ('$emp_id','$emp_name','$email','$position_code','$center_id','$location')";
if($mysqli->query($insert)){

}else{
    echo "เพิ่มข้อมูลไม่สำเร็จ";
}


//บันทึกข้อมูลลงใน log
$insert="INSERT INTO log(username,operating,tel,memo)
        VALUES ('".$_SESSION['username']."','addemp','-','เพิ่มพนักงาน $emp_id')";
if($mysqli->query($insert)){
    //ลบค่าทั้งหมดใน session ยกเว้น username,name และ user_status
    if(isset($_SESSION)){
        foreach($_SESSION as $key => $value){
        if($key!='username' && $key!='user_status' && $key!='name'){
            unset($_SESSION[$key]);
        }
        }
    }
    unset($emp_id);
    unset($emp_name);
    unset($email);
    unset($center_id);
    unset($location);
    unset($position_code);
    echo "<script>alert('บันทึกข้อมูลของท่านเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='./addemp.php'</script>";
    exit(0);

}else{
    echo "เพิ่มข้อมูลไม่สำเร็จ";
}

?>