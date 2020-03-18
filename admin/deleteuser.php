<?php  include("../connect.php");

       //print_r($_POST);
       $deleteuser=$_POST['deleteuser'];
       $sql = "DELETE FROM login 
                          WHERE username = '$deleteuser' ";
                            
        if ($mysqli->query($sql) === TRUE) {
            echo "<script type='text/javascript'>";
            echo "alert('ลบผู้ใช้งานเรียบร้อย');";
            echo "window.location = 'manage.php'; ";
            echo "</script>";
        } 
        else {
            echo "Error deleting record: " . $mysqli->error;
        }
           $mysqli->close();
    
?>