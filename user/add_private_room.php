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
?>
<?php
    $page='addroom';
    $sql=$mysqli->query("SELECT center_id,div_code
                    FROM center
                    ");
    $result=$sql->num_rows;
    $center=array();
    for($i=0;$i<$result;$i++){
      $row=$sql->fetch_assoc();
      array_push($center,$row);
    }
    unset($result);
    unset($sql);
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
            <div class="col-9">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">เพิ่มข้อมูลห้องใหม่</h4>
                </div>
                <div class="card-body">
                  <!--=========================== Block 1 ==================================-->
                  <form action="./save_addroom.php" method="POST" id="frm_room">
                      <div class="row justify-content-center" id="block1">
                          <div class="col-8">
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                      <span class="title-room">ชื่อห้อง<span class="star">*</span></span> 
                                          <input type="text" class="form-control" name="location_num"/>
                                      </div>
                                  </div>
                              </div>
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <span class="title-room">อาคาร<span class="star">*</span></span>
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
                                    <div class="col-12">
                                        <div id="selectfloor"></div>
                                    </div>
                                </div>
                            </div>
                              <div class="row ">
                                  <div class="col-12 ">
                                      <div class="row justify-content-center">
                                          <div class="form-group">
                                              <button type="button" class="btn btn-facebook" id="nextblock1" >ถัดไป</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <!--========================== End Block 1 ==================================-->
                  <!--=========================== Block 2 ==================================-->
                      <div class="row justify-content-center" id="block2" style="display:none;">
                          <div class="col-8">
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                          <h3>ข้อมูลห้องใหม่</h3>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                        <span class="room-info">ชื่อห้อง : <label id="location_num" class="room-info"></label></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                        <span class="room-info">อาคาร : <label id="b_eq_id" class="room-info"></label></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                        <span class="room-info">ที่อยู่ MDF : <label id="eq_id" class="room-info"></label></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                          <div class="row justify-content-center">
                                              <button type="button" id="backblock2" class="btn btn-facebook" onclick="backpage('2','1')">ย้อนกลับ</button>
                                              <button type="submit" id="nextblock2" class="btn btn-success">บันทึกข้อมูล</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
                  <!--========================== End Block 2 ==================================-->
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
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

  <script src="./assets/js/bootstrap-select.js"></script>

   <!--validate-->
   <script src="./assets/vendor/validate/jquery.validate.js"></script>


  <script>
  //-------------validate--------------
  $("#frm_room").validate({
        rules: {
          location_num: {
            required : true
          },
          b_eq_id:{
            required : true
          },
          eq_id:{
            required : true
          }
        },
        messages: {
          location_num: {
                required :"กรอกชื่อห้อง"
            },
            b_eq_id: {
                required :"โปรดระบุอาคาร"
            },
            eq_id: {
                required :"โปรดระบุที่อยู่ MDF ปลายทาง"
            }
            
        }
      });
      //-------------End validate--------------
      //ย้อนกลับ
    backpage=(thispage,oldpage)=>{
      if(!isNaN(thispage)){
        $("#block"+thispage).hide();
      }else{
        $("#"+thispage).hide();
        $("#block"+oldpage).show();
      }
      if(!isNaN(oldpage)){
        $("#block"+oldpage).show();
      }else{
        $("#"+oldpage).show();
      }
      }
    //ย้อนกลับ

    showfloor = b_eq_id => {
    $.ajax({
      type: "POST",
      url: "ajaxShowFloor.php",
      data: "b_eq_id=" + b_eq_id,
      success: function(result) {
        $("#selectfloor").html(result);
      }
    });
  }
    

      $("#nextblock1").click(function() {
        if ($("#block1 input , #block1 select").valid()) {
            let location_num=$("input[name='location_num']").val();
            let b_eq_id=$("select[name='b_eq_id'] option:selected").text();
            let eq_id=$("select[name='eq_id'] option:selected").text();
            $("#block1").hide();
            $("#block2").show();
            $("#location_num").text(location_num);
            $("#b_eq_id").text(b_eq_id);
            $("#eq_id").text(eq_id);
            
        }
      });
  
  </script>
</body>

</html>
