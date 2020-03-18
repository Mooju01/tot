<?php
include '../connect.php';
session_start();
$emp_id=$_GET['emp_id'];
$page='edit_emp_info';
//ค้นหาข้อมูลพนักงาน
$sql=$mysqli->query("SELECT employee.emp_id,employee.emp_name,employee.emp_email,employee.position_code,center.div_code,center.center_id,employee.location
                    FROM employee
                    INNER JOIN center
                    ON employee.center_id=center.center_id
                    WHERE emp_id='$emp_id'
                    ");
$emp_info=array();
while($row=$sql->fetch_assoc()){
    array_push($emp_info,$row);
    $position_code=$row['position_code'];
}

$sql=$mysqli->query("SELECT center_id,div_code,center_name
                    FROM center
                    ");
    $result=$sql->num_rows;
    $center=array();
    for($i=0;$i<$result;$i++){
      $row=$sql->fetch_assoc();
      array_push($center,$row);
    }
    // $position_name=substr($position_code,0,7);
    // $position_num=substr($position_code,7);
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="assets/img/TOT.png"
    />
    <link rel="icon" type="image/png" href="assets/img/TOT.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      Home
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
    <link rel="stylesheet" href="./assets/css/bootstrap-select.css">
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
        include './navbar.php';
        ?>
        <!-- End Navbar -->
        <div class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-9">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">แก้ไขข้อมูลพนักงาน</h4>
                </div>
                <div class="card-body">
                  <!--=========================== Block 1 ==================================-->
                  <form action="./update_user_info.php" method="POST" id="frm_emp">
                      <div class="row justify-content-center" id="block1">
                          <div class="col-8">
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                        <span class="title-emp">รหัสพนักงาน<span class="star">*</span></span>
                                            <input type="text" class="form-control" value="<?=$emp_info[0]['emp_id'];?>" disabled/>
                                            <input type="hidden" name="emp_id" value="<?=$emp_info[0]['emp_id'];?>">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                        <span class="title-emp">ชื่อ-นามสกุล<span class="star">*</span></span>
                                          <input type="text" class="form-control" name="emp_name" value="<?=$emp_info[0]['emp_name'];?>"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                        <span class="title-emp">E-mail<span class="star">*</span></span>
                                          <input type="text" class="form-control" name="email" value="<?=$emp_info[0]['emp_email'];?>"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                        <span class="title-emp">รหัสตำแหน่ง<span class="star">*</span></span>
                                          <input type="text" class="form-control" name="position_code" value="<?=$position_code;?>"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                        <span class="title-emp">สังกัด<span class="star">*</span></span>
                                          <select class=" form-control selectpicker " data-toggle="select" data-live-search="true" data-placeholder="Select a state" 
                                          name="center_id" id="center_id"
                                          >
                                            <option value="">----------เลือกสังกัด----------</option>
                                            <?php
                                            foreach($center as $value){
                                            ?>
                                            <option value="<?=$value['center_id'];?>" <?php echo ($emp_info[0]['center_id']==$value['center_id'])?'selected':NULL;?> ><?=$value['center_name'];?>&nbsp;(<?=$value['div_code'];?>)</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12">
                                      <div class="form-group">
                                        <span class="title-emp">รายละเอียดโซนที่นั่ง<span class="star">*</span></span>
                                          <input type="text" class="form-control" name="location" value="<?=$emp_info[0]['location'];?>"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="row ">
                                  <div class="col-12 ">
                                      <div class="row justify-content-center">
                                          <div class="form-group">
                                              <a href="./edit_emp_info.php" class="btn btn-facebook">ย้อนกลับ</a>
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
                                          <h3>ข้อมูลพนักงาน</h3>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                        <span class="emp-info">รหัสพนักงาน : <label id="emp_id" class="emp-info"></label></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                        <span class="emp-info">ชื่อ-นามสกุล : <label id="emp_name" class="emp-info"></label></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                        <span class="emp-info">E-mail : <label id="email" class="emp-info"></label></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                        <span class="emp-info">รหัสตำแหน่ง : <label id="position_code" class="emp-info"></label></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                        <span class="emp-info">สังกัด : <label class="center_id" class="emp-info"></label></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="row">
                                      <div class="col-12">
                                        <span class="room-info">รายละเอียดโซนที่นั่ง : <label id="location"></label>
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
    <!--validate-->
   <script src="./assets/vendor/validate/jquery.validate.js"></script>
    <script>
  //-------------validate--------------
  $("#frm_emp").validate({
        rules: {
            emp_name: {
                required : true
            },
            email:{
                required : true,
                email : true
            },
            location:{
                required : true
            },
            position_code:{
                required: true
            }
        },
        messages: {
            emp_name: {
                required :"กรอกชื่อ-นามสกุล"
            },
            email: {
                required :"กรอก E-mail",
                email : "รูปแบบ E-mail ไม่ถูกต้อง"
            },
            location:{
                required : "กรอกสถานที่นั่ง"
            },
            position_code:{
                required: "กรอกรหัสตำแหน่ง"
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
    

      $("#nextblock1").click(function() {
            if ($("#block1 input , #block1 select").valid()) {
                let emp_id=$("input[name='emp_id']").val();
                let emp_name=$("input[name='emp_name']").val();
                let email=$("input[name='email']").val();
                let position_code=$("input[name='position_code']").val();
                let center_id=$("#center_id option:selected").text();
                let location=$("input[name='location']").val();
                $("#block1").hide();
                $("#block2").show();
                $("#emp_id").text(emp_id);
                $("#emp_name").text(emp_name);
                $("#position_code").text(position_code);
                $("#email").text(email);
                $(".center_id").text(center_id);
                $("#location").text(location);
        }
      });
  
  </script>
  </body>
</html>