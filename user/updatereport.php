<?php
//ย้ายเบอร์
include_once "../connect.php";
session_start();

$report=$_POST['report'];
$date=$_POST['date'];
$type=$_POST['type'];
$employee=$_POST['username'];
$tel=$_POST['tel'];
$emp_id=$_POST['emp_id'];


$selectlabelpri=$_POST['selectlabelpri'];
$selectslotpri=$_POST['selectslotpri'];
$selectlabelsec=$_POST['selectlabelsec'];
$selectslotsec=$_POST['selectslotsec'];
$Check=$_POST['Check'];

$labelpri=$_POST['labelpri'];
$slotpri=$_POST['slotpri'];
$labelsec=$_POST['labelsec'];
$slotsec=$_POST['slotsec'];
$memo=$_POST['memo']; 


// print_r($selectlabelpri);
// echo "<br>";
// print_r($selectslotpri);
// echo "<br>";
// print_r($selectlabelsec);
// echo "<br>";
// print_r($selectslotsec);
// echo "<br>";


//เช็คว่า $_SESSION['select'] มีค่าหรือไม่
$eq_idnew=array_pop($_SESSION['eq_id']);
if(isset($Check)){
    foreach($Check as $key=>$value){
        if($Check[$key]!=0){
        $updatememo=$mysqli->query("UPDATE route_tel 
        SET memo ='$memo', eq_id='$eq_idnew'
        WHERE label='$labelpri[$value]' AND slot='$slotpri[$value]' AND type='tt'");

        $update=$mysqli->query("UPDATE route_tel 
        SET label='$selectlabelpri[$value]',slot='$selectslotpri[$value]' 
        WHERE label='$labelpri[$value]' AND slot='$slotpri[$value]'");

        $updatestatus=$mysqli->query("UPDATE terminal 
        SET status ='die', tel='' 
        WHERE label='$labelpri[$value]' AND slot='$slotpri[$value]'");

        if(isset($_SESSION['telnew'])){
        $updatenew=$mysqli->query("UPDATE terminal 
        SET status ='used',tel = '".$_SESSION['telnew']."' 
        WHERE label='$selectlabelpri[$value]' AND slot='$selectslotpri[$value]'");
        }
        else{
        $updatenew=$mysqli->query("UPDATE terminal 
        SET status ='used',tel = '$tel' 
        WHERE label='$selectlabelpri[$value]' AND slot='$selectslotpri[$value]'");
    }


        }  
    elseif($Check[$key]==0 && count($Check)==1){ 
        $update=$mysqli->query("UPDATE route_tel 
        SET label='$selectlabelpri[$value]',slot='$selectslotpri[$value]',tel='".$_SESSION['telnew']."'
        WHERE label='$labelpri[$value]' AND slot='$slotpri[$value]'"); 

       $updatetel=$mysqli->query("UPDATE route_tel 
        SET tel='".$_SESSION['telnew']."'
        WHERE tel ='$tel'");

        $updateromtel=$mysqli->query("UPDATE emp_tel 
        SET tel='".$_SESSION['telnew']."'
        WHERE tel ='$tel'");
        
        $updatestatus=$mysqli->query("UPDATE terminal 
        SET status ='die' 
        WHERE label='$labelpri[$value]' AND slot='$slotpri[$value]'");
        
        $updatetel_ter=$mysqli->query("UPDATE terminal 
        SET tel='".$_SESSION['telnew']."'
        WHERE tel ='$tel' AND status ='used'");
           
        $updatenew=$mysqli->query("UPDATE terminal 
        SET status ='used'
        WHERE label='$selectlabelpri[$value]' AND slot='$selectslotpri[$value]'");
   
           }
           
    elseif($Check[$key]==0 && count($Check)>1){ 

            if($Check[$key]==0){
                $update=$mysqli->query("UPDATE route_tel 
                SET label='$selectlabelpri[$value]',slot='$selectslotpri[$value]',tel='".$_SESSION['telnew']."'
                WHERE label='$labelpri[$value]' AND slot='$slotpri[$value]'"); 
        
               $updatetel=$mysqli->query("UPDATE route_tel 
                SET tel='".$_SESSION['telnew']."'
                WHERE tel ='$tel'");
        
                $updateromtel=$mysqli->query("UPDATE emp_tel 
                SET tel='".$_SESSION['telnew']."'
                WHERE tel ='$tel'");

                $updatestatus=$mysqli->query("UPDATE terminal 
                SET status ='die' 
                WHERE label='$labelpri[$value]' AND slot='$slotpri[$value]'");

                $updatetel_ter=$mysqli->query("UPDATE terminal 
                SET tel='".$_SESSION['telnew']."'
                WHERE tel ='$tel' AND status ='used'");
                
                $updatenew=$mysqli->query("UPDATE terminal 
                SET status ='used'
                WHERE label='$selectlabelpri[$value]' AND slot='$selectslotpri[$value]'");
            }
            else{
                $updatememo=$mysqli->query("UPDATE route_tel 
                SET memo='$memo',eq_id='$eq_idnew'
                WHERE type='tt' AND label='$labelpri[$value]' AND slot='$slotpri[$value]'");

                $update=$mysqli->query("UPDATE route_tel 
                SET label='$selectlabelpri[$value]',slot='$selectslotpri[$value]' 
                WHERE label='$labelpri[$value]' AND slot='$slotpri[$value]'");
                
                $updatestatus=$mysqli->query("UPDATE terminal 
                SET status ='die',tel='' 
                WHERE label='$labelpri[$value]' AND slot='$slotpri[$value]'");
                   
                $updatenew=$mysqli->query("UPDATE terminal 
                SET status ='used',tel='".$_SESSION['telnew']."'
                WHERE label='$selectlabelpri[$value]' AND slot='$selectslotpri[$value]'");    
            }
            } 


    }


    if(isset($_SESSION['telnew'])){
    $sql="INSERT INTO report (tel,re_emp_id, re_data, re_date, emp_id, re_type)
VALUES ('".$_SESSION['telnew']."', '$emp_id', '$report','$date', '$employee', '$type')";
    }
    else{
        $sql="INSERT INTO report (tel,re_emp_id, re_data, re_date, emp_id, re_type)
        VALUES ('$tel', '$emp_id', '$report','$date', '$employee', '$type')";   
    }
if($mysqli->query($sql)===TRUE){
    echo "<script type='text/javascript'>";
    echo "alert('บันทึกเรียบร้อยแล้ว^0^');";
    echo "window.location = 'MendTel.php'; ";
    echo "</script>";
    if(isset($_SESSION)){
        foreach($_SESSION as $key => $value){
            if($key!='username' && $key!='user_status'){
                unset($_SESSION[$key]);
            }
        }
    }
}
else{
    echo "<script type='text/javascript'>";
    echo "alert('บันทึกไม่สำเร็จ^0^');";
    echo "window.history.back()";
    echo "</script>";
}


}




else{
    $sql="INSERT INTO report (tel,re_emp_id, re_data, re_date, emp_id, re_type)
    VALUES ('$tel', '$emp_id', '$report','$date', '$employee', '$type')";
    
    if($mysqli->query($sql)===TRUE){
        echo "<script type='text/javascript'>";
        echo "alert('บันทึกเรียบร้อยแล้ว');";
        echo "window.location = 'MendTel.php'; ";
        echo "</script>";
            if(isset($_SESSION)){
                foreach($_SESSION as $key => $value){
                    if($key!='username' && $key!='user_status' ){
                        unset($_SESSION[$key]);
                    }
                        
                    
                }
            }
    }
    else{
        echo "<script type='text/javascript'>";
        echo "alert('บันทึกไม่สำเร็จ^0^');";
        echo "window.history.back()";
        echo "</script>";
    }
    
    }








?>