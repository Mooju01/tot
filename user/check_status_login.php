<?php
if(isset($_SESSION['user_status'])){
  if($_SESSION['user_status']=='1'){
    ?>
    <script>window.location='../admin/index.php';</script>
    <?php
  }
}else{
  session_destroy();
  ?>
  <script>alert("คุณยังไม่ได้เข้าสู่ระบบ");</script>
  <script>window.location='../index.php';</script>
  <?php
  exit();
}
?>