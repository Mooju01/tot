<?php
include '../connect.php';
session_start();
//เช็คว่าเป็น ip phone หรือไม่
if($_SESSION['type_phone']!='ipphone'){
    $labelpri=$_POST['labelpri'];
    $slotpri=$_POST['slotpri'];
    $labelsec=$_POST['labelsec'];
    $slotsec=$_POST['slotsec'];
    //หาเส้นทาง เพื่ออัพเดท terminal
    $sql=$mysqli->query("SELECT type,eq_id,label,tel,slot
                        FROM route_tel
                        WHERE route='".$_SESSION['route']."'
                        ");
    $result=$sql->num_rows;
    $arraymap=array();
    for($i=0;$i<$result;$i++){
        $row=$sql->fetch_assoc();
        array_push($arraymap,$row);
    }
    foreach($arraymap as $key=>$value){
    //นำเส้นทางไปเช็คว่าซ้ำกับเส้นทางไหนไหม
        $sql=$mysqli->query("SELECT route
                            FROM route_tel
                            WHERE type='".$value['type']."' 
                            AND eq_id='".$value['eq_id']."'
                            AND label='".$value['label']."'
                            AND tel='".$value['tel']."'
                            AND slot='".$value['slot']."'
                            ");
        $result=$sql->num_rows;
        //ถ้าไม่มีให้อัพเดทเส้นทางเก่าใน terminal ให้มีสถานะ available
        if($result==1){
            $terminal_A=substr($value['eq_id'],8);
            $terminal_A=substr($terminal_A,0,1);
            if($terminal_A=="A" && $value['type']=="pt"){
                
                $update=$mysqli->query("UPDATE terminal
                                        SET status='available'
                                        WHERE eq_id='".$value['eq_id']."'
                                        AND label='".$value['label']."'
                                        AND slot='".$value['slot']."'
                                        ");
            }
            else{
                $update=$mysqli->query("UPDATE terminal
                                        SET tel=NULL,status='available'
                                        WHERE tel='".$_SESSION['tel']."'
                                        AND label='".$value['label']."'
                                        AND slot='".$value['slot']."'
                                        ");
            }
        }
    }
    //ลบเส้นทางใน route_tel
    $delete=$mysqli->query("DELETE FROM route_tel
                            WHERE route='".$_SESSION['route']."'
                            ");
}


if($_SESSION['type']=='emp'){
    // $radio_check=$_POST['radio_check'];
    //ลบเบอร์ใน emp_tel
    $delete=$mysqli->query("DELETE FROM emp_tel
                            WHERE route='".$_SESSION['route']."'
                            ");
    // //ถ้าเลือกลบทั้งหมด
    // if($radio_check=='all'){
    // $delete=$mysqli->query("DELETE FROM employee
    //                         WHERE emp_id='".$_SESSION['emp_id']."' 
    //                         ");

    // $insert="INSERT INTO log (username,operating,tel,memo) 
    //         VALUES('".$_SESSION['username']."','delete_emp','-','Delete employee ".$_SESSION['emp_id']."')";
    // if($mysqli->query($insert)){
    // }else{}
    // }
}elseif($_SESSION['type']=='hotel'){
    print_r($slotpri);
    if($_SESSION['hotel_id']=='AB011' || $_SESSION['hotel_id']=='AB012'){
        $lastslot=array_pop($slotpri);
        //อัพเดทชั้นอื่นๆที่พ่วงต่อกันอยู่
        $update=$mysqli->query("UPDATE terminal
                                SET tel=NULL , status='available'
                                WHERE eq_id LIKE '".$_SESSION['hotel_id']."%' AND slot='$lastslot'
                            ");
    }
    //ลบเบอร์ใน hotel_tel
    $delete=$mysqli->query("DELETE FROM hotel_tel
                            WHERE route='".$_SESSION['route']."'
                            ");
}else{
    //ลบเบอร์ใน private_tel
    $delete=$mysqli->query("DELETE FROM private_tel
                            WHERE route='".$_SESSION['route']."'
                            ");

}


//log user ลบเบอร์ $_SESSION['tel']
$insert="INSERT INTO log (username,operating,tel,memo) 
        VALUES('".$_SESSION['username']."','delete','".$_SESSION['tel']."','-')";
if($mysqli->query($insert)){
    $type_delete=$_SESSION['type'];
    //ลบค่าทั้งหมดใน session ยกเว้น username,name และ user_status
    if(isset($_SESSION)){
        foreach($_SESSION as $key => $value){
        if($key!='username' && $key!='user_status' && $key!='name'){
            unset($_SESSION[$key]);
        }
        }
    }

    echo "<script>alert('ลบข้อมูลของท่านเรียบร้อยแล้ว')</script>";
    if($type_delete=='emp'){
        unset($type_delete);
        echo "<script>window.location='./DeleteTel.php'</script>";
        exit(0);
    }elseif($type_delete=='hotel'){
        unset($type_delete);
        echo "<script>window.location='./DeleteTel_hotel.php'</script>";
        exit(0);
    }else{
        unset($type_delete);
        echo "<script>window.location='./DeleteTel_private.php'</script>";
        exit(0);
    }

}else{
    echo "เพิ่มข้อมูลไม่สำเร็จ";
}




?>