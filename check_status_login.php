<?php
if(isset($_SESSION['user_status'])){
  if($_SESSION['user_status']=='1'){
    ?>
    <script>window.location='./admin/index.php';</script>
    <?php
  }
  elseif($_SESSION['user_status']=='2' || $_SESSION['user_status']=='3'){
    ?>
    <script>window.location='./user/index.php';</script>
    <?php
  }
}
?>