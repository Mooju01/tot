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
include './check_status_login.php';
?>
<?php
$emp_id=$_GET['emp_id'];
$Start_date=$_GET['Start_date'];
$End_date=$_GET['End_date'];
$type=$_GET['type'];
$_SESSION['Start_date']=$Start_date;
$_SESSION['End_date']=$End_date;
$_SESSION['type']=$type;


//หาข้อมูลพนักงาน
$sql=$mysqli->query("SELECT employee.emp_id,employee.emp_name,employee.emp_email,center.div_code,employee.location
                    FROM employee
                    INNER JOIN center
                    ON employee.center_id=center.center_id
                    WHERE employee.emp_id='$emp_id'
                    ");
$result=$sql->num_rows;
$_SESSION['emp_info']=array();
for($i=0;$i<$result;$i++){
    $row=$sql->fetch_assoc();
    array_push($_SESSION['emp_info'],$row);
}
//
    unset($result);
    unset($sql);
    $page='repair_hotel';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  รายงานซ่อมเบอร์หอพัก/โรงแรม
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
          <div class="col-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">รายงานการซ่อม</h4>
              </div>
              <div class="card-body">
                <!--=========================== Block 1 ==================================-->
                <form method="POST">
                <div class="col-12">
                      <div class="form-group">
                        <div class="row justify-content-center">
                              <div class="row">
                              <table id="search" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                              <thead>
                                    <tr>
                                    <th>เบอร์โทร</th>
                                    <th>วันที่ซ่อม</th>
                                    <th>อาการเสีย</th>
                                    <th>ผู้ลงชื่อใช้งาน</th>
                                    <th>รายละเอียดเพิ่มเติม</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                <?php
                                if($type=='ทั้งหมด'){
                                  $sql=$mysqli->query("SELECT * FROM report_hotel INNER JOIN hotel_tel
                                ON report_hotel.reh_hotel_no = hotel_tel.hotel_no AND report_hotel.hotel_id=hotel_tel.hotel_id   WHERE report_hotel.reh_date BETWEEN '$Start_date' AND '$End_date' ORDER BY report_hotel.reh_date ASC");
                                }
                                else{
                                  $sql=$mysqli->query("SELECT * FROM report_hotel INNER JOIN hotel_tel
                                  ON report_hotel.reh_hotel_no = hotel_tel.hotel_no AND report_hotel.hotel_id=hotel_tel.hotel_id  WHERE report_hotel.reh_date BETWEEN '$Start_date' AND '$End_date' AND (report_hotel.reh_type= '$type') ORDER BY report_hotel.reh_date ASC");
                                }
                                 while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["reh_tel"]; ?></td>
                                  <td><?php echo $row["reh_date"]; ?></td>
                                  <td><?php echo $row["reh_type"]; ?></td>
                                  <td><?php echo $row["reh_emp"]; ?></td>
                                  <td><a class="btn btn-warning"  href="showdetel_re.php?tel=<?php echo $row['reh_tel']?>&reh_emp=<?php echo $row['reh_emp']?>&reh_hotel_no=<?php echo $row['reh_hotel_no']?>&reh_id=<?php echo $row['reh_id']?>&reh_building=<?php echo $row['reh_building']?>">คลิก</a></td>
                                  </tr>
                                <?php } ?>
                                </tbody>
                               
                              </table>
                            </div>
                           
                 
		                 
                         <div class="modal fade" id="addbookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                         <div class="modal-dialog" id="addbook_dialog_modal" role="document"></div>
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
      </div>
      <?php
      include '../footer.php';
      ?>
    </div>
  </div>
    <!--<div class="testshow"></div>-->

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

  <script src="./assets/js/bootstrap-select.js"></script>

   <!--validate-->
   <script src="./assets/vendor/validate/jquery.validate.js"></script>

    <!--data table js-->
    <script src="./assets/js/jquery.dataTables.min.js" ></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js" ></script>
    <script src="./assets/js/dataTables.responsive.min.js" ></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js" ></script>

    <script type="text/javascript">
      //-------------validate--------------
      $("#check").validate({
        rules: {
          tel: {
            required: true
          }
        },
        messages: {
          tel: "กรอกเบอร์โทรศัพท์"
        }
      });
      //-------------End validate--------------
      $(document).ready(function() {
        $('#search').DataTable();
      } );
    </script>

</body>

</html>
