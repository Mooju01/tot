<?php
//ย้ายเบอร์
include_once '../connect.php';
session_start();
unset($_SESSION["eq_id_next"]);
unset($_SESSION["eq_id"]);
unset($_SESSION["labelid"]);
unset($_SESSION["slotid"]);
unset($_SESSION['emp_info']);

$selectlabelpri=$_POST['selectlabelpri'];
$selectslotpri=$_POST['selectslotpri'];
$selectlabelsec=$_POST['selectlabelsec'];
$selectslotsec=$_POST['selectslotsec'];
$eq_id=$_POST['eq_id'];
$memo=$_POST['memo'];


    //ถ้าย้ายเบอร์ตั้งแต่ root
    if(isset($_SESSION['newtel']) && $_SESSION['select']='all'){
        $oldtel=$_SESSION['tel'];
        $_SESSION['tel']=$_SESSION['newtel'];
        unset($_SESSION['newtel']);
        //หาว่าเบอร์เดิมใช้อยู่กี่เส้นทาง
        $sql=$mysqli->query("SELECT route
                            FROM route_tel
                            WHERE tel='$oldtel'
                            GROUP BY route
                            ");
        $result=$sql->num_rows;
        //ถ้ามีเส้นทางเดียว ให้ update เบอร์เดิมใน terminal เป็นสถานะ available
        if($result==1){
            $update=$mysqli->query("UPDATE terminal 
                                    SET status='available'
                                    WHERE tel='$oldtel'");
        }
        //update เบอร์ใหม่แก่พนักงาน
        $update=$mysqli->query("UPDATE emp_tel 
                        SET tel='".$_SESSION['tel']."' 
                        WHERE tel='".$oldtel."' AND emp_id='".$_SESSION['emp_id']."'");
    }




//อัพเดท location ของ employee
$update=$mysqli->query("UPDATE employee 
                        SET location='".$_SESSION['location_detail']."' 
                        WHERE emp_id='".$_SESSION['emp_id']."'");

//เช็คว่าเบอร์พ่วงเส้นทางเดียวกัน
//หาเส้นทางเก่า
$sql=$mysqli->query("SELECT type,eq_id,label,tel,slot
                    FROM route_tel
                    WHERE route='".$_SESSION['route']."'
                    ");
$result=$sql->num_rows;
$arrayoldmap=array();
for($i=0;$i<$result;$i++){
    $row=$sql->fetch_assoc();
    array_push($arrayoldmap,$row);
}
foreach($arrayoldmap as $key=>$value){
    //นำเส้นทางเก่าไปเช็คว่ามีเส้นทางไหนซ้ำกับเส้นทางอื่นไหม
    $sql=$mysqli->query("SELECT route
                        FROM route_tel
                        WHERE type='".$value['type']."' 
                        AND eq_id='".$value['eq_id']."'
                        AND label='".$value['label']."'
                        AND tel='".$value['tel']."'
                        AND slot='".$value['slot']."'");
    $result=$sql->num_rows;
    //ถ้ามีให้อัพเดทเส้นทางเก่าใน terminal ให้มีสถานะ available
    if($result==1){
        $terminal_A=substr($value['eq_id'],8);
        $terminal_A=substr($terminal_A,0,1);
        if($terminal_A =="A" && $value['type']=="pt"){
            $update=$mysqli->query("UPDATE terminal
                                    SET status='available'
                                    WHERE eq_id='".$value['eq_id']."'
                                    AND label='".$value['label']."'
                                    AND slot='".$value['slot']."'");
        }else{
           $update=$mysqli->query("UPDATE terminal
                                SET tel=NULL,status='available'
                                WHERE eq_id='".$value['eq_id']."'
                                AND label='".$value['label']."'
                                AND slot='".$value['slot']."'");
        }
    }
}

unset($arrayoldmap);

//ลบเส้นทางเก่าทั้งหมด
$delete=$mysqli->query("DELETE FROM route_tel WHERE route = '".$_SESSION['route']."'");

$first_label=array_shift($selectlabelpri);
$first_slot=array_shift($selectslotpri);
$first_label_sec=array_shift($selectlabelsec);
$first_slot_sec=array_shift($selectslotsec);
array_shift($eq_id);
//update terminal primary ของ pabx
$update=$mysqli->query("UPDATE terminal
                        SET status='used'
                        WHERE tel='".$_SESSION['tel']."' AND label='$first_label'");
//เพิ่มerminal primary ของ pabx ลงใน route_tel
$insert="INSERT INTO route_tel(route,type,eq_id,label,tel,slot)
        VALUES ('".$_SESSION['route']."','pt','AB001F01A001','$first_label','".$_SESSION['tel']."','$first_slot')";
if ($mysqli->query($insert) === TRUE) {

} else {
    $status_sql=false;
    echo "Error: " . $insert . "<br>" . $mysqli->error;
}
//update terminal primary ของ pabx
$update=$mysqli->query("UPDATE terminal
                        SET status='used',tel='".$_SESSION['tel']."'
                        WHERE label='$first_label_sec' AND slot='$first_slot_sec'
                        ");
//เพิ่ม sencondary ลงใน route_tel
$insert="INSERT INTO route_tel(route,type,eq_id,label,tel,slot)
        VALUES ('".$_SESSION['route']."','st','AB001F01A001','".$first_label_sec."','".$_SESSION['tel']."','".$first_slot_sec."')";
if ($mysqli->query($insert) === TRUE) {
} else {
    $status_sql=false;
    echo "Error: " . $insert . "<br>" . $mysqli->error;
}




foreach($eq_id as $key=>$value){

    //หา eq_id และ t_id เพื่อบันทึกลงใน route_tel
    $sql=$mysqli->query("SELECT t_id
                        FROM terminal
                        WHERE label='$selectlabelpri[$key]' AND slot='$selectslotpri[$key]' AND eq_id='$eq_id[$key]'
                        ");
    while($row=$sql->fetch_assoc()){
        $type=substr($row['t_id'],0,2);
        $update=$mysqli->query("UPDATE terminal
                                SET status='used',tel='".$_SESSION['tel']."'
                                WHERE label='$selectlabelpri[$key]' AND slot='$selectslotpri[$key]'");
        
        //เพิ่มเส้นทางเบอร์ที่ย้ายใน route_tel
        if($type=='tt'){
            $insert="INSERT INTO route_tel(route,type,eq_id,label,tel,slot,memo)
                    VALUES ('".$_SESSION['route']."','tt','".$eq_id[$key]."','".$selectlabelpri[$key]."','".$_SESSION['tel']."','".$selectslotpri[$key]."','$memo')";
        }else{
            $insert="INSERT INTO route_tel(route,type,eq_id,label,tel,slot)
                    VALUES ('".$_SESSION['route']."','pt','".$eq_id[$key]."','".$selectlabelpri[$key]."','".$_SESSION['tel']."','".$selectslotpri[$key]."')";
        }
        if ($mysqli->query($insert) === TRUE) {
        } else {
            echo "Error: " . $insert . "<br>" . $mysqli->error;
        }
    }


    if(isset($selectlabelsec[$key]) && isset($selectslotsec[$key])){
        $update=$mysqli->query("UPDATE terminal
                                SET status='used',tel='".$_SESSION['tel']."'
                                WHERE label='$selectlabelsec[$key]' AND slot='$selectslotsec[$key]'");
            $insert = "INSERT INTO route_tel(route, type, eq_id,label,tel,slot)
                        VALUES ('".$_SESSION['route']."', 'st','".$eq_id[$key]."','".$selectlabelsec[$key]."','".$_SESSION['tel']."','".$selectslotsec[$key]."')";
            if ($mysqli->query($insert) === TRUE) {
            } else {
                echo "Error: " . $insert . "<br>" . $mysqli->error;
            }
    }
}


if(isset($oldtel)){
    $insert="INSERT INTO log (username,operating,tel,memo) 
            VALUES('".$_SESSION['username']."','move','".$_SESSION['tel']."','ย้ายและเปลี่ยนเบอร์โทรศัพท์ จากเบอร์ $oldtel เป็น ".$_SESSION['tel']."')";
}else{
    $insert="INSERT INTO log (username,operating,tel,memo) 
            VALUES('".$_SESSION['username']."','move','".$_SESSION['tel']."','-')";
}

        
 if($mysqli->query($insert)){
    $type_add=$_SESSION['type'];
    //ลบค่าทั้งหมดใน session ยกเว้น username,name และ user_status
    if(isset($_SESSION)){
        foreach($_SESSION as $key => $value){
        if($key!='username' && $key!='user_status' && $key!='name'){
            unset($_SESSION[$key]);
        }
        }
    }
    unset($selectlabelpri);
    unset($selectslotpri);
    unset($selectlabelsec);
    unset($selectslotsec);
    unset($selectlabelpri);
    
    echo "<script>alert('บันทึกข้อมูลของท่านเรียบร้อยแล้ว')</script>";
    echo "<script>window.location='./MoveTel.php'</script>";
    exit(0);
 }else{
    echo "เพิ่มข้อมูลไม่สำเร็จ";
 }



?>