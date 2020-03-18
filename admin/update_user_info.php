<?php
include '../connect.php';
session_start();
//เก็บข้อมูลพักงานลงใน array
$emp_info=array(
    'emp_id'=>$_POST['emp_id'],
    'emp_name'=>$_POST['emp_name'],
    'email'=>$_POST['email'],
    'center_id'=>$_POST['center_id'],
    'location'=>$_POST['location'],
    'position_code'=>$_POST['position_code']
);
//update ข้อมูลพนักงาน
$update=$mysqli->query("UPDATE employee
                        SET emp_name='".$emp_info['emp_name']."',
                            emp_email='".$emp_info['email']."',
                            center_id='".$emp_info['center_id']."',
                            location='".$emp_info['location']."',
                            position_code='".$emp_info['position_code']."'
                        WHERE emp_id='".$emp_info['emp_id']."';
                        ");
//บันทึกข้อมูลลงใน log
$insert="INSERT log(username,operating,tel,memo)
        VALUES ('".$_SESSION['username']."','edit_emp','-','แก้ไขข้อมูลพนักงาน ของพนักงานรหัส ".$emp_info['emp_id']."')
        ";
if($mysqli->query($insert)){
    unset($emp_info);
    //ลบค่าทั้งหมดใน session ยกเว้น username,name และ user_status
    if(isset($_SESSION)){
        foreach($_SESSION as $key => $value){
            if($key!='username' && $key!='user_status' && $key!='name'){
                unset($_SESSION[$key]);
            }
        }
    }

    echo "<script>alert('บันทึกข้อมูลเสร็จสิ้น')</script>";
    echo "<script>window.location='./edit_emp_info.php'</script>";
    exit(0);
}else{
    echo "บันทึกข้อมูลไม่สำเร็จ";
}
?>