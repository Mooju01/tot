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
include './check_status_login.php';
$arraylocation=array();
$arraylabelpri=array();
$arraylabelsec=array();
$arrayslotpri=array();
$arrayslotsec=array();
$_SESSION['type']='hotel';
$_SESSION['type_change']=$_GET['type_change'];
$_SESSION['tel']=$_GET['tel'];
$_SESSION['route']=$_GET['route'];
$_SESSION['hotel_id']=$_GET['hotel_id'];
$type_phone=$_GET['typephone'];
if($_SESSION['type_change']=='emp'){
  //เปลี่ยนเบอร์พนักงาน
  $_SESSION['emp_id']=$_GET['emp_id'];
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
}elseif($_SESSION['type_change']=='hotel'){
//เปลี่ยนเบอร์หอพัก โรงแรม
  $hotel_id=$_GET['hotel_id'];
  $hotel_no=$_GET['hotel_no'];
  //search hotel name
  $sql=$mysqli->query("SELECT distination_name
                      FROM distination
                      WHERE b_eq_id='".$hotel_id."'");
  while($row=$sql->fetch_assoc()){
    $_SESSION['hotel_info']=array(
      "hotel_id"=>$hotel_id,
      "hotel_name"=>$row['distination_name'],
      "hotel_no"=>$hotel_no
    );
  }
  
}else{
  $p_id=$_GET['p_id'];
  $sql=$mysqli->query("SELECT location
                      FROM private_point
                      WHERE p_id='".$p_id."'");
  while($row=$sql->fetch_assoc()){
    $_SESSION['private_info']=array(
      "p_id"=>$p_id,
      "location"=>$row['location']
    );
  }
}


//search tel map
$sql=$mysqli->query("SELECT route_tel.eq_id,route_tel.label,route_tel.type,route_tel.slot,equipment.location,route_tel.memo
                    FROM route_tel
                    INNER JOIN equipment
                    ON route_tel.eq_id=equipment.eq_id
                    WHERE route_tel.route='".$_SESSION['route']."' AND route_tel.tel='".$_SESSION['tel']."'");
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
      if($value['type']=='tt'){
        $_SESSION['memo']=$value['memo'];
      }
      array_push($arraylocation,$addlocation);
      array_push($arraylabelpri,$value['label']);
      array_push($arrayslotpri,$value['slot']);
    }else{
      array_push($arraylabelsec,$value['label']);
      array_push($arrayslotsec,$value['slot']);
    }                         
}
unset($arraysearchmap);

//search tel
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
//search tel end
$sql=$mysqli->query("SELECT * FROM employee where emp_id = '".$_SESSION['username']."'");
while($row = $sql->fetch_assoc())
{
    $employee = $row['emp_name'];
	print_r($employee);
}


?>
<?php
 $page="MendHotel";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    TOT
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
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

    <link rel="stylesheet" type="text/css" href="./assets/datetimepicker/jquery.datetimepicker.css">
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
                <h4 class="card-title">ซ่อมเบอร์หอพัก/โรงแรม</h4>
              </div>
              <div class="card-body">
               <!--==================================emp info============================-->
               <form action="" method="post" id="chechblock1">
            <div class="form-group">       
              <?php
              if($_SESSION['type_change']=='hotel'){
              ?>
              <div class="row justify-content-center">
                <h3>ข้อมูลหอพัก/โรงแรม</h3>
              </div>
              <div class="row">
                <div class="col-3">
                </div>
                <div class="col-4">
                  ชื่ออาคาร : <?=$_SESSION['hotel_info']['hotel_name'];?>
                  <input type="hidden" name="hotel_name"value="<?=$_SESSION['hotel_info']['hotel_name'];?>">
                </div>
                <div class="col-5">
                  เบอร์ห้อง : <?=$_SESSION['hotel_info']['hotel_no'];?>
                  <input type="hidden" name="hotel_no"value="<?=$_SESSION['hotel_info']['hotel_no'];?>">
                </div>
              </div>
              <div class="row">
                <div class="col-3">
                </div>
                <div class="col-4">
                  เบอร์โทร : <?=$_SESSION['tel'];?>
                  <input type="hidden" name="username"value="<?=$_SESSION['tel'];?>">
                </div>
              </div>
              <?php
            }else{
              ?>
              <div class="row justify-content-center">
                <h3>ข้อมูลเบอร์ประจำชั้น</h3>
              </div>
              <div class="row">
                <div class="col-3">
                </div>
                <div class="col-4">
                  ชื่ออาคาร : <?=$_SESSION['private_info']['location'];?>
                </div>
                <div class="col-5">
                  เบอร์โทร : <?=$_SESSION['tel'];?>
                </div>
              </div>
              <?php
            }
              ?>
              <hr>
                    </div>
            <!--=========================== Block 1 ==================================-->
            <?php
            if($type_phone=='normal_tel')
            {
            ?>
                <div class="row" id="block1">
                  <div class="col-12">
                    <div class="form-group" id="block1">
                      <div class="row justify-content-center">
                            <h3>เส้นทาง</h3></div>
                
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
                            foreach($arraylabelpri as $key => $value ){
                              
                        ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4 location_name">
                                        <label><?=$arraylocation[$key]['location'];?></label>
                                </div>
                                <div class="col-4">
                                    <?=$arraylabelpri[$key];?> / หมุด :<?=$arrayslotpri[$key];?>
                                </div>
                                <?php
                                    if(isset($arraylabelsec[$key])){
                                ?>
                                <div class="col-4">
                                    <?=$arraylabelsec[$key];?> / หมุด :<?=$arrayslotsec[$key];?>
                                </div>
                                <?php
                                    }else{
                                      ?>
                                      <div class="col-4">
                                        <?=$_SESSION['memo'];?>
                                        <input type="hidden" name="memo" value="<?=$_SESSION['memo'];?>">
                                      </div>
                                      <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        </div>                          
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                              <a href="./Changehotel.php" class="btn btn-facebook">ย้อนกลับ</a>
  
                            

                            <button type="button" class="btn btn-facebook" id="nextblock1">ถัดไป</button>
                        </div>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
                <!--=========================== Block 2 ==================================-->
                                                    <div class="row" id="block2" <?php if($type_phone!='ipphone'){echo "style='display: none;'";}?>>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                            <center>
                                                                <h3>รายงานการซ่อมเบอร์โทรศัพท์หอพัก/โรงแรม</h3>
                                                            </center>
                                                            <br>
                                                            <label>
                                                              กรอกรายละเอียดการปฏิบัติงาน

                                                                <span class="star">*</span>
                                                            </label>

                                                            <textarea class="form-control" id="report" name="report"
                                                                rows="3"
                                                                placeholder=""></textarea>
                                                            </br>
                                                            <br>
                                                            <label>
                                                             ระบุประเภทความเสียหาย
                                                                <span class="star">*</span>
                                                            </label>

                                                            <br>
                                                            <?php
                                                                if($type_phone!='ipphone')
                                                                {
                                                             ?>
                                                            <select class="browser-default custom-select" name="type"
                                                                onchange="aaaa(this.value)">
                                                                <option value="ทั้งหมด">----------------------------------เลือก----------------------------------</option>
                                                                <option value="เสียจากผู้ใช้งาน">เสียจากผู้ใช้งาน</option>
                                                                <option value="อุปกรณ์เสียหาย">อุปกรณ์เสียหาย</option>
                                                                <option value="เสียหายจากชุมสายภายนอก">
                                                                เสียหายจากชุมสายภายนอก</option>
                                                                <option value="คู่สายเสียหาย">คู่สายเสียหาย</option>
                                                                <option value="เทอร์มินอลเสียหาย">เทอร์มินอลเสียหาย
                                                                </option>
                                                            </select>
                                                            <br>
                                                            </br>
                                                            <!--  -->
                                                            <div class="form-group" id="show" style='display: none;'>
                                                                <div class="form-group">
                                                                    <label style="color: red">
                                                                        เลือกจุดที่เทอร์มินอลเสีย         
                                                                        <span class="star">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-4  head_title">สถานที่</div>
                                                                        <div class="col-4  head_title">Terminal</div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-12">
                                                                            <?php
                                                            $count=0;
                                                            for($i=0;$i<count($arraylabelpri);$i++){
                                                                
                                                              ?>
                                                                              <div class="row">
                                                                                  <div class="col-4">
                                                                                      <div
                                                                                          class="custom-control custom-checkbox mb-3">
                                                                                          <input
                                                                                              class="custom-control-input"
                                                                                              id="customCheck<?=$count;?>"
                                                                                              type="checkbox"
                                                                                              name="Check[]"
                                                                                              value="<?=$count;?>"
                                                                                              onclick="checklocation(this.value)">
                                                                                        <?php
                                                                                        if($_SESSION['hotel_id']=='AB011'||$_SESSION['hotel_id']=='AB012'){
                                                                                        if($i!=count($arraylabelpri)-1)
                                                                                        {
                                                                                        ?>
                                                                                         <label
                                                                                              class="custom-control-label"
                                                                                              for="customCheck<?=$count;?>">
                                                                                         <?php
                                                                                        }
                                                                                        }
                                                                                        else{
                                                                                          ?>
                                                                                           <label
                                                                                              class="custom-control-label"
                                                                                              for="customCheck<?=$count;?>">
                                                                                         <?php
                                                                                        }
                                                                                         ?>     
                                                                                              <?=$arraylocation[$i]['location'];?></label>
                                                                                          <input type="hidden"
                                                                                              name="location[]"
                                                                                              value="<?=$arraylocation[$i]['location'];?>">
                                                                                          <input type="hidden"
                                                                                              name="eq_id[]"
                                                                                              value="<?=$arraylocation[$i]['eq_id'];?>">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-4">
                                                                                      <input type="hidden"
                                                                                          name="labelpri[]"
                                                                                          value="<?=$arraylabelpri[$i];?>">
                                                                                      <input type="hidden"
                                                                                          name="slotpri[]"
                                                                                          value="<?=$arrayslotpri[$i];?>">
                                                                                      <?=$arraylabelpri[$i];?>
                                                                                                                                                                                                                   หมุด:<?=$arrayslotpri[$i];?>
                                                                                  </div>
                                                                                  <?php
                                                                                      if(isset($arraylabelsec[$i])){
                                                                                  ?>
                                                                                  <div class="col-4">
                                                                                      <input type="hidden" name="labelsec[]" value="<?=$arraylabelsec[$i];?>">
                                                                                      <input type="hidden" name="slotsec[]" value="<?=$arrayslotsec[$i];?>">
                                                                                    
                                                                                  </div>
                                                                                  <?php
                                                                                      }
                                                                                      else{
                                                                                          ?>
                                                                                              <div class="col-3">
  
                                                                                              <input type="hidden" name="memo" value="<?=$_SESSION['memo'];?>">
                                                                                              </div>
                                                                                          <?php
                                                                                          }
                                                                                          ?>
                                                                              </div>
                                                                              <?php
                                                                          $count++;
                                                                              }
                                                                              
                                                                          ?>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <!--สิ้นสุดปุ่มเลือก-->
                                                              <?php
                                                                }
                                                                else{
                                                            ?>
                                                              <div class="row">
                                                                <div class="col-6">
                                                                    <label>อุปกรณ์เสียหาย</label>
                                                                    <input type="hidden" name="type" value="อุปกรณ์เสียหาย">
                                                                </div>
                                                            </div>
                                                            <?php
                                                                }
                                                            ?>
                                                            <div class="row">
                                                            <div class="col-12">
                                                            <span style="color: red">หากเทอร์มินอลที่หอพัก 37และหอพัก38 เสียจะไม่สามารถซ่อมได้เนื่องจากslotเต็มทุกช่อง ไม่สามารถเปลี่ยนไปใช้ช่องอื่นได้</span>
                                                            </div>
                                                            </div>
                                                            <br/>

                                                            <label>
                                                              ระบุวันที่ในการปฏิบัติงาน
                                                                <span class="star">*</span>
                                                            </label>
                                                            <input class="form-control" type="text" name="date" value="<?php
                                                        date_default_timezone_set('asia/bangkok');
                                                        echo date('m/d/yy');
                                                        ?>" id="startdate" autocomplete="off" />
                                                            <br>
                                                            <div class="row justify-content-center">
                                                                <div class="col-6 text-content">

                                                                    <label><b>ลงชื่อผู้ปฏิบัติงาน :</b></labal>
                                                                        <span><?php echo $employee;?></span>
                                                                            <input type="hidden" name="username"
                                                                                value="<?php echo $_SESSION['username'];?>">
                                                                            <input type="hidden" name="tel"
                                                                                value="<?php echo $_SESSION['tel'];?>">
                                                                            <input type="hidden" name="emp_id"
                                                                                value="<?php echo $_SESSION['emp_id'];?>">


                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row justify-content-center">
                                                    <button type="button" class="btn btn-facebook"
                                                        id="blackblock1">ย้อนกลับ</button>
                                                        <button type="button" class="btn btn-facebook" id="nextblock3">ถัดไป</button>

                                                      </div>
                                            </div>
                                        </div>
                                    </div>
                            <!--=========================== สิ้นสุด Block 3 ==================================-->
                                    <form action="#" method="post" id="frm_conclusion">
                                    <div class="row" id="block3" style="display: none;">
                                        <div class="col-12">
                                            <div class="form-group">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                <div id="repairtel"></div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                     </div>
                                     </form>
							<!--=========================== สิ้นสุด Block 3 ==================================-->
                                    <form action="#" method="post" id="showdata">
                                    <div class="row" id="block4" >
                                        <div class="col-12">
                                            <div class="form-group">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                <div id="showcheck1"></div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                     </div>
                                     </form>
                           <!--=========================== สิ้นสุด Block 4 ==================================-->
                                    <form action="#" method="post" id="show">
                                    <div class="row" id="block5" >
                                        <div class="col-12">
                                            <div class="form-group">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                <div id="conclusion"></div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                     </div>
                                   </form>
                                         <!--=========================== สิ้นสุด Block 5 ==================================-->
                                   <form action="#" method="post" id="">
                                    <div class="row" id="block6" >
                                        <div class="col-12">
                                            <div class="form-group">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                <div id="updatnew"></div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                     </div>
                                     </form>
                              
                             <!--========================== end =========================================-->
                             </form> <!--========================== สิ้นสุดfromใหญ่ =========================================-->
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
   <!--================================ modal ==================================-->
<?php
include_once 'modal.php';
?>
<!--================================ modal ==================================-->   
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
            <script src="./assets/vendor/popper/popper.min.js"></script>
            <script src="./assets/vendor/bootstrap/bootstrap.min.js"></script>
            <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
            <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
            <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
            <script src="assets/js/core/bootstrap-material-design.min.js"></script>
            <!--validate-->
            <!-- Theme JS -->
            <script src="./assets/js/argon.min.js"></script>
            <!-- date Datepicker -->
            <script type="text/javascript" src="./assets/datetimepicker/jquery.datetimepicker.js"></script>

    <script type="text/javascript">
      jQuery('#startdate').datetimepicker({
                    timepicker: false,
                    format: 'm/d/Y'
                });
        $("#nextblock1").click(function () {
        $("#block1").hide();
        $("#block2").show();
        });
        $("#blackblock1").click(function () {
        $("#block1").show();
        $("#block2").hide();
        });
		
		 aaaa = type => {
          if (type == "เทอร์มินอลเสียหาย") {
         $("#show").show();
         $("#nextblock3").attr("onclick","test1();");
         }
         else {
         $("#show").hide();
         $("#nextblock3").attr("onclick","test2();");
         }
         }
		 
		 test1=()=>{
         $.ajax({
         type: "POST",
         url: "ajaxrepair_hotel.php",
         data: $("#chechblock1").serialize(),
         success: function(result) {
         $("#block2").hide();
         $("#block3").show();
         $("#repairtel").html(result);
          //alert( $("#chechblock1").serialize());
          }
                });   
                }
         test2=()=>{
		  if(confirm('คุณต้องการบันทึกข้อมูลใช่หรือไม่')==true)
		  {
          $.ajax({
         type: "POST",
         url: "updatereport_repair_hotel.php",
         data: $("#"+'chechblock1').serialize(),
         success: function(result) {
         $("#updatnew").html(result);
         }
         });
		  }
         }

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

      showfloor = b_eq_id => {
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
        $("#" + showid).text(label+"/หมุด:"+slot);
        $("#" + showfirstid).text(label+"/หมุด:"+slot);
        $("#" + slotid).attr("value", slot);
        $("#" + labelid).attr("value", label);
        $("." + slotid).attr("value", slot);
        $("." + labelid).attr("value", label);
        //alert(slotid);
        if(status=='stop'){
          $.ajax({
          type: "POST",
          url: "ajaxsearchkc.php",
          data: "label=" + label + 
                "&slot=" + slot+
                "&type=repair",
          success: function(result) {
            $("#showkc").html(result);
          }
        });
        }



      };
     
      
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

      selectprimaryterminal = (slot,label,tel)=>{
        $.ajax({
          type: "POST",
          url: "ajaxcheck1.php",
          data: "slot=" + slot + "&label=" + label+ "&tel=" + tel,
          success: function(result) {
            $("#showcheck1").html(result);
            $("#block3").hide();
            $("#block4").show();
          }
        });
      }

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

        conclusion = (page, fromid,from) => {
        $.ajax({
          type: "POST",
          url: "ajaxconclusion_repair_hotel.php",
          data: $("#"+fromid).serialize()+"&"+$("#"+from).serialize()+"&page=" + page + "&fromid=" + fromid,
          success: function(result) {
            $("#conclusion").html(result);
            $("#block"+page).hide();
            $("#block5").show();

          }
        });
      };

      updatnew = (page, fromid,from) => {
 		  if(confirm('คุณต้องการบันทึกข้อมูลใช่หรือไม่')==true)
		{
        $.ajax({
          type: "POST",
          url: "updatereport_repair_hotel.php",
          data: $("#"+fromid).serialize()+ $("#"+from).serialize(),
          success: function(result) {
            $("#updatnew").html(result);
            $("#block6").show();
           // alert($("#"+fromid).serialize());
          }
        });
		}
		
      };
    </script>
</body>

</html>
