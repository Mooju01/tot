<?php 
  include("../connect.php");
  session_start();
  include './check_status_login.php';
$page='manage';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/TOT.png"/>
    <link rel="icon" type="image/png" href="assets/img/TOT.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      จัดการสมาชิก
    </title>
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
      name="viewport"/>
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
        include_once "navbar.php";
        ?>
        <!-- End Navbar -->
        <div class="content">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">จัดการสมาชิก</h4>
                    <!----------------------- button --------------------->
                        <div  align="right">
                          <a href="adduser.php" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มสมาชิก</a>
                          <!-- <a href="reportuser.php" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  พิมพ์</a>  -->
                      </div>
                       <!----------------------- End --------------------->              
                    <!--<p class="card-category">Complete your profile</p>-->
                    </div>
                  <div class="card-body">
                    <form action="updateuser.php" method="GET">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                              <thead>
                                    <tr>  
                                    <th>username</th>
                                    <th>name</th>
                                    <th>สถานะ</th> 
                                    <th>เเก้ไขสถานะ</th>
                                    <th>ลบสมาชิก</th>  
                                    </tr>                  
                             </thead>    
                                <tbody>       
                                  <?php  
                                       $sql=$mysqli->query("SELECT login.username,employee.emp_name,login.user_status
                                                            FROM login
                                                            LEFT JOIN employee
                                                            ON login.username=employee.emp_id
                                                            ORDER BY login.username  ASC
                                                          ");
                                       while($row = $sql->fetch_assoc())
                                       {
                                  ?>
                                    <tr>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo $row["emp_name"]; ?></td>
                                    <td><?php if($row["user_status"] == '1'){echo "Admin";}elseif($row["user_status"] == '2'){echo "User";}else{echo "Superuser";}?></td>     
                                    <td>
                                    <?php if($row["user_status"] == '1') {?>
                                     <button type="button" name="updateuser" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal3" onclick="update_user('<?=$row['user_status'];?>','<?=$row['username'];?>');"><i class="fa fa-user"></i> ตั้งเป็น User</button>
                                    <?php }elseif($row["user_status"] == '2'){?>
                                      <button type="button" name="updateadmin" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2" onclick="update_admin('<?=$row['user_status'];?>','<?=$row['username'];?>');"><i class="fa fa-user-md"></i>  ตั้งเป็น Admin</button>
                                    <?php }?>
                                    </td>
                                    <td><button type="button" name="deleteuser"  class="removeButton btn btn-danger" data-toggle="modal" data-target="#exampleModal1" onclick="delete_user('<?=$row['username'];?>');"><i class="fa fa-trash"></i> ลบ</button></td> 
                                    </tr>
                                   <?php } ?>
                                 </tbody>
                                 </table>   
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

<!--=========================================== Modal Delete ========================================================-->
  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel" >ลบสมาชิก <i class="fa fa-trash"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                     <div class="modal-body">
                       <p> คลิกปุ่ม ลบ เพื่อทำการลบสมาชิก   </p> 
                </div>
                     <div class="modal-footer">
                     
                     <form action="deleteuser.php" method="post" style="display:inline;">
                     <input type="hidden" name="deleteuser" id="deleteuser"/>
                     <button type="button" class="btn btn-facebook" data-dismiss="modal"><i class="fa fa-times">  ยกเลิก</i></button>
                     <button type="submit" class="button-delete btn btn-danger"><i class="fa fa-trash">  ลบ</i></button>
                     </form>
                </div>
             </div>
          </div>
        </div>                  
 <!--=========================================== End Modal  ==============================================================-->

<!--============================================ Modal Update  User เป็น Admin  =============================================-->
    
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel" >เปลี่ยนสถานะผู้ใช้งาน    <i class="fa fa-exchange" ></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                     <div class="modal-body">
                     ต้องการเปลี่ยนสถานะจาก User เป็น Admin คลิก ตกลง
                </div>
                <div class="modal-footer">
                     <form action="updatestatus.php" method="post" style="display:inline;">
                     <input type="hidden" name="updateadmin" id="updateadmin"/>
                     <input type="hidden" name="username" id="name"/>
                      <button type="button" class="btn btn-facebook" data-dismiss="modal"><i class="fa fa-times">  ยกเลิก</i></button>
                      <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true">  ตกลง</i></button>
                     </form>
                </div>
             </div>
          </div>
        </div>                  
<!--=================================== End Modal  ======================================================================-->

<!--===================================== Modal Update Admin เป็น User ===================================================-->
    
  <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel" >เปลี่ยนสถานะผู้ใช้งาน    <i class="fa fa-exchange" ></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                     <div class="modal-body">
                         ต้องการเปลี่ยนสถานะจาก Admin เป็น User คลิก ตกลง
                </div>
                     <div class="modal-footer">
                     <form action="updatestatus.php" method="post" style="display:inline;">
                     <input type="hidden" name="updateuser" id="updateuser"/>
                     <input type="hidden" name="username" id="username"/>
                     <button type="button" class="btn btn-facebook" data-dismiss="modal"><i class="fa fa-times">  ยกเลิก</i></button>
                      <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true">  ตกลง</i></button>
                     </form>
                </div>
             </div>
          </div>
        </div>                  
<!--======================================== End Modal  =======================================================================-->

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
  </body>
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
  delete_user=username=>{
    $("#deleteuser").attr("value",username);
  }
  update_user=(user_status,username)=>{
    $("#updateuser").attr("value",user_status);
    $("#username").attr("value",username);
  }
  update_admin=(user_status,username)=>{
    $("#updateadmin").attr("value",user_status);
    $("#name").attr("value",username);
  }
       $(document).ready(function()
      {
      $('#example').DataTable();
      } );  
  </script>
</html>

