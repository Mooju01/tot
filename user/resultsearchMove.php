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
$arraylocation=array();
$arraylabelpri=array();
$arraylabelsec=array();
$arrayslotpri=array();
$arrayslotsec=array();
$_SESSION['emp_id']=$_GET['emp_id'];
$_SESSION['tel']=$_GET['tel'];
$_SESSION['route']=$_GET['route'];
//search emp info
$sql=$mysqli->query("SELECT emp_id,emp_name,emp_email,position_code,div_code,location
                    FROM employee
                    INNER JOIN center
                    ON employee.center_id=center.center_id
                    WHERE emp_id='".$_SESSION['emp_id']."'");
$result=$sql->num_rows;
$_SESSION['emp_info']=array();
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($_SESSION['emp_info'],$row);
}

//search tel map
$sql=$mysqli->query("SELECT route_tel.eq_id,route_tel.label,route_tel.type,route_tel.slot,equipment.location,route_tel.memo
                    FROM route_tel
                    INNER JOIN equipment
                    ON route_tel.eq_id=equipment.eq_id
                    WHERE route_tel.route='".$_SESSION['route']."' AND route_tel.tel='".$_SESSION['tel']."'
                    ORDER BY route_tel.eq_id ASC");
$result=$sql->num_rows;
$arraysearchmap=array();
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($arraysearchmap,$row);
}
foreach($arraysearchmap as $value){
    if($value['type']=='pt' || $value['type']=='tt'){
      $addlocation=array(
        'location'=>$value['location'],
        'eq_id'=>$value['eq_id']
      );
      array_push($arraylocation,$addlocation);
      array_push($arraylabelpri,$value['label']);
      array_push($arrayslotpri,$value['slot']);
      if($value['type']=='tt'){
        $memo=$value['memo'];
      }
      
    }else{
      array_push($arraylabelsec,$value['label']);
      array_push($arrayslotsec,$value['slot']);
    }                         
}
unset($arraysearchmap);


//หา primary ใน pabx
$src_terminal=array();
$sql=$mysqli->query("SELECT t_id,label
                    FROM terminal
                    WHERE eq_id='AB001F01A001' AND t_id LIKE 'pt%'
                    GROUP BY label
                    ORDER BY t_id ASC");
$result=$sql->num_rows;
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($src_terminal,$row);
}


