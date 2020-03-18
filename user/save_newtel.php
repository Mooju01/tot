<?php
//addtel
include_once '../connect.php';
session_start();
//หาเลขroute
do{
    $route=md5(uniqid(rand(), true));
    $sql=$mysqli->query("SELECT route FROM route_tel WHERE route='$route'");
    $result=$sql->num_rows;
}while($result>0);

if($_SESSION['type']=='emp'){
    //เอา emp_id จาก emp_info
    foreach($_SESSION['emp_info'] as $value){
        $emp_id=$value['emp_id'];
    }
}


//ถ้าเป็น ip phone
if($_SESSION['type_phone']=='ipphone'){
    // //หาว่ามี emp_id ใน emp_tel กี่ตัว
    // $sql=$mysqli->query("SELECT emp_id
    //                     FROM emp_tel
    //                     WHERE emp_id='$emp_id'");
    // $result=$sql->num_rows;
    // //มี1ตัว ให้อัพเดท
    // if($result == 1){
    //     $update=$mysqli->query("UPDATE emp_tel
    //                             SET tel='".$_SESSION['tel']."',route='$route',type_phone='ipphone'
    //                             WHERE emp_id='$emp_id'
    //                             ");
    // }else{
        //else บันทึกลง
        if($_SESSION['type']=='emp'){
            $insert="INSERT INTO emp_tel(emp_id,tel,route,type_phone)
                    VALUES ('$emp_id','".$_SESSION['tel']."','$route','ipphone')";
            if ($mysqli->query($insert) === TRUE) {
            } else {
                $status_sql=false;
                echo "Error: " . $insert . "<br>" . $mysqli->error;
            }
        }elseif($_SESSION['type']=='private'){
            $insert="INSERT INTO private_tel(p_id,tel,route,type_phone)
                    VALUES ('".$_SESSION['p_id']."','".$_SESSION['tel']."','$route','ipphone')";
            if ($mysqli->query($insert) === TRUE) {
            } else {
                $status_sql=false;
                echo "Error: " . $insert . "<br>" . $mysqli->error;
            }
        }
    //}
}else{
    //กรณีเิ่มเบอร์ธรรมดา
    $selectlabelpri=$_POST['selectlabelpri'];
    $selectslotpri=$_POST['selectslotpri'];
    $selectlabelsec=$_POST['selectlabelsec'];
    $selectslotsec=$_POST['selectslotsec'];
    $eq_id=$_POST['eq_id'];
    $memo=$_POST['memo'];
    $first_label=array_shift($selectlabelpri);
    $first_slot=array_shift($selectslotpri);
    $first_label_sec=array_shift($selectlabelsec);
    $first_slot_sec=array_shift($selectslotsec);
    array_shift($eq_id);

    //update terminal primary ของ pabx
    $update=$mysqli->query("UPDATE terminal 
                            SET status='used' 
                            WHERE label='$first_label' AND tel='".$_SESSION['tel']."'");
    //เพิ่มerminal primary ของ pabx ลงใน route_tel
    $insert="INSERT INTO route_tel(route,type,eq_id,label,tel,slot)
            VALUES ('$route','pt','AB001F01A001','".$first_label."','".$_SESSION['tel']."','".$first_slot."')";
    if ($mysqli->query($insert) === TRUE) {
        
    } else {
    $status_sql=false;
        echo "Error: " . $insert . "<br>" . $mysqli->error;
    }
    //เพิ่ม sencondary ลงใน route_tel
    $insert="INSERT INTO route_tel(route,type,eq_id,label,tel,slot)
            VALUES ('$route','st','AB001F01A001','".$first_label_sec."','".$_SESSION['tel']."','".$first_slot_sec."')";
    if ($mysqli->query($insert) === TRUE) {

    } else {
    $status_sql=false;
        echo "Error: " . $insert . "<br>" . $mysqli->error;
    }
    //อัพเดททั้ง primary และ secondary
    $update=$mysqli->query("UPDATE terminal 
                            SET tel='".$_SESSION['tel']."',status='used' 
                            WHERE label='".$first_label_sec."' AND slot='".$first_slot_sec."'");

    foreach($eq_id as $key=>$value){
        //update primary
        //หา primary ว่าแต่ละตัวเป็น pt หรือ tt
        $sql=$mysqli->query("SELECT t_id 
                            FROM terminal 
                            WHERE label='".$selectlabelpri[$key]."' AND slot='".$selectslotpri[$key]."' AND eq_id='$eq_id[$key]'
                            ");
        while($row=$sql->fetch_assoc()){
            $type=substr($row['t_id'],0,2);
            if($type=='tt'){
                $insert="INSERT INTO route_tel(route,type,eq_id,label,tel,slot,memo)
                        VALUES ('$route','tt','".$eq_id[$key]."','".$selectlabelpri[$key]."','".$_SESSION['tel']."','".$selectslotpri[$key]."','$memo')";
            }else{
                $insert="INSERT INTO route_tel(route,type,eq_id,label,tel,slot)
                        VALUES ('$route','pt','".$eq_id[$key]."','".$selectlabelpri[$key]."','".$_SESSION['tel']."','".$selectslotpri[$key]."')";
            }
            if ($mysqli->query($insert) === TRUE) {
            }else {
                $status_sql=false;
                echo "Error: " . $insert . "<br>" . $mysqli->error;
            }
        }
        //เพิ่ม secondary ลงใน route_tel
        if(isset($selectlabelsec[$key]) && isset($selectslotsec[$key])){
                $insert="INSERT INTO route_tel(route,type,eq_id,label,tel,slot)
                        VALUES ('$route','st','".$eq_id[$key]."','".$selectlabelsec[$key]."','".$_SESSION['tel']."','".$selectslotsec[$key]."')";
                if ($mysqli->query($insert) === TRUE) {

                } else {
                    echo "Error: " . $insert . "<br>" . $mysqli->error;
                }
        }
        //อัพเดททั้ง primary และ secondary
        $update=$mysqli->query("UPDATE terminal 
                                SET tel='".$_SESSION['tel']."',status='used' 
                                WHERE label='".$selectlabelsec[$key]."' AND slot='".$selectslotsec[$key]."'");
    }




    if($_SESSION['type']=='emp'){
        $insert="INSERT INTO emp_tel(emp_id,tel,route,type_phone)
                VALUES ('$emp_id','".$_SESSION['tel']."','$route','normal_tel')";
        if ($mysqli->query($insert) === TRUE) {
        } else {
            $status_sql=false;
            echo "Error: " . $insert . "<br>" . $mysqli->error;
        }
    }elseif($_SESSION['type']=='hotel'){
        if($_SESSION['hotel_id']=='AB011' || $_SESSION['hotel_id']=='AB012' ){
            $lastslot==array_pop($selectslotpri);
            //อัพเดทชั้นอื่นๆที่พ่วงต่อกันอยู่
            $update=$mysqli->query("UPDATE terminal
                                    SET tel='".$_SESSION['tel']."',status='used'
                                    WHERE eq_id LIKE '".$_SESSION['hotel_id']."%' AND slot='$lastslot'
                                ");
        
        }
        $insert="INSERT INTO hotel_tel(hotel_id,hotel_no,tel,route,type_phone)
            VALUES ('".$_SESSION['hotel_id']."','".$_SESSION['hotel_no']."','".$_SESSION['tel']."','$route','normal_tel')";
        if ($mysqli->query($insert) === TRUE) {
            
        } else {
            $status_sql=false;
            echo "Error: " . $insert . "<br>" . $mysqli->error;
        }
        
    }else{
        $insert="INSERT INTO private_tel(p_id,tel,route,type_phone)
                VALUES ('".$_SESSION['p_id']."','".$_SESSION['tel']."','$route','normal_tel')";
        if ($mysqli->query($insert) === TRUE) {
        } else {
            $status_sql=false;
            echo "Error: " . $insert . "<br>" . $mysqli->error;
        }
    }

    unset($eq_id);
    unset($selectlabelpri);
    unset($selectslotpri);
    unset($selectlabelsec);
    unset($selectslotsec);
    unset($first_label);
    unset($first_slot);
}
$insert="INSERT INTO log (username,operating,tel,memo) VALUES('".$_SESSION['username']."','add','".$_SESSION['tel']."','-')";
if($mysqli->query($insert)){
    $type_add=$_SESSION['type'];
    if(isset($_SESSION)){
        foreach($_SESSION as $key => $value){
            if($key!='username' && $key!='user_status' && $key!='name'){
                unset($_SESSION[$key]);
            }
        }
    }
    
    echo "<script>alert('บันทึกข้อมูลของท่านเรียบร้อยแล้ว')</script>";

    if($type_add=='emp'){
        unset($type_add);
        echo "<script>window.location='./AddTel.php'</script>";
        exit(0);
    }elseif($type_add=='hotel'){
        unset($type_add);
        echo "<script>window.location='./AddTel_hotel.php'</script>";
        exit(0);
    }else{
        unset($type_add);
        echo "<script>window.location='./AddTel_private.php'</script>";
        exit(0);
    }
    
}else{
    echo "เพิ่มข้อมูลไม่สำเร็จ";
}




?>