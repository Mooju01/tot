<?php 
     include("../connect.php"); 
     session_start();
     include './check_status_login.php';
?>

<?php
$page='adduser';
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
      เพิ่มผู้ใช้งาน
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

    <!-- pagination data table -->
    <link rel="stylesheet" type="text/css"
        href="./assets/css/bootstrap/bootstrap.css" />
  <!-- sweetalert css -->
    <link rel="stylesheet" href="sweetalert2/package/dist/sweetalert2.min.css">
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
           <div class="col-7">
            <div class="card">
             <div class="card-header card-header-primary">
               <h4 class="card-title">เพิ่มสมาชิก</h4>
              </div>
                <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-8">
                  <form id="form" name="form" method="post" action="saveuser.php" novalidate>
                        <div class="form-group">
                          <div class="row">
                         <div class="col-sm-12">
                          <label for="username" class="col-sm-12 col-form-label">Username<span style="color:red;">*</span></label>
                           <input type="text" class="form-control" id="username" name="username"
                            placeholder="รหัสพนักงาน 8 ตัว" required 
                            onKeyUp="if(isNaN(this.value)){Swal.fire('กรอกตัวเลขเท่านั้น','ระบุรหัสพนักงาน 8ตัว ', 'warning')}"> 
                            <!---------------------- เช็คให้กรอกรหัสพนักงานเป็นตัวเลขโดยใช้ sweetalert ----------------------->
                           <div class="invalid-feedback">
                            กรุณากรอกรหัสพนักงาน 8 ตัว
                          </div>
                         </div>
                         </div>
                        </div>
                         <div class="form-group">
                         <div class="row">
                           <div class="col-sm-12">
                           <label for="name" class="col-sm-12 col-form-label">ชื่อ-สกุลพนักงาน<span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder="ชื่อ-สกุลพนักงาน" required   autocomplete="off" disabled
                            onKeyUp="if(!(isNaN(this.value))) {Swal.fire('กรอกตัวอักษรเท่านั้น','ระบุชื่อ-สกุลพนักงาน', 'warning')}"/>
                            <!---------------------------------------- เช็คกรอกตัวอักษรโดยใช้ sweetalert ----------------------->          <!--- ปิดเบราว์เซอร์ไม่ให้เติมข้อความชื่ออัตโนมัติ ----->
                             <div class="invalid-feedback">
                                กรุณากรอก ชื่อ-สกุลพนักงาน เป็นภาษาไทย 
                             </div>
                            </div>
                            </div>
                          </div>
                           <div class="form-group">
                           <div class="row">
                               <div class="col-sm-12">
                               <label for="password" class="col-sm-12 col-form-label">Password<span style="color:red;">*</span></label>
                                <input type="password" class="form-control" id="pass" name="pass" 
                                 placeholder="รหัสพนักงาน 3 ตัวหลัง" required
                                                onblur="check();"                         onclick="show_psw1(true)" onmouseout="show_psw1(false)">
                                 <!---- เช็คให้กรอกรหัสผ่านเป็นตัวเลขโดยใช้ sweetalert ------>  <!--------------------- กดดูรหัสผ่าน  -------------------->
                                 <div class="invalid-feedback">
                                  เเนะนำให้กรอกรหัสผ่านเป็นรหัสพนักงาน 3 ตัวหลัง
                                 </div>
                                </div>
                                </div>
                               </div>
                               <div class="form-group">
                               <div class="row">
                            <div class="col-sm-12">
                            <label  for="New Password" class="col-sm-12 col-form-label">Confirm Password<span style="color:red;">*</span></label>
                                <input type="password"  class="form-control" id="pass2" name="pass2" 
                                 placeholder="ยืนยันรหัสผ่าน" required 
                                 onKeyUp="if(this.value*1!=this.value) this.value='' ;"  onclick="show_psw2(true)" onmouseout="show_psw2(false)"> 
                                 <!----------- เช็คให้กรอกรหัสผ่านเป็นตัวเลขเท่านั้น  --------->  <!--------------------- กดดูรหัสผ่าน --------------------->
                                <div class="invalid-feedback">
                                 กรุณากรอกยืนยันรหัสผ่านอีกครั้ง
                               </div>
                              </div>
                              </div>
                            </div>
                            <div class="form-group">
                            <div class="row">
                            <div class="col-sm-12">
                            <label for="user_status" class="col-sm-12 col-form-label">สถานะ<span style="color:red;">*</span></label>
                             <select
                                class="custom-select"
                                id="selectuser_status"
                                name="user_status"
                                onchange="showfloor(this.value)" required >
                                <option value="" selected>เลือกสถานะ</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                                <option value="3">Superuser</option> 
                            </select>
                             <div class="invalid-feedback">
                                กรุณาเลือกสถานะผู้ใช้งาน
                            </div>   
                          </div>
                            </div>
                         </div>
                            <br>
                            <br>
                              <div class="row justify-content-center">
                                <a href="manage.php" class="btn btn-facebook"><i class="fa fa-times"></i>  ยกเลิก</a>
                                <button type="submit" name="submit"  class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>  บันทึก</button>
                              </div>
                      
              
                      </div>
                  </div>
                   </form>   
                 <!-- -->
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
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/material-dashboard.js"
        type="text/javascript"></script>

  <!--======= jQuery UI autocomplete with PHP and AJAX ==================-->
      <!-- jQuery UI -->
      <link href='jquery/jquery-ui.min.css' rel='stylesheet' type='text/css'>
      <script src='jquery/jquery-ui.min.js' type='text/javascript'></script>
   <!--=======================================================================-->
     <!------------------------------- sweetalert ------------------------------->
   <script src="sweetalert2/package/dist/sweetalert2.all.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="./sweetalert2/package/dist/promise-polyfill.js"></script>
    <script src="sweetalert2/package/dist/sweetalert2.min.js"></script>
    
