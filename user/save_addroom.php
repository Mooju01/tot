<?php
include '../connect.php';
session_start();
$location_num=$_POST['location_num'];
$b_eq_id=$_POST['b_eq_id'];
$eq_id=$_POST['eq_id'];
$subeq_id=substr($eq_id,0,8);
//หา p_id มากสุด
$sql=$mysqli->query("SELECT max(p_id) as maxp_id
                    FROM private_point
                    WHERE p_id like '".$subeq_id."%'
                    ");
$result=$sql->num_rows;
if($result>0){
    while($row=$sql->fetch_assoc()){
        //ตัดp_idมากสุดแล้ว+1
        $subp_id=substr($row['maxp_id'],9,11);
        $subp_id=$subp_id+1;
    }
    if($subp_id<10){
        //ถ้าน้อยกว่า 0 ใส่ Z0
        $new_p_id="$subeq_id"."Z0"."$subp_id";
    }else{
        //ถ้ามากกว่า 0 ใส่ Z
        $new_p_id="$subeq_id"."Z"."$subp_id";
    }
    unset($subp_id);
    $insert="INSERT INTO private_point(p_id,eq_id,location,b_eq_id)
            VALUES ('$new_p_id','$eq_id','$location_num','$b_eq_id')
            ";
    if($mysqli->query($insert)){
        //บันทึกข้อมูลลงใน log
        $insert="INSERT INTO log(username,operating,tel,memo)
                VALUES ('".$_SESSION['username']."','addroom','-','เพิ่มห้อง $location_num')";
        if($mysqli->query($insert)){
            //ลบค่าทั้งหมดใน session ยกเว้น username,name และ user_status
            unset($new_p_id);
            if(isset($_SESSION)){
                foreach($_SESSION as $key => $value){
                    if($key!='username' && $key!='user_status' && $key!='name'){
                        unset($_SESSION[$key]);
                    }
                }
            }
            echo "<script>alert('บันทึกข้อมูลของท่านเรียบร้อยแล้ว')</script>";
            echo "<script>window.location='./add_private_room.php'</script>";
        exit(0);

        }else{
            echo "เพิ่มข้อมูลไม่สำเร็จ";
        }
    }else{
        echo "เพิ่มข้อมูลไม่สำเร็จ";
    }
}else{
    echo "เพิ่มข้อมูลไม่สำเร็จ";
}

?>