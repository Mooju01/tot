<?php include("connect.php"); ?>
<?php 
$page='search';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="TOT-iconq"
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
    <!--    icons     -->
    <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.css">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css"
        rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet" />
    <!--style custom-->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />

    <!--css datatables-->
    <link rel="stylesheet" href="./assets/css/datatables/datatables.css">
    <!-- pagination data table -->
    <link rel="stylesheet" type="text/css"
        href="./assets/css/bootstrap/bootstrap.css" />
    <link rel="stylesheet" type="text/css"
        href="./assets/css/bootstrap/responsive.bootstrap4.min.css" />
  </head>

<body>
    <div class="wrapper ">
      <!--sidenav-->
      <?php
      include "header.php";
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
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">ค้นหาเบอร์โทรศัพท์พนักงานภายในสถาบันวิชาการทีโอที</h4>
            </div>
                <div class="card-body"> 
                  <div class="row justify-content-center">
                    <div class="col-12">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                          <thead>
                                    <tr>
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>อีเมลล์</th>
                                    <th>ส่วนงานที่สังกัด</th>
                                    <th>ประเภทโทรศัพท์</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                <?php 
                                $sql=$mysqli->query("SELECT * FROM employee
                                                    INNER JOIN emp_tel
                                                    ON employee.emp_id=emp_tel.emp_id
                                                    INNER JOIN center
                                                    ON employee.center_id=center.center_id
                                                    ORDER BY center.center_id ASC
                                                    ");
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["emp_id"]; ?></a></td>
                                  <td><?php echo $row["emp_name"]; ?></td>
                                  <td><?php echo $row["emp_email"]; ?></td>
                                  <td><?php echo $row["div_code"]; ?></td>
                                  <td><?php echo $row["type_phone"]=='ipphone'?'IP Phone' :'เบอร์ธรรมดา' ; ?></td>
                                  <td><?php echo $row["tel"]; ?></td>
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
      <?php
      include './footer.php';
      ?>
    </div>
</div>

      <!--   Core JS Files   -->
    <script src="./assets/js/core/jquery.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/material-dashboard.js"
        type="text/javascript"></script>

    <script src="./assets/js/bootstrap-select.js"></script>
    <!--data table js-->
    <script src="./assets/js/jquery.dataTables.min.js"></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="./assets/js/dataTables.responsive.min.js"></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js"></script>


    
<script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable({
      "bSort":false
    });
} );
</script>
</body>
</html>
