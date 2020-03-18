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

 $page="changehotel";
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
  <!-- pagination data table -->
  <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap/bootstrap.css" />
     
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap/responsive.bootstrap4.min.css" />
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
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">เปลี่ยนเบอร์</h4>
              </div>
              <div class="card-body">
                <form method="POST">
                <div class="col-12">
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <h3>เปลี่ยนเบอร์หอพัก/โรงแรม</h3>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row justify-content-center">
                              <div class="col-12">
                              <table id="search" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                              <thead>
                                    <tr>
                                    <th>หอพัก</th>
                                    <th>ห้อง</th>
                                    <th>เบอร์โทร</th>
                                    <th>เปลี่ยนเบอร์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql=$mysqli->query("SELECT * FROM hotel
                                                    INNER JOIN hotel_tel
                                                    ON hotel.hotel_id=hotel_tel.hotel_id AND hotel.hotel_no=hotel_tel.hotel_no
                                                    INNER JOIN distination
                                                    ON hotel.hotel_id=distination.b_eq_id
                                                    ORDER BY distination.distination_name");
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["distination_name"]; ?></td>
                                  <td><?php echo $row["hotel_no"]; ?></td>
                                  <td><?php echo $row["tel"]; ?></td>
                                  <td>
                                  <?php
                                  if($row["type_phone"]!='ipphone'){
                                  ?>
                                    <a href="resultsearchChange.php?hotel_id=<?php echo $row["hotel_id"];?>&hotel_no=<?=$row['hotel_no']?>&tel=<?php echo $row["tel"]; ?>&route=<?=$row["route"];?>&type_change=hotel" 
                                      class="btn btn-warning">เปลี่ยน</a>
                                  <?php
                                  }
                                  ?>
                                  </td> 
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                         </div>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      include '../footer.php';
      ?>
    </div>
  </div>
  <!--======================================= Modal logout ===============================================-->
    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">ยืนยันการออกจากระบบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                     <div class="modal-body">
                         คลิกปุ่ม Logout เพื่อออกจากระบบ
                </div>
                     <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>  Close</button>
                     <a class="btn btn-facebook" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
             </div>
          </div>
        </div>                  
        <!--=================================== End Modal logout =============================================-->




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
    <script src="./assets/js/dataTables.responsive.min.js" ></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js" ></script>


    <script type="text/javascript">
      $(document).ready(function() {
        $('#search').DataTable();
      } );
    </script>
</body>

</html>
