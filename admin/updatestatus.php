<?php   
     include_once "../connect.php";
    // print_r($_POST);ดูค่าที่ส่งมา

     $username=isset($_POST['username'])?$_POST['username']:NULL; //ค่าusername
     $name=isset($_POST['name'])?$_POST['name']:NULL; //ค่าname
     $updateuser=isset($_POST['updateuser'])?$_POST['updateuser']:NULL; //ค่าสถานะ = 1
     $updateadmin=isset($_POST['updateadmin'])?$_POST['updateadmin']:NULL; //ค่าสถานะ = 2
    
       if(isset($_POST['updateuser'])){
       $sql =  "UPDATE  login SET user_status ='2'
                              WHERE username = '$username' ";
 
       $result = mysqli_query($mysqli, $sql) or die ("Error in query: $sql " . mysqli_error());
       mysqli_close($mysqli);
       if($result)
       {
        echo "<script type='text/javascript'>";
        echo "alert('เปลี่ยนสถานะเป็น User เรียบร้อย');";
        echo "window.location = 'manage.php'; ";
        echo "</script>";
        }
        else
        {
        echo "<script type='text/javascript'>";
        echo "alert('มีความผิดพลาด Error!!');";
        echo "</script>";
       }
       }

       if(isset($_POST['updateadmin'])){
        $sql =  "UPDATE  login SET user_status ='1'
                               WHERE username = '$username' ";
                 
        $result = mysqli_query($mysqli, $sql) or die ("Error in query: $sql " . mysqli_error());
        mysqli_close($mysqli);
       if($result)
       {
         echo "<script type='text/javascript'>";
         echo "alert('เปลี่ยนสถานะเป็น admin เรียบร้อย');";
         echo "window.location = 'manage.php'; ";
         echo "</script>";
       }
         else
       {
         echo "<script type='text/javascript'>";
         echo "alert('มีความผิดพลาด Error!!');";
         echo "</script>";
       }
      }
?>