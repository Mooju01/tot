<?php
include("../connect.php"); 

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $query = "SELECT * FROM employee WHERE emp_id like'%".$search."%'";
    $result = mysqli_query($mysqli,$query);    
    while($row = mysqli_fetch_array($result) ){
        $p=substr($row['emp_id'],5,8); //รหัสพนักงานนำมา substr เอา3ตัวสุดท้ายเป็นรหัสผ่าน
        $response[] = array("value"=>$row['emp_name'],"label"=>$row['emp_id'],"pass"=>$p);
    }
    echo json_encode($response);
}
exit;
?>