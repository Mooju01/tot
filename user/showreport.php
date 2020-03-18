
 <?php
include "../connect.php";
session_start();
include './check_status_login.php';
?>
<?php
$emp_id=$_GET['emp_id'];
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
    $page='report';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  รายงานการซ่อมเบอร์โทรศัพท์
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.css">
  <!-- CSS Files -->
    <link href="./assets/css/material-dashboard.css" rel="stylesheet" />
    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet" />
    <!-- Theme CSS -->
    <!--style custom-->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
    <!--css datatables-->
		<link rel="stylesheet" href="./assets/css/datatables/datatables.css">
  
    <link rel="stylesheet" media="all" type="text/css" href="./assets/date/jquery-ui.css" />
		<link rel="stylesheet" media="all" type="text/css" href="./assets/date/jquery-ui-timepicker-addon.css" />
    <!--<link rel="stylesheet" type="text/css" href="./assets/datetimepicker/jquery.datetimepicker.css">
    <script type="text/javascript" src="./assets/datetimepicker/jquery.js"></script>
    <script type="text/javascript" src="./assets/datetimepicker/jquery.datetimepicker.js"></script>-->


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
              <h2 style="font-size:1.8em;">ช่วงเวลาที่ต้องการดูข้อมูล</h2>
                <form method="GET" action="showreport2.php">
                    <div class="input-daterange datepicker row align-items-center">
                    <label>ตั้งแต่</label>
                        <div class="col-3">

                        <input class="form-control"  type="text" name="Start_date" value="" id="dateStart" autocomplete="off" />
                        </div>
                        <label>ถึง</label>
                        <div class="col-3">
                        <input class="form-control" type="text" name="End_date" value="" id="dateEnd" autocomplete="off" />
                            
                        </div>
                        ประเภทความเสียหาย
                        <div class="col-3">
                        <select class="browser-default custom-select" name="type">
                          <option value="ทั้งหมด">ทั้งหมด</option>
                          <option value="เสียจากผู้ใช้งาน">เสียจากผู้ใช้งาน</option>
                          <option value="อุปกรณ์เสียหาย">อุปกรณ์เสียหาย</option>
                          <option value="เสียหายจากชุมสายภายนอก">เสียหายจากชุมสายภายนอก</option>
                          <option value="คู่สายเสียหาย">คู่สายเสียหาย</option>
                          <option value="เทอร์มินอลเสียหาย">เทอร์มินอลเสียหาย</option>
                        </select>
                        </div>
                      </div>
                    <br>
                    </br>
                        <div class="form-group">
                             <div class="row justify-content-center">
                               <button type="submit" class="btn btn-info">
                                 ค้นหา
                                 </button>
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
  
    <!-- Core -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
    <!--validate-->
    <script src="./assets/vendor/validate/jquery.validate.js"></script>
   <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <!--<script type="text/javascript" src="./assets/datetimepicker/jquery.js"></script>
    <script type="text/javascript" src="./assets/datetimepicker/jquery.datetimepicker.js"></script>-->
		<script type="text/javascript" src="./assets/date/jquery-ui.min.js"></script>

		<script type="text/javascript" src="./assets/date/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="./assets/date/jquery-ui-sliderAccess.js"></script>
    
    <script type="text/javascript">
 
$(function(){

var startDateTextBox = $('#dateStart');
var endDateTextBox = $('#dateEnd');

startDateTextBox.datepicker({ 
    dateFormat: 'mm/dd/yy',
    onClose: function(dateText, inst) {
        if (endDateTextBox.val() != '') {
            var testStartDate = startDateTextBox.datetimepicker('getDate');
            var testEndDate = endDateTextBox.datetimepicker('getDate');
            if (testStartDate > testEndDate)
                endDateTextBox.datetimepicker('setDate', testStartDate);
        }
        else {
            endDateTextBox.val(dateText);
        }
    },
    onSelect: function (selectedDateTime){
        endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
    }
});
endDateTextBox.datepicker({ 
    dateFormat: 'mm/dd/yy',
    onClose: function(dateText, inst) {
        if (startDateTextBox.val() != '') {
            var testStartDate = startDateTextBox.datetimepicker('getDate');
            var testEndDate = endDateTextBox.datetimepicker('getDate');
            if (testStartDate > testEndDate)
                startDateTextBox.datetimepicker('setDate', testEndDate);
        }
        else {
            startDateTextBox.val(dateText);
        }
    },
    onSelect: function (selectedDateTime){
        startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
    }
});

});

 </script>

</body>

</html>