?>
<?php
 $page="move";
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
  <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome-4.7.0/css/font-awesome.css">
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
                <h4 class="card-title">ย้ายเบอร์โทรศัพท์</h4>
              </div>
              <div class="card-body">
            <!--=========================== Block 1 ==================================-->
                <form action="" method="post" id="chechblock1">
                <div class="row" id="block1">
                  <div class="col-12">
                    <!--==================================emp info============================-->
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <h3>ข้อมูลพนักงาน</h3>
                      </div>        
              <?php
              foreach($_SESSION['emp_info'] as $value){
              ?>
              <div class="row">
                <div class="col-3">
                </div>
                <div class="col-4">
                  <span class="info-around">รหัสพนักงาน : <?=$value['emp_id'];?></span> 
                </div>
                <div class="col-5">
                <span class="info-around">ชื่อพนักงาน : <?=$value['emp_name'];?></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">อีเมล์ : <?=$value['emp_email'];?></span> 
                </div>
                <div class="col-5">
                <span class="info-around">ส่วนงานที่สังกัด : <?=$value['div_code'];?></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">สถานที่นั่ง : <?=$value['location'];?></span> 
                </div>
              </div>
              <div class="row">
              <div class="col-3">
                </div>
                <div class="col-4">
                <span class="info-around">เบอร์โทร: <?=$_SESSION['tel'];?></span> 
                </div>
              </div>
              <?php
              }
              ?>
              <hr>
                    </div>
                    <!--==================================emp info end============================-->
                    <div class="form-group">
                      <div class="row justify-content-center">
                        
                            <h3>เส้นทางเก่า</h3>
                       
                      </div>
                      <div class="row">
                        <div class="col-12 map_title">เลือกจุดที่ต้องการย้าย</div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-4 head_title">สถานที่</div>
                        <div class="col-4 head_title">Terminal Primary</div>
                        <div class="col-4 head_title">Terminal Secondary</div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <div class="col-12">
                        <?php
                        $count=0;
                            foreach($arraylabelpri as $key => $value ){
                              
                        ?>
                        <div class="row">
                          <div class="col-4">
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="customCheck<?=$count;?>" type="checkbox" name="Check[]" value="<?=$count;?>" onclick="checklocation(this.value)">
                                <label class="custom-control-label location_name" for="customCheck<?=$count;?>"><?=$arraylocation[$key]['location'];?></label>
                                <input type="hidden" name="location[]" value="<?=$arraylocation[$key]['location'];?>">
                                <input type="hidden" name="eq_id[]" value="<?=$arraylocation[$key]['eq_id'];?>">
                            </div>
                          </div>
                          <div class="col-4">
                              <input type="hidden" name="labelpri[]" value="<?=$arraylabelpri[$key];?>">
                              <input type="hidden" name="slotpri[]" value="<?=$arrayslotpri[$key];?>">
                              <span class="label_slot"><?=$arraylabelpri[$key];?>/slot :<?=$arrayslotpri[$key];?></span>
                          </div>
                          <?php
                              if(isset($arraylabelsec[$key])){
                          ?>
                          <div class="col-4">
                              <input type="hidden" name="labelsec[]" value="<?=$arraylabelsec[$key];?>">
                              <input type="hidden" name="slotsec[]" value="<?=$arrayslotsec[$key];?>">
                              <span class="label_slot"><?=$arraylabelsec[$key];?>/slot :<?=$arrayslotsec[$key];?></span>
                          </div>
                          <?php
                              }else{
                                ?>
                                <div class="col-4">
                                <span class="label_slot"><?=$memo;?></span>
                                <input type="hidden" name="memo" value="<?=$memo;?>">
                                </div>
                                <?php
                                }
                          ?>
                        </div>
                        <?php
                        $count++;
                            }
                        ?>
                        <span class="star">*ปลายทางอาคารเฉลิมฯ ไม่ต้องถอดสายที่อาคารภักดีราชา</span>
                        </div>                          
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <a href="./MoveTel.php" class="btn btn-facebook">ย้อนกลับ</a>
                            <button type="button" class="btn btn-facebook" id="nextblock1">ถัดไป</button>
                        </div>
                    </div>
                  </div>
                </div>
                </form>
                <!--=========================== Block 2 ajaxnewmap.php==================================-->
                <div class="row" id="block2" style="display: none;">
                  <div class="col-12">
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <div class="col-12">
                          <div id="newmap"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--=========================== Block 3 ajaxaddnewmapnew.php==================================-->
                <div class="row" id="block3" style="display: none;">
                  <div class="col-12">
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <div class="col-12">
                          <div id="addnewmap"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--========================== Block 4 ajaxconclusion.php=========================================-->
                <div class="row" id="block4" style="display: none;">
                  <div class="col-12">
                    <div class="form-group">
                      <div class="row justify-content-center">
                        <div class="col-12">
                          <div id="showconclusion"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--=========================== Block 5 กรณีเลือกทั้งหมด ==================================-->
                <div class="row" id="block5" style="display: none;">
                    <div class="col-12">
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <div class="col-7">
                            <label>เลือกเบอร์โทรศัพท์<span class="star">*</span></label>
                            <select
                              class="form-control form-control-alternative"
                              id="selectteminal"
                              name="teminal"
                              onchange="showterminal(this.value,'move')"
                            >
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
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <div class="col-md-12" id="SelectTerminal"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row justify-content-center">
                        <button
                            type="button"
                            class="btn btn-facebook "
                            id="backblock3"
                            onclick="backpage('5','2')"
                          >
                            ย้อนกลับ
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                <!--========================== end =========================================-->
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
      $(document).ready(function() {
        let $maxchechbox=0;
        $("input[type='checkbox']").each(function (){
          $maxchechbox++;
        });
        checklocation=(count)=>{
          if($("#customCheck"+count).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก/
              for($i=count;$i<$maxchechbox;$i++){
                $("#customCheck"+$i).prop("checked",true); // กำหนดให้ เลือก checkbox ที่ต้องการ ที่มี id ตามกำหนด 
              }
              
          }else{ // ถ้าไม่มีการ ยกเลิกการเลือก
            for($i=0;$i<$maxchechbox;$i++){
              $("#customCheck"+$i).prop("checked",false); // กำหนดให้ ยกเลิกการเลือก checkbox ที่ต้องการ ที่มี id ตามกำหนด 
            }          
          }
        }
      });

      //click id nextblock1/
