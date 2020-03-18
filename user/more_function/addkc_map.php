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
 $page="add_kc_map";
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
  <!--     icons     -->
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
                <h4 class="card-title">Add KC Map</h4>
              </div>
              <div class="card-body">
                  <div class="col-12">
                  <!--form -->
                  <form action="save_pic_kc_map.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row justify-content-center">
                        <div class="col-5">
                        <span class="title-add_edit">ชื่ออาคาร<span class="star">*</span></span>
                          <select name="b_eq_id" id="" class="form-control location_name" onchange="showfloor(this.value);">
                            <option value="">---------เลือกอาคาร----------</option>
                            <?php
                            $sql=$mysqli->query("SELECT *
                                                FROM distination
                                                ");
                            while($row=$sql->fetch_assoc()){
                            ?>
                            <option value="<?=$row['b_eq_id'];?>"><?=$row['distination_name'];?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <div class="col-5">
                          <div id="showfloor"></div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <div class="col-5">
                          <div id="showeq_id"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center" >
                            <div class="col-5" style="border: 1px solid black;">
                                <input type="file" name="pic_kc" >
                            </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-7">
                              <div class="row" style="color: red;">*Outside เลือกปลายทางเป็น CAB01</div>
                              <div class="row" style="color: red;">*โรงยิม เลือกปลายทางเป็น อาคารหอพัก 35</div>
                              <div class="row" style="color: red;"> *อาคาร 3 A เลือกปลายทางเป็น อาคาร 1</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <button type="submit" class="btn btn-facebook">บันทึก</button>
                      </div>
                    </div>
                  </form>
                  <!--form -->
                  </div>
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
                     <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>  Close</button>
                     <a class="btn btn-facebook" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
             </div>
          </div>
        </div>                  
        <!--=================================== End Modal logout =============================================-->


  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery-3.4.1.min.js"></script>
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


    <script type="text/javascript">
      showfloor=(b_eq_id)=>{
        $.ajax({
          type:"POST",
          url:"ajaxShowFloor.php",
          data: "b_eq_id="+b_eq_id+
                "&type=floor_kc",
          success : function(result){
            $("#showfloor").html(result)
          }
        });
      }
      showeq_id=(floor,b_eq_id)=>{
        $.ajax({
          type:"POST",
          url:"ajaxshoweq_idkc_map.php",
          data: "floor="+floor+
                "&b_eq_id="+b_eq_id,
          success : function(result){
            $("#showeq_id").html(result)
          }
        });
      }


      
    </script>
</body>

</html>
