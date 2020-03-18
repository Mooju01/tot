<?php 
  include("../connect.php");
  session_start();
  include './check_status_login.php';
$page='report_all';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <?php header("Cache-Control: public, max-age=60, s-maxage=60");?>
    <meta charset="utf-8" />
    <link
      rel="apple-touch-icon"
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
    <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.css">
    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet" />
    <link
      href="./assets/vendor/font-awesome/css/font-awesome.min.css"
      rel="stylesheet"
    />
    <!--     Fonts and icons     -->
  <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.css">
  <!-- CSS Files -->
    <link href="../user/assets/css/material-dashboard.css" rel="stylesheet" />
    <!--style custom-->
    <link rel="stylesheet" type="text/css" href="../user/assets/css/style.css" />

    <!-- date picker -->
    <link rel="stylesheet" type="text/css" href="../user/assets/date/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="../user/assets/date/jquery-ui-timepicker-addon.css" />


  </head>
  <body>
  <main>
    <div class="wrapper">
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
        <!-- Navbar -->
        <?php
          include "navbar.php";
        ?>
        <!-- End Navbar -->
        <div class="content">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">รายงาน</h4>
                    <!--<p class="card-category">Complete your profile </p> -->
                  </div>
                  <div class="card-body">
                    <form action="./resultreport.php" method="GET">
                      <div class="row">
                        <div class="col-12">
                        <!-- group -->
                          <div class="form-group">
                            <div class="row justify-content-center">
                              <h3>รายงานข้อมูลการเปลี่ยนแปลงระบบข่ายสาย</h3>
                            </div>
                            <div class="row">
                              <div class="col-12">
                                ช่วงเวลาที่ต้องการดูข้อมูล<span style="color:red;">*</span>
                              </div>
                            </div>
                            <div class="input-daterange datepicker row align-items-center">
                              <div class="col">
                                  <div class="form-group">
                                      <div class="input-group input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                          </div>
                                          <input class="form-control"  type="text" name="Start_date" value="" id="dateStart" placeholder="วันเริ่มต้น" autocomplete="off" />
                                      </div>
                                  </div>
                              </div>
                              
                              ถึง
                              
                              <div class="col">
                                  <div class="form-group">
                                      <div class="input-group input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                          </div>
                                          <input class="form-control" type="text" name="End_date" value="" id="dateEnd" placeholder="วันสิ้นสุด" autocomplete="off" />
                                      </div>
                                  </div>
                              </div>

                              <div class="col">
                                ประเภทรายงาน
                                  <select name="operat" class="browser-default custom-select">
                                    <option value="" selected>---------เลือกเลือกหมวดหมู่---------</option>
                                    <option value="all" >ทั้งหมด</option>
                                    <option value="add" >เพิ่มเบอร์โทรศัพท์</option>
                                    <option value="addroom" >เพิ่มห้องใหม่</option>
                                    <option value="addemp" >เพิ่มพนักงานใหม่</option>
                                    <option value="change" >เปลี่ยนเบอร์โทรศัพท์</option>
                                    <option value="move" >ย้ายเบอร์โทรศัพท์</option>
                                    <option value="delete" >ลบเบอร์โทรศัพท์</option>
                                    <option value="delete_emp" >ลบพนักงาน</option>
                                    <option value="edit_emp">แก้ไขข้อมูลพนักงาน</option>
                                    <option value="edit_status" >เปลี่ยนสถานะของหมุด</option>
                                  </select>
                              
                              </div>
                          </div>
                          <!-- group -->
                          <div class="form-group">
                            <div class="row justify-content-center">
                              <button type="submit" class="btn btn-info">ค้นหา</button>
                            </div>
                          </div>
                          <!-- group -->
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
    </main>

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
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
    <!--validate-->
    <script src="./assets/vendor/validate/jquery.validate.js"></script>
   <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <!--<script type="text/javascript" src="./assets/datetimepicker/jquery.js"></script>
    <script type="text/javascript" src="./assets/datetimepicker/jquery.datetimepicker.js"></script>-->
		<script type="text/javascript" src="../user/assets/date/jquery-ui.min.js"></script>

		<script type="text/javascript" src="../user/assets/date/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="../user/assets/date/jquery-ui-sliderAccess.js"></script>
    

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

