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
$eq_id=$_GET['eq_id'];
$sql=$mysqli->query("SELECT t_id,label
                    FROM terminal
                    WHERE eq_id='$eq_id'
                    GROUP BY label
                    ");
$result=$sql->num_rows;
$label=array();
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($label,$row);
}
?>
<?php
 $page="edit";
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
                <h4 class="card-title">Edit Terminal</h4>
              </div>
              <div class="card-body">
                <form action="updatestatus.php" method="POST" id="frm_update">
                <!--form group-->
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-5">
                      <span class="title-add_edit">label</span> 
                      <select name="t_id" class="form-control" onchange="show_edit(this.value);">
                      <option value="" selected>----------เลือก Label---------</option>
                      <?php
                        foreach($label as $value){
                        ?>
                        <option value="<?=$value['t_id'];?>"><?=$value['label'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                        <input type="hidden" name="eq_id" value="<?=$eq_id;?>"/>
                    </div>
                  </div>
                </div>
                 <!--form group-->
                <!--form group-->
                <div class="form-group">
                  <div class="row justify-content-center">
                    <div class="col-12">
                      <div id="showteminal"></div>
                    </div>
                  </div>
                </div>
                 <!--form group-->
                <!--form group-->
                <div class="form-group">
                  <div class="row justify-content-center">
                        <a href="./edit_teminal.php" class="btn btn-facebook">ย้อนกลับ</a>
                        <button type="submit" class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกหรือไม่?');">บันทึก</button>
                  </div>
                </div>
                 <!--form group-->
                 </form>
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

   <!--validate-->
   <script src="./assets/vendor/validate/jquery.validate.js"></script>

    <!--data table js-->
    <script src="./assets/js/jquery.dataTables.min.js" ></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js" ></script>


    <script type="text/javascript">
    //-------------validate--------------
  $("#frm_update").validate({
        rules: {
          t_id: {
            required : true
          }
        },
        messages: {
          t_id: {
                required :"เลือก label"
            }
            
        }
      });
      //-------------End validate--------------


      show_edit=(t_id)=>{
        $.ajax({
          type:"POST",
          url:"ajaxshowterminal_edit.php",
          data:"t_id="+t_id,
          success:function(result){
            $("#showteminal").html(result);
          }
        });
      }
      check= (id,status,tdslot) =>{
        if($("#"+id).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก/
          $("#"+tdslot).removeClass();
          $("#"+tdslot).addClass("select_slot_edit");

        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก
          $("#"+tdslot).removeClass();
          $("#"+tdslot).addClass(status);
        }
      }
     
    </script>
</body>

</html>
