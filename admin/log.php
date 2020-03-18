<?php 
     include("../connect.php"); 
     session_start();

if((!isset($_SESSION['user_status']))){

  unset($_SESSION['login_status']);
  unset($_SESSION['user_status']);
  session_destroy();
  ?>
  You are not login!!!
 <script>window.location='../index.php';</script> 
  <?php
  exit();
}
elseif($_SESSION['user_status']!=='1'){
  unset($_SESSION['login_status']);
  unset($_SESSION['user_status']);
  session_destroy();
  ?>
  You are not a Admin!!!
  <script>window.location='../index.php';</script>
  <?php
  exit();
}
?>


<?php
$page='log';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link
      rel="TOT-icon"
      sizes="76x76"
      href="assets/img/TOT.png"
    />
    <link rel="icon" type="image/png" href="assets/img/TOT.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      ประวัติ
    </title>
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
      name="viewport"
    />
    <!-- Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.css">
    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet" />
    <link
      href="./assets/vendor/font-awesome/css/font-awesome.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet" />
    <!-- Theme CSS -->
    <link type="text/css" href="./assets/css/argon.min.css" rel="stylesheet" />
    <!--style custom-->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
    <script type="text/javascript"></script>
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/bootstrap.min.js"></script>
    <!-- pagination table -->
   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" ></script>

  </head>

  <body class="">
    <div class="wrapper ">
      <!--sidenav-->
      <?php
      if($_SESSION['user_status']=='3'){
        include '../user/header.php';
      }else{
        include "header.php";
      }
      ?>
      <!--sidenav-->
      <div class="main-panel">
      <!----- Navbar -------->
      <?php
        include "navbar.php";
      ?>
      <!----- End Navbar ---->
      <div class="content">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">ประวัติการใช้งาน</h4>
                    <!--<p class="card-category">Complete your profile</p>-->
                  </div>
                  <div class="card-body">
                    <form action="" method="POST">
                      <div class="row">
                        <div class="col-10">
                          <div class="form-group">
                          <table id="example" class="table table-striped table-bordered" style="width:115%">
                          <thead>
                                    <tr>  
                                    <th>ผู้ใช้งาน</th>
                                    <th>ประเภท</th> 
                                    <th>สถานะ</th>
                                    <th>เวลาการใช้งาน</th>
                                    <th>ดำเนินงาน</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $sql=$mysqli->query("SELECT * FROM login ");
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["username"]; ?></a></td>   
                                  <td><?php if($row["user_status"] == '1'){echo "Admin";}else{echo "User";}?></td>
                                  <td><?php if($row["login_status"] == '1'){echo "Online";}else{echo "Offline";}?></td>
                                  <td><?php echo $row["last_update"]; ?></td>
                                  <td></td>
                                  </tr>
                                <?php } ?>
                                </tbody>    
                        </div>
                        <div class="modal fade" id="addbookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                         <div class="modal-dialog" id="addbook_dialog_modal" role="document"></div>
                         </div>
                      </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </body>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    } );  
   </script>
</html>