<!--======================  เช็ค required  ================================-->

<script type="text/javascript">
      $(function(){
        $("#form").on("submit",function(){
            var form = $(this)[0];
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
              Swal.fire({
              icon: 'warning',
              title: 'กรุณากรอกข้อมูลให้ครบ', 
            })     
            }
            form.classList.add('was-validated');
               
        });     
    });
// <!--=======================================================================-->
// <!--===================  คลิกดูรหัสผ่านในช่องกรอกรหัส  =========================-->
								function show_psw1( opt ){   
								form.pass.setAttribute('type', opt? 'text' : 'password');
								}
								function show_psw2( opt ){   
								form.pass2.setAttribute('type', opt? 'text' : 'password');
								}

// <!--=======================================================================-->
// <!--=============================== เช็ครหัสผ่านเป็นตัวเลข ========================-->

            function check()
            {
              var elem = document.getElementById('pass').value;
              if(!elem.match(/^([0-9])+$/i))
              {
                Swal.fire('กรอกตัวเลขเท่านั้น','เเนะนำให้กรอกรหัสผ่านเป็นรหัสพนักงาน 3 ตัวหลัง', 'warning')
                document.getElementById('pass').value = "";
              }
            }

// <!--=======================================================================-->
// <!--=======  autocomplete ดึงรหัสพนักงานใน Textbox Username ==================-->

    $( function() {
        $( "#username" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "searchuser.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
              minLength: 2,  //กำหนดต้องกรอก 2ตัวเเรกของรหัสพนังาน
            select: function (event, ui) {
                $('#username').val(ui.item.label); //  textbox username รหัสพนังาน
                $('#name').val(ui.item.value); // textbox name ชื่อพนักงาน
                $('#pass').val(ui.item.pass); // textbox pass รหัสผ่าน 3ตัวจากการ substr
                $('#pass2').val(ui.item.pass); // textbox pass2 ค่ารหัสผ่านจาก pass
                return false;
            }
        });
    });

    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
    </script>
<!--=======================================================================-->
</body>
</html>

