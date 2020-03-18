<?php
session_start();
include('../connect.php');
			$username = $_POST["username"];
			// $old_pass  = md5($_POST["old_pass"]);
			$pass1  =  $_POST["pass1"];
			$pass2  =  $_POST["pass2"];

	if($pass1 != $pass2)
	{
		    //เช็ครหัสผ่านให้ตรงกัน
		echo "<script type='text/javascript'>";
		echo "alert('password ไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง ');";
		echo "window.location = 'repassword.php'; ";
		echo "</script>";
	}
	elseif((strlen($_POST['pass1'])) <3 )
	{         //strlen เช็ค จำนวนรหัสผ่าน
		echo "<script type='text/javascript'>";
		echo "alert('กรุณากรอกรหัสผ่าน 3 ตัวขั้นไป กรุณากรอกใหม่อีกครั้ง');";
	    echo "window.location = 'repassword.php'; ";
		echo "</script>";
	}
	else
	{    //md5 เข้ารหัสผ่าน
		    $pass1  =  md5($_POST["pass1"]);
			$pass2  =  md5($_POST["pass2"]);

		$sql = "UPDATE login SET  pass ='$pass1'
							 WHERE username = '$username' ";
							 
	$result = mysqli_query($mysqli, $sql) or die ("Error in query: $sql " . mysqli_error());
	}
	mysqli_close($mysqli);
	if($result)
	{   //บันทึกรหัสผ่าน
	echo "<script type='text/javascript'>";
	echo "alert('เปลี่ยน password สำเร็จ');";
		if($_SESSION['user_status']=='3'){
			echo "window.location = '../user/index.php'; ";
		}else{
			echo "window.location = 'index.php'; ";
		}

	echo "</script>";
	}else
	{
	echo "<script type='text/javascript'>";
	echo "alert('Error !!!');";
	echo "window.history.back();";
	echo "</script>";
	}
?>

