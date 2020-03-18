<?php
include '../connect.php';
session_start();
foreach($_SESSION['tel_info'] as $key =>$value){
    if($value['type_phone']!='ipphone'){
        $sql=$mysqli->query("SELECT type,eq_id,label,tel,slot
                            FROM route_tel
                            WHERE route='".$value['route']."'
                            ");
        $result=$sql->num_rows;
        $arraymap=array();
        for($i=0;$i<$result;$i++){
            $row=$sql->fetch_assoc();
            array_push($arraymap,$row);
        }
        foreach($arraymap as $key=>$value2){
        //นำเส้นทางไปเช็คว่าซ้ำกับเส้นทางไหนไหม
            $sql=$mysqli->query("SELECT route
                                FROM route_tel
                                WHERE type='".$value2['type']."' 
                                AND eq_id='".$value2['eq_id']."'
                                AND label='".$value2['label']."'
                                AND tel='".$value2['tel']."'
                                AND slot='".$value2['slot']."'
                                ");
            $result=$sql->num_rows;
            //ถ้าไม่มีให้อัพเดทเส้นทางเก่าใน terminal ให้มีสถานะ available
            if($result==1){
                $terminal_A=substr($value2['eq_id'],8);
                $terminal_A=substr($terminal_A,0,1);
                if($terminal_A=="A" && $value2['type']=="pt"){
                    
                    $update=$mysqli->query("UPDATE terminal
                                            SET status='available'
                                            WHERE eq_id='".$value2['eq_id']."'
                                            AND label='".$value2['label']."'
                                            AND slot='".$value2['slot']."'
                                            ");
                }
                else{
                    $update=$mysqli->query("UPDATE terminal
                                            SET tel=NULL,status='available'
                                            WHERE tel='".$value2['tel']."'
                                            AND label='".$value2['label']."'
                                            AND slot='".$value2['slot']."'
                                            ");
                }
            }
        }
        //ลบเส้นทางใน route_tel
            $delete=$mysqli->query("DELETE FROM route_tel
                                    WHERE route='".$value['route']."'
                                    ");
    }

    $delete=$mysqli->query("DELETE FROM emp_tel
                            WHERE route='".$value['route']."'
                            ");
    //เพิ่ม log ลบเบอร์
    $insert="INSERT INTO log (username,operating,tel,memo) 
            VALUES('".$_SESSION['username']."','delete','".$value['tel']."','-')";
    if($mysqli->query($insert)){
    }else{
    }
}

//ลบ employee
$delete=$mysqli->query("DELETE FROM employee
                        WHERE emp_id='".$_SESSION['emp_id']."' 
                    ");
//log user ลบ user
$insert="INSERT INTO log (username,operating,tel,memo) 
        VALUES('".$_SESSION['username']."','delete_emp','-','ลบพนักงานรหัส ".$_SESSION['emp_id']."')";
if($mysqli->query($insert)){
    //ลบค่าทั้งหมดใน session ยกเว้น username,name และ user_status
    if(isset($_SESSION)){
        foreach($_SESSION as $key => $value){
            if($key!='username' && $key!='user_status' && $key!='name'){
                unset($_SESSION[$key]);
            }
        }
    }

    echo "<script>alert('ลบข้อมูลเรียบร้อย')</script>";
    echo "<script>window.location='./delete_emp.php'</script>";
    exit(0);
    

}else{
    echo "เพิ่มข้อมูลไม่สำเร็จ";
}

?>