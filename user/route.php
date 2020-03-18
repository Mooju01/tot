<?php
include_once "../connect.php";

session_start();
include './check_status_login.php';
$arraylocation=array();
$arraylabelpri=array();
$arraylabelsec=array();
$arrayslotpri=array();
$arrayslotsec=array();
$_SESSION['emp_id']=$_GET['emp_id'];
$_SESSION['tel']=$_GET['tel'];
$_SESSION['route']=$_GET['route'];
$type_phone=$_GET['type_phone'];
$_SESSION['type']='emp';

//search emp info
$sql=$mysqli->query("SELECT * 
                    FROM employee
                    WHERE emp_id='".$_SESSION['emp_id']."'");
$result=$sql->num_rows;
$emp_info=array();
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($emp_info,$row);
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
       $kcmap=array('eq_id'=>$value['eq_id']);
      $kcmap1= array_pop($kcmap);
      array_push($arraylocation,$addlocation);
      array_push($arraylabelpri,$value['label']);
      array_push($arrayslotpri,$value['slot']);
    }else{
      array_push($arraylabelsec,$value['label']);
      array_push($arrayslotsec,$value['slot']);
    }

    if($value['type']=='tt'){
        $_SESSION['mimo']=$value['memo'];
    }

                              
}

$kc=$mysqli->query("SELECT * FROM kc_pic where eq_id = '$kcmap1'");
while($row = $kc->fetch_assoc())
{
    $pic = $row['pic'];

    
}

$sql=$mysqli->query("SELECT * FROM employee where emp_id = '".$_SESSION['username']."'");
while($row = $sql->fetch_assoc())
{
    $employee = $row['emp_name'];
}


