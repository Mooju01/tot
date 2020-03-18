<?php 
include('../connect.php');
session_start();
include './check_status_login.php';
?>

<?php
$page='repassword';
 ?>
้<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
      <link rel="stylesheet" type="text/css" href="styles.css" />
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
<body>
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
          <div class="col-10">
            <div class="card">
             <div class="card-header card-header-primary">
               <h4 class="card-title">เปลี่ยนรหัสผ่าน
              </div>
                 <div class="card-body">
                   <div class="row justify-content-center">
                     <div class="col-8">
                      <form id="myform" name="form" method="post" action="repass.php" novalidate>    
                        <div class="form-group">
                              <div class="col-sm-8">
                              <label  for="username" class="col-sm-8 col-form-label"> Username:</label>
                                <input type="text"  name="username" required class="form-control" autocomplete="off" value="<?=$_SESSION['username']?>" disabled>
                              </div>
                            </div>
                            <!-- <div class="form-group">
                            <label  for="old Password" class="col-sm-8 col-form-label">Old Password</label>
                              <div class="col-sm-8">
                                <input type="password" name="old_pass" placeholder="รหัสเดิม" required class="form-control">
                                <div class="invalid-feedback">
                                 กรุณากรอกรหัสผ่านเดิมที่ใช้งาน
                               </div>
                              </div>
                            </div> -->
                            <div class="form-group">
                              <div class="col-sm-8">
                                <label  for="New Password" class="col-sm-8 col-form-label">New Password :</label>
                                <input type="password" name="pass1" id="pass1" placeholder="รหัสผ่านใหม่อย่างน้อย 3 ตัวขั้นไป"  required  class="form-control"
                                           onblur="check();"            onclick="show_psw1(true)" onmouseout="show_psw1(false)"/> 
                                 <!-- เช็คให้กรอกรหัสผ่านเป็นตัวเลขเท่านั้น-->   <!---------------------- ดูรหัสผ่าน  -------------------->
                                <div class="invalid-feedback">
                                 กรุณากรอกรหัสผ่านใหม่อย่างน้อย 3 ตัวขั้นไป
                               </div>
                              </div>
                            </div>
                            <div class="form-group">
                            
                            <div class="col-sm-8">
                              <label  for="New Password" class="col-sm-8 col-form-label">Confirm Password : </label>
                                <input type="password" name="pass2" id="pass2" placeholder="ยืนยันรหัสผ่าน"   required class="form-control" 
                                onclick="show_psw2(true)" onmouseout="show_psw2(false)"   onKeyUp="if(this.value*1!=this.value) this.value='' ;">
                                <!-------------------- ดูรหัสผ่าน  --------------------->   <!------------  เช็คให้กรอกรหัสผ่านเป็นตัวเลขเท่านั้น --------->
                                <div class="invalid-feedback">
                                 กรุณากรอกรหัสผ่านยืนยันให้ถูกต้อง
                               </div>
                              </div>
                            </div>
                            <div class="form-group">
                            <div class="row justify-content-center">
                              <div class="col-sm-7">
                                <input type="hidden" name="username" value="<?=$_SESSION['username']?>" />
                                <a href="index.php"  class="btn btn-facebook" >ยกเลิก</a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i>  บันทึก</button>
                            </div>
                            </div>
                            </div>
                      </form>
                    </div>
                  </div>
                </div>
              <!-- -->
            </div>
          </div>
        </div>
        <?php include '../footer.php';?>
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
    <script src="./assets/js/core/jquery.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/material-dashboard.js"
        type="text/javascript"></script>
        
     <!------------------------------- sweetalert ------------------------------->
   <script src="sweetalert2/package/dist/sweetalert2.all.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="./sweetalert2/package/dist/promise-polyfill.js"></script>
    <script src="sweetalert2/package/dist/sweetalert2.min.js"></script>

<!------------------------------  เช็ค required  ------------------------------->

<script type="text/javascript">
      $(function(){
        $("#myform").on("submit",function(){
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
</script>
<!----------------------------- เช็ครหัสผ่านเป็นตัวเลข-- ---------------------->
<script>
            function check()
            {
              var elem = document.getElementById('pass1').value;
              if(!elem.match(/^([0-9])+$/i))
              {
                Swal.fire('กรอกตัวเลขเท่านั้น','กรอกรหัสผ่านอย่างน้อย 3 ตัวขั้นไป', 'warning')
                document.getElementById('pass1').value = "";
              }
            }
</script>
<!--------------------------  คลิกดูรหัสผ่านในช่องกรอกรหัส  ---------------------->
<script> 
								function show_psw1( opt ){   
								form.pass1.setAttribute('type', opt? 'text' : 'password');
								}
</script>
<script> 
								function show_psw2( opt ){   
								form.pass2.setAttribute('type', opt? 'text' : 'password');
								}
</script>
</body>
</html>