$("#nextblock1").click(function() {
  let count=0;
  let maxchechbox=0;
  $("input[type='checkbox']").each(function (){
    maxchechbox++;
  });
  for(i=0;i<maxchechbox;i++){
    if($("#customCheck"+i).prop("checked")){ // ตรวจสอบค่า ว่ามีการคลิกเลือก/
      count++;
    }
  }
  if(count>0){
            $.ajax({
            type: "POST",
            url: "ajaxnewmap.php",
            data: $("#chechblock1").serialize(),
            success: function(result) {
              $("#block1").hide();
              $("#block2").show();
              $("#newmap").html(result);
            }
          });
        }else{
          alert("กรุณาเลือกอย่างน้อย 1 ช่อง");
        }
  
});
//end click id nextblock1
      //click id nextblock2/
      addnewtel=()=>{
        let b_eq_id=$("select[name='b_eq_id']").val();
        let eq_id=$("select[name='eq_id']").val();

        if(b_eq_id==""){
          $("#error_buile").show();
        }else{
          if(eq_id==""){
          $("#error_mdf").show();
          }else{
            $("#block2").hide();
            $("#block5").show();
          }
        }
      }
      //end click id nextblock2

      //click id nextblock2/
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
                    "&type=move&oldpage=2",
              success: function(result) {
                $("#block2").hide();
                $("#block3").show();
                $("#addnewmap").html(result);
              }
            });
          }
        }
      };
      //end click id nextblock2

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
            //$("#block2").hide();
            $("#result").html(result);
          }
        });
        //$(".testshow").text($("#check").serialize() + "&tel=" + tel);
      };

      

      showterminalsec = (label) => {
        $.ajax({
          type: "POST",
          url: "ajaxshowterminalsec.php",
          data: "label=" + label ,
          success: function(result) {
            $("#SelectTerminalsec").html(result);
          }
        });
      };

      //เลือกเส้นทางใหม่
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
      };

      //show label/slot
      selectsec = (slot, label, showid, showfirstid, labelid, slotid,next_eq_id,status) => {
        $("div #" + next_eq_id).show();
        $("#" + showid).text(label+"/ slot :"+slot);
        $("#" + showfirstid).text(label+"/ slot :"+slot);
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
                "&type=move",
          success: function(result) {
            $("#showkc").html(result);
          }
        });
        }



      };
     
      //ซ้ำกับshowteminal.php
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

      selectprimaryterminal = (slot,label,tel) => {
        $.ajax({
          type: "POST",
          url: "ajaxaddnewmapnew.php",
          data: $("#selectnewmap").serialize()+
                "&slot=" +slot+
                "&label="+label+
                "&newtel="+tel+
                "&oldpage=5&type=move",
          success: function(result) {
            $("#block5").hide();
            $("#block3").show();
            $("#addnewmap").html(result);
          }
        });
        //$(".testshow").text($("#check").serialize() + "&tel=" + tel);
      };

      //ปุ่มย้อนกลับ
      backpage=(thispage,oldpage)=>{
          $("#block"+oldpage).show();
          $("#block"+thispage).hide();
      };


      //สรุป/
      conclusion=(page,form_id)=>{
        $.ajax({
          type: "POST",
          url: "ajaxconclusion_move.php",
          data: $("#"+form_id).serialize()+
                "&page="+page+
                "&type=move",
          success: function(result) {
            $("#block"+page).hide();
            $("#block4").show();
            $("#showconclusion").html(result);
          }
        });
      }


       //show kc map
       kcmap=(eq_id_kc)=>{
        $.ajax({
          type: "POST",
          url: "ajaxkcmap.php",
          data: "eq_id_kc="+eq_id_kc,
          success: function(result) {
            $("#kcmap").html(result);
          }
        });
      }
      //show kc map

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
      //เช็คหน้า showfloor ว่าเลือกหรือยัง
      check_mdf=b_eq_id=>{
        if(b_eq_id==""){
          $("#error_mdf").show();
        }else{
          $("#error_mdf").hide();
        }
      }


    </script>
</body>

</html>
