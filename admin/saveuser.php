<?php include_once "../connect.php";
       
       $username=$_POST['username'];
       $pass=md5($_POST['pass']);
       $pass2=md5($_POST["pass2"]);
       $user_status=$_POST['user_status'];
       
       if(isset($_POST['submit'])){
       
        $check = "SELECT * FROM login  
                           WHERE username = '$username' ";
    
          $result1 = mysqli_query($mysqli, $check) or die(mysqli_error());
          $num=mysqli_num_rows($result1);
          if($num > 0)
          {
          echo "<script>";
          echo "alert('Username นี้มีการใช้งานเเล้ว!!! กรุณากรอกใหม่อีกครั้ง !');";
          echo "window.history.back();";
          echo "</script>";
          }elseif($pass != $pass2)
          {
          echo "<script type='text/javascript'>";
          echo "alert('password ไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง ');";
          echo "window.history.back();";
          echo "</script>";
          }
          elseif((strlen($_POST['pass'])) <3 )
          {         //strlen เช็ค จำนวนรหัสผ่าน
            echo "<script type='text/javascript'>";
            echo "alert('กรุณากรอกรหัสผ่าน 3 ตัวขั้นไป กรุณากรอกใหม่อีกครั้ง');";
            echo "window.history.back();";
            echo "</script>";
          }
          elseif((strlen($_POST['username'])) != 8 )
          {         //strlen เช็ครหัสพนักงาน
            echo "<script type='text/javascript'>";
            echo "alert('กรุณากรอกรหัสพนักงานให้ถูกต้อง กรุณากรอกใหม่อีกครั้ง');";
            echo "window.history.back();";
            echo "</script>";
          }
          else
          {
                  $pass=md5($_POST['pass']);
                  $pass2=md5($_POST["pass2"]);

            $sql =  "INSERT INTO login (username, pass, user_status)
                VALUES ('$username', '$pass', '$user_status')";
           $result = mysqli_query($mysqli, $sql) or die ("Error in query: $sql " . mysqli_error());   
           mysqli_close($mysqli);
           if($result)
           {
           echo "<script type='text/javascript'>";
           echo "alert('เพิ่มผู้ใช้งานเรียบร้อย');";
           echo "window.location = 'manage.php'; ";
           echo "</script>";
          }
          else{
          echo "<script type='text/javascript'>";
          echo "alert('มีความผิดพลาด Error!!');";
          echo "</script>";
          }
          }
        }
       ?>