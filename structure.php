<?php
session_start();

include("./connect.php"); 

$page='structure';
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
      TOT
    </title>
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
      name="viewport"
    />
  <!--     icons     -->
    <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.css">
    <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!--select bootstrap-->
  
  <link rel="stylesheet" href="./assets/css/style.css">

  <!--css datatables-->
  <link rel="stylesheet" href="./assets/css/datatables/datatables.css">
    
      
    <!-- pagination data table -->
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap/responsive.bootstrap4.min.css" />
    
    
  </head>

  <body class="">
    <div class="wrapper ">
      <!--sidenav-->
      <?php
      if(isset($_SESSION['user_status'])){
        if($_SESSION['user_status']=='3' || $_SESSION['user_status']=='2'){
          include './user/header.php';
        }
      }else{
        include "header.php";
      }
      ?>
      <!--sidenav-->
      <div class="main-panel">
        <!-- Navbar -->
        <?php
        include "navbar.php"
        ?>
        <!-- End Navbar -->
        <div class="content">
          <div class="container-fluid">
            <div class="row justify-content-left">
              <div class="card">
              <div class="card-header card-header-primary">
              <h4 class="card-title">โครงสร้างส่วนงานการบริหาร</h4>
            </div>
              <div class="card-body"> 
                  <div class="row justify-content-center">
                    <div class="col-12">
                      <div class="form-group">
                      <div class="nav-wrapper">
              <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-line-chart" aria-hidden="true"></i>   ผสก</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fa fa-graduation-cap" aria-hidden="true"></i>  จสก</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fa fa-leanpub" aria-hidden="true"></i>  สสก</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="fa fa-laptop" aria-hidden="true"></i>  ทสก</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false"><i class="fa fa-users" aria-hidden="true"></i> บสก</a>
                  </li>
              </ul>
          </div>
          <div class="card shadow">
              <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                          <p class="description"><center><h5>ศูนย์วางเเผนเเละพัฒนาธุรกิจ<h5></center></p>
                          <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                                    <tr>
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>ส่วนงานที่สังกัด</th>
                                    <th>ชื่อย่อส่วนงาน</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                <?php 
                                $sql=$mysqli->query("SELECT employee.emp_id,employee.emp_name,center.center_name,center.div_code
                                                  FROM employee 
                                                  INNER JOIN center 
                                                  ON employee.center_id = center.center_id 
                                                  WHERE center.div_code LIKE '%ผสก%' 
                                                  ORDER BY center.center_id ASC");
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["emp_id"]; ?></a></td>
                                  <td><?php echo $row["emp_name"]; ?></td>
                                  <td><?php echo $row["center_name"]; ?></td> 
                                  <td><?php echo $row["div_code"]; ?></td>   
                                  </tr>
                                <?php } ?>
                                </tbody>
                           </table>          
                      </div>
                      <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                          <p class="description"><center><h5>ส่วนพัฒนาเเละอบรมการจัดการ<h5></center></p>
                          <p class="description">
                          <table id="tabel2" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                                    <tr>
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>ส่วนงานที่สังกัด</th>                               
                                    <th>ชื่อย่อส่วนงาน</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                <?php 
                                $sql=$mysqli->query("SELECT employee.emp_id,employee.emp_name,center.center_name,center.div_code 
                                                    FROM employee 
                                                    INNER JOIN center 
                                                    ON employee.center_id = center.center_id 
                                                    WHERE center.div_code LIKE '%จสก%' 
                                                    ORDER BY center.center_id ASC
                                                    ");
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["emp_id"]; ?></a></td>
                                  <td><?php echo $row["emp_name"]; ?></td>
                                  <td><?php echo $row["center_name"]; ?></td> 
                                  <td><?php echo $row["div_code"]; ?></td>  
                                  </tr>
                                <?php } ?>
                                </tbody>
                           </table>
                          </p>
                      </div>
                      <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                          <p class="description"><center><h5>ส่วนพัฒนาความรู้และอบรมด้านเทคโนโลยีสารสนเทศและการสื่อสาร<h5></center></p>
                          <p class="description">
                          <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                                    <tr>
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>ส่วนงานที่สังกัด</th>                               
                                    <th>ชื่อย่อส่วนงาน</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                <?php 
                                $sql=$mysqli->query("SELECT employee.emp_id,employee.emp_name,center.center_name,center.div_code 
                                                    FROM employee 
                                                    INNER JOIN center 
                                                    ON employee.center_id = center.center_id 
                                                    WHERE center.div_code LIKE '%สสก%' 
                                                    ORDER BY center.center_id ASC
                                                    ");
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["emp_id"]; ?></a></td>
                                  <td><?php echo $row["emp_name"]; ?></td>
                                  <td><?php echo $row["center_name"]; ?></td> 
                                  <td><?php echo $row["div_code"]; ?></td> 
                                  </tr>
                                <?php } ?>
                                </tbody>
                           </table>       
                          </p>
                      </div>
                      <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                          <p class="description"><center><h5>ส่วนสนับสนุนเทคโนโลยีการเรียนรู้<h5></center></p>
                          <p class="description">
                          <table id="example3" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                                    <tr>
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>ส่วนงานที่สังกัด</th>                               
                                    <th>ชื่อย่อส่วนงาน</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                <?php 
                                $sql=$mysqli->query("SELECT employee.emp_id,employee.emp_name,center.center_name,center.div_code
                                                    FROM employee 
                                                    INNER JOIN center 
                                                    ON employee.center_id = center.center_id 
                                                    WHERE center.div_code LIKE '%ทสก%' 
                                                    ORDER BY center.center_id ASC
                                                    ");
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["emp_id"]; ?></a></td>
                                  <td><?php echo $row["emp_name"]; ?></td>   
                                  <td><?php echo $row["center_name"]; ?></td> 
                                  <td><?php echo $row["div_code"]; ?></td> 
                                  </tr>
                                <?php } ?>
                                </tbody>
                           </table>  
                          </p>
                      </div>
                      <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                          <p class="description"><center><h5>ส่วนสนับสนุนและบริการลูกค้า<h5></center></p>
                          <p class="description">
                           </p>
                           <table id="example4" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                                    <tr>
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>ส่วนงานที่สังกัด</th>                               
                                    <th>ชื่อย่อส่วนงาน</th> 
                                    </tr>
                                </thead>   
                                <tbody>
                                <?php 
                                $sql=$mysqli->query("SELECT employee.emp_id,employee.emp_name,center.center_name,center.div_code
                                                    FROM employee 
                                                    INNER JOIN center 
                                                    ON employee.center_id = center.center_id 
                                                    WHERE center.div_code LIKE '%บสก%' 
                                                    ORDER BY center.center_id ASC");
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["emp_id"]; ?></a></td>
                                  <td><?php echo $row["emp_name"]; ?></td>
                                  <td><?php echo $row["center_name"]; ?></td> 
                                  <td><?php echo $row["div_code"]; ?></td> 
                                  </tr>
                                <?php } ?>
                                </tbody>
                           </table>               
                     </div>
                   </div>
                 </div>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div>
        <?php
        include './footer.php';
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
    $('.table').DataTable({
      "bSort":false
    });    
    
} );
</script>

  </body>
</html>


