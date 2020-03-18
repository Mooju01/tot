<?php
include "../connect.php";
print_r($_POST);
$eq_id=$_POST['eq_id'];
$b_eq_id=$_POST['b_eq_id'];
$floor=$_POST['floor'];
echo $eq_id."<br>";
echo $b_eq_id."<br>";
$eq_id_pic=$b_eq_id."F".$floor;
echo $eq_id_pic;

                $name_file =  $_FILES['pic_kc']['name'];
                $tmp_name =  $_FILES['pic_kc']['tmp_name'];
                $sql = "INSERT INTO kc_pic (eq_id,pic)
                        VALUES ('$eq_id_pic','$name_file')";
                $locate_img ="./pic/kc/$b_eq_id/$floor/";
                echo $name_file."<br>";
                echo $tmp_name."<br>";
                echo $sql."<br>";
                echo $locate_img."<br>";
                move_uploaded_file($tmp_name,$locate_img.$name_file);
                if ($mysqli->query($sql)) {
                    // echo "<script type='text/javascript'>alert('บันทึกข้อมูลเสร็จสิ้น')</script>";
                    // echo "<meta http-equiv ='refresh'content='0;URL=./addkc_map.php'>";
                }
                else{
                    echo "Error: ". $sql . "<br>". mysqli_error($conn);
                }
?>