$count=0;
$page='Mendtel';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        ซ่อมเบอร์โทรศัพท์
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
                                    <h4 class="card-title">ซ่อมเบอร์โทรศัพท์</h4>
                                </div>
                                <form action="" name="form1"  id ="chechblock1"
                                                            enctype="multipart/form-data">
                                <div class="card-body">
                                    <!--============================show emp info====================================-->
                                    <?php
                                        foreach($emp_info as $row){
                                        ?>
                                                        <div class="col-12">
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <h3>ข้อมูลพนักงาน</h3>
                                    </div>
                                            <div class="row">
                                                <div class="col-3">
                                                </div>
                                                <div class="col-4">
                                                    <labal>ชื่อสกุล :</labal>
                                                    <?php echo $row["emp_name"];?>
                                                </div>
                                                <div class="col-5">
                                                    <labal>สถานที่นั่ง :</labal>
                                                    <?php echo $row["location"];?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                </div>
                                                <div class="col-4">
                                                    <labal>เบอร์โทร :</labal>
                                                    <?php echo $_SESSION['tel'];?>
                                                </div>
                                                
                                            </div>
                                </div>
                            </div>
                                        <!-- <div class="col-2">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal-default">แผนผัง KC</button>
                                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                                aria-labelledby="modal-default" aria-hidden="true">
                                                <div class="modal-dialog modal- modal-dialog-centered modal-lg"
                                                    role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="modal-title-default">แผนผัง KC
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <img src='../pic/<?php echo$pic;?>' width='100%' border='1'>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-link  ml-auto"
                                                                data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <?php
                            }
                            ?>
                                    <!--============================show emp info end====================================-->
                                    <hr>
                                    <!--=========================== Block 1 ==================================-->
                                    <?php
                            if($type_phone=='normal_tel')
                            {
                            ?>
                                    <div class="row" id="block1">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="row justify-content-center">
                                                    <div class="col-12">
                                                    <div class="row justify-content-center">
                                                            <h3>เส้นทาง</h3>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4 head_title">
                                                                <div class="custom-control">
                                                                    <label>สถานที่</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4  head_title">
                                                                <label>Primary</label>
                                                            </div>
                                                            <div class="col-3  head_title">
                                                                <label>secelnary</label>
                                                            </div>
                                                        </div>
                                                        <?php
                                        
                                                    foreach($arraylabelpri as $key => $value ){
                              
                                                    ?>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="custom-control ">
                                                                    <label><?=$arraylocation[$key]['location'];?></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <?=$arraylabelpri[$key];?>
                                                                หมุด:<?=$arrayslotpri[$key];?>
                                                            </div>
                                                            <?php
                                                        if(isset($arraylabelsec[$key])){
                                                        ?>
                                                            <div class="col-3">
                                                                <?=$arraylabelsec[$key];?>
                                                                หมุด:<?=$arrayslotsec[$key];?>
                                                            </div>
                                                            <?php
                                                         }
                                                         else{
                                                        ?>
                                                            <div class="col-3">
                                                            <?php echo $_SESSION['mimo'];?>
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
                                            <div class="form-group">
                                                <div class="row justify-content-center">
                                                    <!--------------------------------------- Button trigger modal --------------------------------->
                                                    <a href="Mendtel.php" class="btn btn-facebook">ย้อนกลับ</a>
                                                    <button type="button" class="btn btn-facebook"
                                                        id="nextblock1">รายงาน</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=========================== สิ้นสุด block 1 ==================================-->
                                    <?php
                            }
                            ?>
                                    <!--=========================== Block 2 ==================================-->
                                    <div class="row" id="block2"
                                        <?php if($type_phone!='ipphone'){echo "style='display: none;'";}?>>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="row justify-content-center">
                                                    <div class="col-8">
                                                            <center>
                                                                <h3>รายงานการซ่อมเบอร์โทรศัพท์</h3>
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
                                                                foreach($arraylabelpri as $key => $value ){
                                                                
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
                                                                                        <label
                                                                                            class="custom-control-label"
                                                                                            for="customCheck<?=$count;?>"><?=$arraylocation[$key]['location'];?></label>
                                                                                        <input type="hidden"
                                                                                            name="location[]"
                                                                                            value="<?=$arraylocation[$key]['location'];?>">
                                                                                        <input type="hidden"
                                                                                            name="eq_id[]"
                                                                                            value="<?=$arraylocation[$key]['eq_id'];?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <input type="hidden"
                                                                                        name="labelpri[]"
                                                                                        value="<?=$arraylabelpri[$key];?>">
                                                                                    <input type="hidden"
                                                                                        name="slotpri[]"
                                                                                        value="<?=$arrayslotpri[$key];?>">
                                                                                    <?=$arraylabelpri[$key];?>
                                                                                    หมุด:<?=$arrayslotpri[$key];?>
                                                                                </div>
                                                                                <?php
                                                                                    if(isset($arraylabelsec[$key])){
                                                                                ?>
                                                                                <div class="col-4">
                                                                                    <input type="hidden" name="labelsec[]" value="<?=$arraylabelsec[$key];?>">
                                                                                    <input type="hidden" name="slotsec[]" value="<?=$arrayslotsec[$key];?>">
                                                                                  
                                                                                </div>
                                                                                <?php
                                                                                    }
                                                                                    else{
                                                                                        ?>
                                                                                            <div class="col-3">
                                                                                            
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--สิ้นสุดปุ่มเลือก-->
                                                            <?php
                                                    }
                                                    else
                                                    {
                                                    ?> <div class="row">
                                                               <div class="col-6">
                                                                <label>อุปกรณ์เสียหาย</label>
                                                                <input type="hidden" name="type" value="อุปกรณ์เสียหาย">
                                                                </div>
                                                            </div>
                                                            <?php
                                                    }
                                                    ?>
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
                                                                        <label><?php echo $employee;?></labal>
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
                                                        <?php
                                                        if($type_phone!='ipphone')
                                                        {
                                                         ?>
                                                        <button type="button" class="btn btn-facebook" id="nextblock3">ถัดไป</button>
                                                         <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <button type="button" class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกข้อมูลใช้หรือไม่?')+ipphone();">บันทึก</button>    
                                                        <?php
                                                        }
                                                        ?>
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
                                    <!--=========================== สิ้นสุด Block 6 ==================================-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </main>
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
            <!--<div class="testshow"></div>-->

            <!-- Core -->
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
                $("#nextblock1").click(function () {
                    $("#block1").hide();
                    $("#block2").show();
                });

                $("#blackblock1").click(function () {
                    $("#block1").show();
                    $("#block2").hide();
                });


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


        conclusion = (page, fromid,from) => {

        $.ajax({
          type: "POST",
          url: "ajaxconclusion.php",
          data: $("#"+fromid).serialize()+"&"+$("#"+from).serialize()+"&page=" + page + "&fromid=" + fromid,
          success: function(result) {
            $("#conclusion").html(result);
            $("#block"+page).hide();
            $("#block5").show();

          }
        });
      };
      
      ipphone=() => {
		if(confirm('คุณต้องการบันทึกข้อมูลใช่หรือไม่')==true)
		{
        $.ajax({
          type: "POST",
          url: "updatereport.php",
          data: $("#"+'chechblock1').serialize(),
          success: function(result) {
            $("#updatnew").html(result);
           // alert($("#"+fromid).serialize());
          }
        });
	  }
      };



      updatnew = (page, fromid,from) => {
		  if(confirm('คุณต้องการบันทึกข้อมูลใช่หรือไม่')==true)
		{ 
        $.ajax({
          type: "POST",
          url: "updatereport.php",
          data: $("#"+fromid).serialize()+$("#"+from).serialize(),
          success: function(result) {
            $("#updatnew").html(result);
            $("#block6").show();
           // alert($("#"+fromid).serialize());
          }
        });
		}
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


                jQuery('#startdate').datetimepicker({
                    timepicker: false,
                    format: 'm/d/Y'
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
                    url: "ajaxrepair.php",
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
                        url: "updatereport.php",
                        data: $("#"+'chechblock1').serialize(),
                        success: function(result) {
                            $("#updatnew").html(result);
                            }
                            });
                     } 
                }

                function check_null() {
                    var user = $("#report").val();
                    var pass = $("#startdate").val();
                    if (user == '') {
                        alert("กรุณากรอก รายละเอียการซ่อมด้วย ด้วยค่ะ !");
                        $("#report").focus();
                        return false;
                    } else if (startdate == '') {
                        alert("กรุณากรอกวันที่การซ่อมด้วยค่ะ !");
                        $("#startdate").focus();
                        return false;
                    }
                }

            </script>
</body>

</html>