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
$_SESSION['type']='emp';
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
    $page='addtel_emp';
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
  <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.min.css">
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
              <!--========================================= card ===============================-->
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">เพิ่มเบอร์โทรศัพท์
              </div>
              <div class="card-body">
                <!--=========================== Block 1 ==================================-->
                <form method="POST">
                <div class="col-12" id="block1">
                      <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">เพิ่มเบอร์ใหม่</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">พ่วงเบอร์</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                            <form action="#" method="POST" id="frm_selet_type">
                                            <div class="row justify-content-center">
                                                <div class="custom-control custom-radio mb-6">
                                                    <input name="type_phone" class="custom-control-input" id="customRadio1" type="radio" value='normal_tel' onclick='sel_type_phone(this.value);' checked>
                                                    <label class="custom-control-label" for="customRadio1">เบอร์ธรรมดา</label>
                                                </div>
                                                &emsp;
                                                <div class="custom-control custom-radio mb-6">
                                                    <input name="type_phone" class="custom-control-input" id="customRadio2" type="radio" value='ipphone' onclick='sel_type_phone(this.value);'>
                                                    <label class="custom-control-label" for="customRadio2">IP Phone</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="show_select"></div>  
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                            
                                            <form method="POST">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="row justify-content-center">
                                                            <div class="col-12">
                                                            <span class="star" style="font-size:16px">เลือกคนที่ต้องการพ่วง*</span>
                                                                <table id="search" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                                                <thead>
                                                                        <tr>
                                                                        <th>รหัสพนักงาน</th>
                                                                        <th>ชื่อ-สกุล</th>
                                                                        <th>อีเมลล์</th>
                                                                        <th>ส่วนงานที่สังกัด</th>
                                                                        <th>เบอร์โทรศัพท์</th>
                                                                        <th>สถานที่นั่ง</th>
                                                                        
                                                                        <th>พ่วงเบอร์</th>
                                                                        </tr>
                                                                    </thead>
                                                                
                                                                    <tbody>
                                                                    <?php
                                                                    $sql=$mysqli->query("SELECT employee.emp_id,employee.emp_name,employee.emp_email,center.div_code,emp_tel.tel,emp_tel.type_phone,employee.location,emp_tel.route,route_tel.memo
                                                                                        FROM employee
                                                                                        INNER JOIN emp_tel
                                                                                        ON employee.emp_id=emp_tel.emp_id
                                                                                        INNER JOIN center
                                                                                        ON employee.center_id=center.center_id
                                                                                        INNER JOIN route_tel
                                                                                        ON emp_tel.route=route_tel.route
                                                                                        WHERE memo!=''");
                                                                    while($row = $sql->fetch_assoc())
                                                                    {
                                                                    ?>
                                                                    <tr>
                                                                    <td><?php echo $row["emp_id"]; ?></td>
                                                                    <td><?php echo $row["emp_name"]; ?></td>
                                                                    <td><?php echo $row["emp_email"]; ?></td>
                                                                    <td><?php echo $row["div_code"]; ?></td>
                                                                    <td><?php echo $row["tel"]; ?></td>
                                                                    <td><a href="" class="btn btn-warning" data-toggle="modal" data-target="#modal_location" onclick="showlocation('<?=$row['location'];?>','<?=$row['memo'];?>');">
                                                                          <i class="fa fa-eye" aria-hidden="true"></i>
                                                                        </a></td>
                                                                    
                                                                    <td> <button type="button" class="btn btn-success" onclick="Shared_tel('<?=$row['emp_id'];?>','<?=$row['tel'];?>');">พ่วง</button></td> 
                                                                    </tr>
                                                                    <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row justify-content-center">
                                                            <a href="AddTel.php" class="btn btn-facebook"> ย้อนกลับ</a>
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
                  </div>
                </form>
                <!--=========================== Block 2 ==================================-->
                  <div class="row" id="block2" style="display: none;">
                    <div class="col-12">
                        <div id="showlocation"></div>                                               
                    </div>
                  </div>
            <!--=========================== block_telecom ==================================-->
            <form action="#" id="conclusion">
                  <div class="row" id="block_telecom" style="display: none;">
                    <div class="col-12">
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <div class="col-12">
                            <div id="maptelecom"></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <button
                            type="button"
                            class="btn btn-facebook "
                            id="back_block_telecom"
                            onclick="backpage('block_telecom','2')"
                          >
                            ย้อนกลับ
                          </button>
                          <button
                            type="button"
                            id="next_block_telecom"
                            class="btn btn-facebook"
                          >
                            ถัดไป
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>
            <!--=========================== block_conclusion ==================================-->
                  <div class="row" id="block_conclusion" style="display: none;">
                    <div class="col-12">
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <div class="col-12">
                            <div class="col-12" id="showconclusion"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            <!--=========================== block_sharedtel ==================================-->
                  <div class="row" id="block_sharedtel" style="display: none;">
                    <div class="col-12">
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <div class="col-12">
                            <div class="col-12" id="show_sharedtel"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            <!--=========================== block_choice ==================================-->
                  <div class="row" id="block_choice" style="display: none;">
                    <div class="col-12">
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <div class="col-12">
                            <div class="col-12" id="show_choice"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            <!--=========================== Block 2 ==================================-->
                  <div class="row" id="block_addnewmap" style="display: none;">
                    <div class="col-12">
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <div class="col-12">
                            <div class="col-12" id="addnewmap"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            <!--=========================== Block 2 ==================================-->
              </div>
            </div>
        <!--========================================= card ===============================-->
          </div>
        </div>
      </div>
      <!-- footer -->
      <?php
        include '../footer.php';
      ?>
      <!-- footer -->
    </div>
  </div>


    <!--modal location detail-->
  <div class="modal fade" id="modal_location" tabindex="1" role="dialog" aria-labelledby="Modalterminal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">สถานที่นั่ง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="row">
          <div class="col-12">
          รายละเอียดโซนที่นั่ง : 
            <span id="show_location"></span>
          </div>
        </div>
        <div id="row">
          <div class="col-12">
          สถานที่ปลายทาง : 
            <span id="show_memo"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal location detail-->

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
  <script src="./assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

  <script src="./assets/js/bootstrap-select.js"></script>

   <!--validate-->
   <script src="./assets/vendor/validate/jquery.validate.js"></script>

    <!--data table js-->
    <script src="./assets/js/jquery.dataTables.min.js" ></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js" ></script>
    <script src="./assets/js/dataTables.responsive.min.js" ></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js" ></script>



<script type="text/javascript">





$(document).ready(function() {
    $('#search').DataTable();
    let type_phone = $("input[name='type_phone']:checked").val();
    if(type_phone){
        $.ajax({
            type: "POST",
            url: "ajaxaddtel.php",
            data: "type_phone="+type_phone,
            success: function(result) {
                $("#show_select").html(result);
            }
        });
    }else{

    }

  } );

 //เมื่อกด Radio ส่งประเภท/
    sel_type_phone=(type_phone)=>{
        $.ajax({
          type: "POST",
          url: "ajaxaddtel.php",
          data: "type_phone="+type_phone,
          success: function(result) {
            $("#show_select").html(result);
          }
        });
    }

      //เพิ่มเบอร์ip phone ไปหน้าสรุป/
      addiptel=()=>{
        let ip_tel=$("#ip_tel").val();
        if(ip_tel==''){
          alert('กรุณากรอกหมายเลขโทรศัพท์');
          $("#ip_tel").focus();
        }else{
          $.ajax({
            type: "POST",
            url: "checkipphone.php",
            data: "tel="+ip_tel,
            success: function(result) {
              if(result=='true'){
                alert('เบอร์โทรศัพท์ซ้ำ');
              }else{
                $.ajax({
                  type: "POST",
                  url: "ajaxconclusion_add.php",
                  data: "tel="+ip_tel+
                        "&type=emp",
                  success: function(result) {
                    $("#showconclusion").html(result);
                    $("#block1").hide();
                    $("#block_conclusion").show();
                  }
                });
              } 
            }
          });
        }
      }

      //ไปยังหน้า map/
      maptelecom=()=>{
        $.ajax({
          type: "POST",
          url: "ajaxmaptelecom.php",
          data: $("#frm_location").serialize(),
          success: function(result) {
            $("#block2").hide();
            $("#block_telecom").show();
            $("#maptelecom").html(result);
          }
        });
      }
      //ไปยังหน้า map

      //กดพ่วงเบอร์/
      Shared_tel=(emp_id,tel)=>{
        $.ajax({
          type: "POST",
          url: "ajaxsharedtel.php",
          data: "emp_id="+emp_id+
                "&tel="+tel,
          success: function(result){
            $("#show_sharedtel").html(result);
            $("#block1").hide();
            $("#block_sharedtel").show();
          }
        });
      }

      //check กดเซ็คบ๊อกแล้วเลือกตัวบน/
      checklocation=(count)=>{
        let $maxchechbox=0;
        $("input[name*='Check']:checkbox").each(function (){
          $maxchechbox++;
        });
        if($("#customCheck"+count).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก
              for($i=count;$i>=0;$i--){
                $("#customCheck"+$i).prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี id ตามกำหนด 
              }
        }else{ // ถ้าไม่มีการ ยกเลิกการเลือก
            for($i=0;$i<$maxchechbox;$i++){
              $("#customCheck"+$i).prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี id ตามกำหนด 
            }          
        }  
        
      }


      //กดถัดไปหลังเลือกterminalที่ต้องการพ่วง/
      choiceadd=()=>{
        if($("input[name*='Check']:checkbox").prop("checked")){
          $.ajax({
            type: "POST",
            url: "ajaxchoice.php",
            data: $("#frm_checkadd").serialize(),
            success : function(result){
              $("#show_choice").html(result);
              $("#block_choice").show();
              $("#block_sharedtel").hide();
            }
          });
        }else{
          alert("กรุณาเลือกอย่างน้อย 1 ช่อง");
        }
        
      }

      

//ย้อนกลับ/
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


//show termianl 100ช่อง/
showterminal = (t_id, action) => {
    $.ajax({
      type: "POST",
      url: "ajaxshowterminal.php",
      data: "t_id=" + t_id + "&action=" + action,
      success: function(result) {
        $("#SelectTerminal").html(result);
      }
    });
  };
  //show termianl 100ช่อง
  
//หลังจากเลือกเบอร์ เปิดช่องและโชว์ให้เลือก ปลายทาง/
sel_terminal = (tel,slot,label) => {
    $.ajax({
      type: "POST",
      url: "ajaxshowlocation.php",
      data: "tel=" + tel +
            "&slot="+slot +
            "&label="+label,
      success: function(result) {
        $("#block1").hide();
        $("#block2").show();
        $("#showlocation").html(result);
      }
    });
};
//หลังจากเลือกเบอร์ เปิดช่องและโชว์ให้เลือก ปลายทาง
//โชว์ชั้น/
showfloor = b_eq_id => {
  $("#error_buile").hide();
    $.ajax({
      type: "POST",
      url: "ajaxShowFloor.php",
      data: "b_eq_id=" + b_eq_id,
      success: function(result) {
        $("#selectfloor").html(result);
      }
    });
  }
  //โชว์ชั้น
  

  //เปิดหน้าเลือก mdf , kc ใน modal หน้า maptelecom/
  slectslot = (next_eq_id, eq_id, showid, showfirstid, labelid, slotid,status) => {
    $.ajax({
      type: "POST",
      url: "ajaxselectteminalsec.php",
      data:
        "eq_id=" +
        eq_id +
        "&eq_id_next=" +
        next_eq_id +
        "&showid=" +
        showid +
        "&showfirstid=" +
        showfirstid +
        "&labelid=" +
        labelid +
        "&slotid=" +
        slotid +
        "&status=" +
        status,
      success: function(result) {
        $("#result").html(result);
      }
    });
  };

  //show temina 100 ช่องเพื่อเลือก slot secondary/
  showterminalsec = (label) => {
    $.ajax({
      type: "POST",
      url: "ajaxshowterminalsec.php",
      data:"label=" + label,
      success: function(result) {
        $("#SelectTerminalsec").html(result);
      }
    });
  };

  //show label/slot/
  selectsec = (slot, label, showid, showfirstid, labelid, slotid,next_eq_id,status) => {
    $("div #" + next_eq_id).show();
    $("#" + showid).text(label+"/slot :"+slot);
    $("#" + showfirstid).text(label+"/slot :"+slot);
    $("#" + slotid).attr("value", slot);
    $("#" + labelid).attr("value", label);
    $("." + slotid).attr("value", slot);
    $("." + labelid).attr("value", label);
    if(status=='stop'){
      $.ajax({
      type: "POST",
      url: "ajaxsearchkc.php",
      data: "label=" + label + 
            "&slot=" + slot+
            "&type=add",
      success: function(result) {
        $("#showkc").html(result);
      }
    });
    }
  };

  // //show kc map/
  // kcmap=(eq_id_kc)=>{
  //   $.ajax({
  //     type: "POST",
  //     url: "ajaxkcmap.php",
  //     data: "eq_id_kc="+eq_id_kc,
  //     success: function(result) {
  //       $("#kcmap").html(result);
  //     }
  //   });
  // }
  // //show kc map



  $("#next_block_telecom").click(function() {
      $.ajax({
      type: "POST",
      url: "ajaxconclusion_add.php",
      data: $("#conclusion").serialize()+
            "&type=emp",
      success: function(result) {
        $("#showconclusion").html(result);
        $("#block_telecom").hide();
        $("#block_conclusion").show();
      }
    });
    
  });

  
  
  
  //หน้าพ่วงเบอร์กรณี เลือกเส้นทาง/
  addnewmap = () => {
    let b_eq_id=$("select[name='b_eq_id']").val();
    let eq_id=$("select[name='eq_id']").val();
    if(b_eq_id==""){
      $("#error_buile").show();
    }else{
      if(eq_id==""){
      $("#error_mdf").show();
    }else{
      $.ajax({
      type: "POST",
      url: "ajaxaddnewmapnew.php",
      data: $("#selectnewmap").serialize()+
            "&type=add",
      success: function(result) {
        $("#block_choice").hide();
        $("#block_addnewmap").show();
        $("#addnewmap").html(result);
      }
    });
    }
    }
    
  };
  //หน้าพ่วงเบอร์กรณี เลือกเส้นทาง
  

  //funcion หน้า ajaxaddnewmapnew/
  conclusion=(thispage,oldpage,form_id)=>{
    $.ajax({
      type:"POST",
      url: "ajaxconclusion_add.php",
      data: $("#"+form_id).serialize()+
            "&type=emp"+
            "&thispage="+thispage+
            "&oldpage="+oldpage,
      success : function(result){
        $("#"+oldpage).hide();
        $("#block_conclusion").show();
        $("#showconclusion").html(result);
      }
    });
  }
  //funcion หน้า ajaxaddnewmapnew/
  src_emp=(slot,eq_id)=>{
    $.ajax({
      type:"POST",
      url: "ajaxkcemp.php",
      data: "eq_id="+eq_id+
            "&slot="+slot,
      success : function(result){
        $("#showkcemp").html(result);
      }
    });
  }

  
  showlocation=(location,memo)=>{
          $("#show_location").text(location);
          if(memo==''){
            memo='-'
          }
          $("#show_memo").text(memo);

        }
  //เช็คหน้า showfloor ว่าเลือกหรือยัง
  check_mdf=b_eq_id=>{
    if(b_eq_id==""){
      $("#error_mdf").show();
    }else{
      $("#error_mdf").hide();
    }
  }
</script>


    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#emp_all').DataTable();
        } );  
    </script>
</body>

</html>
