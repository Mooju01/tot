<?php
include '../connect.php';
session_start();
include './check_status_login.php';
$oper=$_GET['operat'];
$Start_date=$_GET['Start_date'];
$End_date=$_GET['End_date'];
if($oper=='all'){
    $sql=$mysqli->query("SELECT username,operating,tel,date,memo
                        FROM log
                        WHERE (DATE_FORMAT(date,'%m/%d/%Y') BETWEEN '$Start_date' AND '$End_date') ORDER BY date DESC
                        ");
}else{
    $sql=$mysqli->query("SELECT * 
                        FROM log 
                        WHERE (DATE_FORMAT(date,'%m/%d/%Y') BETWEEN '$Start_date' AND '$End_date') 
                        AND operating='$oper' ORDER BY date DESC
                        ");
}
$result=$sql->num_rows;
$page='report_all';
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

<body class="">
  <div class="wrapper ">
  <?php
      if($_SESSION['user_status']=='3'){
        include '../user/header.php';
      }else{
        include "header.php";
      }
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
          <div class="col-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">รายงาน</h4>
              </div>
              <div class="card-body">
                  <div class="col-12">
                  <!--form -->
                    <div class="form-group">
                        <table id="search" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                              <thead>
                                    <tr>
                                    <th>ชื่อผู้ใช้</th>
                                    <th>การดำเนินการ</th>
                                    <th>เบอร์โทร</th>
                                    <th>วันที่ดำเนินการ</th>
                                    <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                <?php
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["username"]; ?></td>
                                  <td>
                                  <?php
                                    if($row["operating"]=='add'){
                                        echo 'เพิ่มเบอร์โทรศัพท์';
                                    }elseif($row["operating"]=='addemp'){
                                        echo 'เพิ่มพนักงานใหม่';
                                    }elseif($row["operating"]=='addroom'){
                                        echo 'เพิ่มห้องใหม่';
                                    }elseif($row["operating"]=='change'){
                                        echo 'เปลี่ยนเบอร์โทรศัพท์';
                                    }elseif($row["operating"]=='move'){
                                        echo 'ย้ายเบอร์โทรศัพท์';
                                    }elseif($row["operating"]=='delete'){
                                        echo 'ลบเบอร์โทรศัพท์';
                                    }elseif($row["operating"]=='delete_emp'){
                                        echo 'ลบพนักงาน';
                                    }elseif($row["operating"]=='edit_status'){
                                        echo 'เปลี่ยนสถานะของหมุด';
                                    }elseif($row["operating"]=='edit_emp'){
                                      echo 'แก้ไขข้อมูลพนักงาน';
                                  }
                                  ?></td>
                                  <td><?php echo $row["tel"]; ?></td>
                                  <td><?php echo $row["date"]; ?></td>
                                  <td><?php echo $row["memo"]; ?></td>
                                  
                                  </tr>
                                <?php } ?>
                                </tbody>
                               
                              </table>
                       
                    </div>
                  <!--form -->
                  </div>
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
                     <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                     <a class="btn btn-facebook" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
             </div>
          </div>
        </div>                  
        <!--=================================== End Modal logout =============================================-->



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
            $('#search').DataTable({
              "bSort": false
            });
        } );  
    </script>
</body>

</html>