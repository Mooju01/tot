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

$_SESSION['hotel_id']=$_GET['hotel_id'];
$_SESSION['hotel_no']=$_GET['hotel_no'];
$_SESSION['location']=$_GET['location'];
$_SESSION['type']='hotel';

$src_terminal=array();
$sql=$mysqli->query("SELECT t_id,label
                    FROM terminal
                    WHERE eq_id='AB001F01A001' AND t_id LIKE 'pt%'
                    GROUP BY label");
$result=$sql->num_rows;
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($src_terminal,$row);
}
// $sql=$mysqli->query("SELECT location
//                     FROM equipment
//                     WHERE eq_id='$eq_id'
//                     ");
// $result=$sql->num_rows;
// while($row=$sql->fetch_assoc()){
//   $addlocation=array(
//     "distination_name"=>$row['location'],
//     "eq_id"=>$eq_id
//   );
//   array_push($location,$addlocation);
// }

    $page='addtel_hotel';
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
                <!--========================================= card ===============================-->
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">เพิ่มเบอร์โทรศัพท์
                </div>
                <div class="card-body">
                  <!--=========================== Block 1 ==================================-->
                    <div class="row" id="block1">
                      <div class="col-12">
                        <!--terminal primary pabx-->
                          <div class="form-group">
                            <div class="row justify-content-center">
                              <div class="col-7">
                                <label>เลือกเบอร์โทรศัพท์</label>
                                  <select class="form-control form-control-alternative" id="selectteminal" name="teminal"
                                          onchange="showterminal(this.value,'add')">
                                  <option value="" selected>-----เลือกเบอร์โทรศัพท์-----</option>
                                  <?php
                                    foreach($src_terminal as $value ){
                                  ?>
                                  <option value="<?=$value["t_id"];?>"><?=$value["label"];?></option>
                                  <?php
                                    }
                                  ?>
                                  </select>
                              </div>
                            </div>
                          </div>
                            <!--terminal primary pabx-->
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-12" id="SelectTerminal"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <a href="./AddTel_hotel.php" class="btn btn-facebook"> ย้อนกลับ</a>
                                </div>
                            </div>
                      </div>
                    </div>
                  <!--=========================== Block 1 ==================================-->
                  <!--=========================== Block 2 ==================================-->
                  <form action="#" id="conclusion">
                    <div class="row" id="block2" style="display: none;">
                      <div class="col-12">
                        <div id="showmaphotel"></div>
                        <div class="form-group">
                        <div class="row justify-content-center">
                          <button
                            type="button"
                            class="btn btn-facebook "
                            id="back_block_telecom"
                            onclick="backpage('2','1')"
                          >
                            ย้อนกลับ
                          </button>
                          <button
                            type="button"
                            id="btn_block2"
                            class="btn btn-facebook"
                          >
                            ถัดไป
                          </button>
                        </div>
                      </div>
                      </div>
                    </div>
                  </form>
              <!--=========================== Block 2 ==================================-->
                  <!--=========================== Block 3 ==================================-->
                    <div class="row" id="block3" style="display: none;">
                      <div class="col-12">
                        <div id="showconclusion"></div>
                      </div>
                    </div>
              <!--=========================== Block 3 ==================================-->
                </div>
              </div>
          <!--========================================= card ===============================-->
            </div>
          </div>
        </div>
      </div>
      <?php
      include '../footer.php';
      ?>
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



<script type="text/javascript">

$(document).ready(function() {
  } );

 //เมื่อกด Radio ส่งประเภท
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

      //เพิ่มเบอร์ip phone ไปหน้าสรุป
      addiptel=()=>{
        let ip_tel=$("#ip_tel").val();
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

      //ไปยังหน้า map
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

      //กดพ่วงเบอร์
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

      //check กดเซ็คบ๊อกแล้วเลือกตัวบน
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


      //กดถัดไปหลังเลือกterminalที่ต้องการพ่วง
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
      url: "ajaxmaphotel.php",
      data: "tel=" + tel +
            "&slot="+slot +
            "&label="+label,
      success: function(result) {
        $("#block1").hide();
        $("#block2").show();
        $("#showmaphotel").html(result);
      }
    });
};



  //เปิดหน้าเลือก mdf , kc
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

  //show slot
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

  //show label/slot
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



  $("#btn_block2").click(function() {
      $.ajax({
      type: "POST",
      url: "ajaxconclusion_add.php",
      data: $("#conclusion").serialize()+
            "&type=hotel",
      success: function(result) {
        $("#block2").hide();
        $("#block3").show();
        $("#showconclusion").html(result);
        
      }
    });
    
  });

  
  
  
  //หน้าพ่วงเบอร์กรณี เลือกเส้นทาง
  addnewmap = () => {
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
  };
  //หน้าพ่วงเบอร์กรณี เลือกเส้นทาง
  

  //funcion หน้า ajaxaddnewmapnew
  conclusion=(thispage,oldpage,form_id)=>{
    $.ajax({
      type:"POST",
      url: "ajaxconclusion_add.php",
      data: $("#"+form_id).serialize()+
            "&type=hotel"+
            "&thispage="+thispage+
            "&oldpage="+oldpage,
      success : function(result){
        $("#"+oldpage).hide();
        $("#block_conclusion").show();
        $("#showconclusion").html(result);
      }
    });
  }
  //funcion หน้า ajaxaddnewmapnew
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

  
  showlocation=(location)=>{
      $("#show_location").text(location);
    }

  
</script>
</body>

</html>
