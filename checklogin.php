<?php
session_start();
include_once ("connect.php");

$username = $mysqli->real_escape_string($_POST['username']);
$password = md5($_POST['pass']);

//echo $password;
$sql=$mysqli->query("SELECT username,user_status
                        FROM login
                        WHERE username= '$username' AND pass= '$password'
                        ");

if ($num = $sql->num_rows <= 0)
{
    echo "<script>";
    echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
    echo "window.history.back()";
    echo "</script>";
}
else{
    while($row = $sql->fetch_assoc()){
    $_SESSION['username']= $username;
    $_SESSION['user_status']= $row['user_status'];
        if($row['user_status']== 1){
            echo "<script type='text/javascript'>";
            echo "alert('ยินดีต้อนรับเข้าสู่ระบบเเอดมิน ^0^');";
            echo "window.location = './admin/index.php'; ";
            echo "</script>";
        }
        else if($row['user_status']== 2 || $row['user_status']== 3){
            echo "<script type='text/javascript'>";
            echo "alert('ยินดีต้อนรับเข้าสู่ระบบผู้ใช้งาน ^0^');";
            echo "window.location = './user/index.php'; ";
            echo "</script>";
        }
	}
}
?>