<?php
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
$hotel_name=$_POST['hotel_name'];
$hotel_no=$_POST['hotel_no'];

$memo=$_POST['memo']; 
if(isset($Check)){
    $eq_idnew=array_pop($_SESSION['eq_id']);
   /* if($_SESSION['hotel_id']=='AB013'||$_SESSION['hotel_id']=='AB014')
    {*/
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
        WHERE  tel ='$tel'");

        $updateromtel=$mysqli->query("UPDATE hotel_tel 
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
        
                $updateromtel=$mysqli->query("UPDATE hotel_tel 
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
                SET memo='$memo', eq_id='$eq_idnew' 
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
    $sql="INSERT INTO report_hotel (reh_date, reh_data,  reh_building,reh_tel, reh_emp, reh_type,reh_hotel_no,hotel_id)
    VALUES ('$date','$report','$hotel_name', '".$_SESSION['telnew']."', '$employee', '$type', '$hotel_no', '".$_SESSION['hotel_id']."')";       
    }
    else{
         $sql="INSERT INTO report_hotel (reh_date, reh_data,  reh_building,reh_tel, reh_emp, reh_type,reh_hotel_no,hotel_id)
    VALUES ('$date','$report','$hotel_name', '".$tel."', '$employee', '$type', '$hotel_no', '".$_SESSION['hotel_id']."')";       
    }   
if($mysqli->query($sql)===TRUE){
    echo "<script type='text/javascript'>";
    echo "alert('บันทึกเรียบร้อยแล้ว^0^');";
    echo "window.location = 'Changehotel.php'; ";
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
    echo "alert('บันทึกไม่สำเร็จ^0^11');";
    echo "window.history.back()";
    echo "</script>";
}


}
/*}*/



else{

    $sql="INSERT INTO report_hotel (reh_date, reh_data,  reh_building,reh_tel, reh_emp, reh_type,reh_hotel_no,hotel_id)
    VALUES ('$date','$report','$hotel_name', '".$tel."', '$employee', '$type', '$hotel_no', '".$_SESSION['hotel_id']."')";   
    
    if($mysqli->query($sql)===TRUE){
        echo "<script type='text/javascript'>";
        echo "alert('บันทึกเรียบร้อยแล้ว');";
        echo "window.location = 'Changehotel.php'; ";
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