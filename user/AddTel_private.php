<!--
=========================================================
 Material Dashboard - v2.1.1
=========================================================

 Product Page: https://www.creative-tim.com/product/material-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/material-dashboard/blob/master/LICENSE.md)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
 <?php
include "../connect.php";
session_start();
include "./check_status_login.php";
$page='addtel_private';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/TOT.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
    TOT
    </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!--select bootstrap-->
  
  <link rel="stylesheet" href="./assets/css/bootstrap-select.css">

  <link rel="stylesheet" href="./assets/css/style.css">

  <!--css datatables-->
  <link rel="stylesheet" href="./assets/css/datatables/datatables.css">
</head>

<body class="">
  <div class="wrapper ">
    <?php
        include 'header.php';
    ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php
      include './navbar.php';
      ?>
      <!-- End Navbar -->

      <div class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-8">
              <!--=========================== card 1 ===========================-->
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">เพิ่มเบอร์โทรศัพท์</h4>
                </div>
                <div class="card-body">
                  <!--=========================== Block 1 ==================================-->
                  <div class="col-12">
                        <div class="form-group">
                          <div class="row justify-content-center">
                            <h3>เพิ่มเบอร์ประจำชั้น</h3>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row justify-content-center">
                                <table id="emp_all" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                      <tr>
                                      <th>สถานที่</th>
                                      <th>เพิ่มเบอร์</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                  $sql=$mysqli->query("SELECT * 
                                                      FROM private_point
                                                      ORDER BY eq_id ASC
                                                      ");
                                  while($row = $sql->fetch_assoc())
                                  {
                                  ?>
                                  <tr>
                                    <td><?php echo $row["location"]; ?></td>
                                    <td><a href="addtel_process_private.php?p_id=<?=$row['p_id']?>&eq_id=<?php echo $row["eq_id"];?>&location=<?php echo $row["location"];?>&b_eq_id=<?php echo $row["b_eq_id"];?>" 
                                        class="btn btn-success">เพิ่ม</a></td> 
                                    </tr>
                                  <?php } ?>
                                  </tbody>
                                </table>
                        </div>
                      </div>
                    </div>
                   <!--=========================== Block 1 ==================================-->
                </div>
              </div>
              <!--=========================== card 1 ===========================-->
            </div>
          </div>
        </div>
      </div>
      <?php
      include '../footer.php';
      ?>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

   <!--validate-->
   <script src="./assets/vendor/validate/jquery.validate.js"></script>

    <!--data table js-->
    <script src="./assets/js/jquery.dataTables.min.js" ></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js" ></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#emp_all').DataTable();
        } );  
    </script>
</body>

</html>
