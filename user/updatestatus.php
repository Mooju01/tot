<?php
include '../connect.php';
session_start();
$t_id=$_POST['t_id'];
$eq_id=$_POST['eq_id'];
$status=$_POST['status'];
$slot=$_POST['slot'];

$sql=$mysqli->query("SELECT label
                    FROM terminal
                    WHERE t_id='$t_id' 
                    GROUP BY t_id
                    ");
while($row=$sql->fetch_assoc()){
    $label=$row['label'];
}

$subt_id=substr($t_id,0,2);
if($eq_id=='AB001F01A001' && $subt_id=='pt'){
    foreach($slot as $key=>$value){
        $update=$mysqli->query("UPDATE terminal
                                SET status='$status'
                                WHERE t_id='$t_id' AND slot='$slot[$key]' AND eq_id='$eq_id'
                                ");
        $insert="INSERT INTO log (username,operating,tel,memo) VALUES('".$_SESSION['username']."','edit_status','-','เปลี่ยสถานะเป็น $status slot ที่ $slot[$key]  label=$label t_id=$t_id')";
        if($mysqli->query($insert)){
        }else{
            echo "เพิ่มข้อมูลไม่สำเร็จ";
        }
    }
}elseif($status=='unavailable'){
    foreach($slot as $key=>$value){
        $update=$mysqli->query("UPDATE terminal
                                SET status='$status',tel='unavailable'
                                WHERE t_id='$t_id' AND slot='$slot[$key]' AND eq_id='$eq_id'
                                ");
        $insert="INSERT INTO log (username,operating,tel,memo) VALUES('".$_SESSION['username']."','edit_status','-','เปลี่ยสถานะเป็น $status slot ที่ $slot[$key]  label=$label t_id=$t_id')";
        if($mysqli->query($insert)){
        }else{
            echo "เพิ่มข้อมูลไม่สำเร็จ";
        }
    }
}else{
    foreach($slot as $key=>$value){
        $update=$mysqli->query("UPDATE terminal
                                SET status='$status',tel=NULL
                                WHERE t_id='$t_id' AND slot='$slot[$key]' AND eq_id='$eq_id'
                                ");
        $insert="INSERT INTO log (username,operating,tel,memo) VALUES('".$_SESSION['username']."','edit_status','-','เปลี่ยสถานะเป็น $status slot ที่ $slot[$key]  label=$label t_id=$t_id')";
        if($mysqli->query($insert)){
        }else{
            echo "เพิ่มข้อมูลไม่สำเร็จ";
        }
    }
}


//ลบค่าทั้งหมดใน session ยกเว้น username,name และ user_status
if(isset($_SESSION)){
    foreach($_SESSION as $key => $value){
        if($key!='username' && $key!='user_status' && $key!='name'){
            unset($_SESSION[$key]);
        }
    }
}
    echo "<script>alert('บันทึกข้อมูลของท่านเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='./edit_teminal.php'</script>";
    exit(0);

?>