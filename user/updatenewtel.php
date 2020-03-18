<?php
//เผลี่ยนเบอร์
include '../connect.php';
session_start();
$newtel=$_POST['newtel'];
$labelpri_old=$_POST['labelpri_old'];
$slotpri_old=$_POST['slotpri_old'];
$label=$_POST['label'];
$slot=$_POST['slot'];

if($_SESSION['type_change']=='emp'){
//update เบอร์ใหม่ใน emp_tel
$update=$mysqli->query("UPDATE emp_tel
                        SET tel='$newtel'
                        WHERE emp_id='".$_SESSION['emp_id']."' AND route='".$_SESSION['route']."'
                        ");
}elseif($_SESSION['type_change']=='hotel'){
//update เบอร์ใหม่ใน hotel_tel
$hotel_id=$_SESSION['hotel_info']['hotel_id'];
$hotel_no=$_SESSION['hotel_info']['hotel_no'];
$update=$mysqli->query("UPDATE hotel_tel
                        SET tel='$newtel'
                        WHERE hotel_id='".$hotel_id."' AND hotel_no ='".$hotel_no."' AND route='".$_SESSION['route']."'
                        ");
unset($hotel_id);
unset($hotel_no);
}else{
   //update เบอร์ใหม่ใน private_tel
   $p_id=$_SESSION['private_info']['p_id'];
   $update=$mysqli->query("UPDATE private_tel
                           SET tel='$newtel'
                           WHERE p_id='".$p_id."' AND route='".$_SESSION['route']."'
                           ");
   unset($p_id);
}


//update เบอร์ใหม่ใน route_tel
$update=$mysqli->query("UPDATE route_tel
                        SET tel='$newtel',label='$label',slot='$slot'
                        WHERE label='$labelpri_old' AND slot='$slotpri_old'
                        ");
$update=$mysqli->query("UPDATE route_tel
                        SET tel='$newtel'
                        WHERE tel='".$_SESSION['tel']."'
                        ");

//update เบอร์ใหม่ใน terminal
$update=$mysqli->query("UPDATE terminal
                        SET status='available'
                        WHERE label='$labelpri_old' AND slot='$slotpri_old'
                        ");
$update=$mysqli->query("UPDATE terminal
                        SET status='used'
                        WHERE label='$label' AND slot='$slot'
                        ");
$update=$mysqli->query("UPDATE terminal
                        SET tel='$newtel'
                        WHERE tel='".$_SESSION['tel']."' AND label!='$labelpri_old'
                        ");



$insert="INSERT INTO log (username,operating,tel,memo) VALUES('".$_SESSION['username']."','change','".$newtel."','เปลี่ยนจากเบอร์ ".$_SESSION['tel']."')";
if($mysqli->query($insert)){
   $type_change=$_SESSION['type_change'];
   unset($newtel);
   unset($labelpri_old);
   unset($slotpri_old);
   unset($label);
   unset($slot);
   //ลบค่าทั้งหมดใน session ยกเว้น username,name และ user_status
   if(isset($_SESSION)){
      foreach($_SESSION as $key => $value){
         if($key!='username' && $key!='user_status' && $key!='name'){
            unset($_SESSION[$key]);
         }
      }
   }
   echo "<script>alert('บันทึกข้อมูลของท่านเรียบร้อยแล้ว')</script>";
   if($type_change=='emp'){
      unset($type_change);
      echo "<script>window.location='./ChangeTel.php'</script>";
      exit(0);
   }elseif($type_change=='hotel'){
      unset($type_change);
      echo "<script>window.location='./ChangeTel_hotel.php'</script>";
      exit(0);
   }else{
      unset($type_change);
      echo "<script>window.location='./ChangeTel_private.php'</script>";
      exit(0);
   }
   
}else{
   echo "เพิ่มข้อมูลไม่สำเร็จ";
}
?>