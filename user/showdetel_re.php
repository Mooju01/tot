<?php
include_once "../connect.php";
session_start();
include './check_status_login.php';
$arraylocation=array();
$arraylabelpri=array();
$arraylabelsec=array();
$arrayslotpri=array();
$arrayslotsec=array();
$reh_hotel_no=$_GET['reh_hotel_no'];
$tel=$_GET['tel'];
$reh_id=$_GET['reh_id'];
$reh_building=$_GET['reh_building'];
$reh_emp=$_GET['reh_emp'];
//search emp infoe
$sql=$mysqli->query("SELECT * 
                    FROM employee
                    WHERE emp_id='$emp_id'");
$result=$sql->num_rows;
$emp_info=array();
for($i=0;$i<$result;$i++){
  $row=$sql->fetch_assoc();
  array_push($emp_info,$row);
}


$routtel=$mysqli->query("SELECT * FROM `hotel_tel` where hotel_no ='$reh_hotel_no' AND tel='$tel'");
while($row = $routtel->fetch_assoc())
{
    $rout = $row['route'];
}

//search tel map
$sql=$mysqli->query("SELECT route_tel.eq_id,route_tel.label,route_tel.type,route_tel.slot,equipment.location,route_tel.memo
FROM route_tel
INNER JOIN equipment
ON route_tel.eq_id=equipment.eq_id
WHERE route_tel.route='$rout' AND route_tel.tel='$tel'");
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
    }else{
      array_push($arraylabelsec,$value['label']);
      array_push($arrayslotsec,$value['slot']);
    }

                              
} $sql=$mysqli->query("SELECT * FROM employee where emp_id = '$reh_emp'");
while($row = $sql->fetch_assoc())
{
    $employee = $row['emp_name'];
}


$count=0;
$page='repair_hotel';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  รายงานซ่อมเบอร์หอพัก/โรงแรม
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
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">รายงานการซ่อมเบอร์โทรศัพท์</h4>
                        </div>
                        <div class="card-body">
                            <!--============================show emp info====================================-->
                            <div class="row">
                                <div class="col-12">
                                    <div class ="row justify-content-center">
                                    <h3>ข้อมูลหอ/โรงแรม</h3>
                                    </div>
                                    <div class="row">
                                    <div class="col-3">
                                    </div>
                                            <div class="col-4">
                                                <labal>ชื่ออาคาร :</labal>
                                                <?php echo $reh_building;?>
                                            </div>
                                            <div class="col-5">
                                                <labal>ห้อง :</labal>
                                                <?php echo $reh_hotel_no;?>
                                            </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-3">
                                    </div>
                                            <div class="col-4">
                                                <labal>เบอร์โทร :</labal>
                                                <?php echo $tel;?>
                                            </div>
                                            <div class="col-4">
                                            </div>
                                    </div>
                                </div>
                               <!-- <div class="col-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-default">แผนที่</button>
                                    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                                        aria-labelledby="modal-default" aria-hidden="true">
                                        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-default">Type your modal
                                                        title</h6>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <p>Far far away, behind the word mountains, far from the countries
                                                        Vokalia and Consonantia, there live the blind texts. Separated
                                                        they live in Bookmarksgrove right at the coast of the Semantics,
                                                        a large language ocean.</p>
                                                    <p>A small river named Duden flows by their place and supplies it
                                                        with the necessary regelialia. It is a paradisematic country, in
                                                        which roasted parts of sentences fly into your mouth.</p>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link  ml-auto"
                                                        data-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                            <?php
                            $sql=$mysqli->query("SELECT * 
                            FROM hotel_tel
                            WHERE tel='$tel' AND hotel_no ='$reh_hotel_no'");
                            while($row = $sql->fetch_assoc())
                            {
                            $type_phone= $row['type_phone']; 
                            }
                            ?>                            
                            <!--============================show emp info end====================================-->
                            <?php
                            if($type_phone=='normal_tel'){
                            ?>
                            <hr>
                            <?php
                            }
                            ?>
                            <!--=========================== Block 1 ==================================-->
                            <div class="row" id="block1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                              <?php
                                              if($type_phone=='normal_tel')
                                              {
                                              ?>
                                              <div class="row justify-content-center">
                                                <h3>เส้นทาง</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 head_title">
                                                        <div class="custom-control">
                                                            <label>สถานที่</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 head_title">
                                                        <label>Primary</label>
                                                    </div>
                                                    <div class="col-3 head_title">
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
                                                        <?=$arraylabelpri[$key];?> หมุด:<?=$arrayslotpri[$key];?>
                                                    </div>
                                                    <?php
                                                        if(isset($arraylabelsec[$key])){
                                                        ?>
                                                    <div class="col-3">
                                                        <?=$arraylabelsec[$key];?> หมุด:<?=$arrayslotsec[$key];?>
                                                    </div>
                                                    <?php
                                                         }
                                                        ?>
                                                </div>
                                                <?php
                                                         $count++;
                                                    }
                                                }
                                                    ?>


                                                    <hr>
                                                    <?php
                                                    $sql=$mysqli->query("SELECT * 
                                                                        FROM report_hotel
                                                                        WHERE reh_id='$reh_id'");
                                                     while($row = $sql->fetch_assoc())
                                                     {
                                                    ?>
                                                    <div class ="row justify-content-center">
                                                    <h3>รายละเอียดการซ่อม</h3>
                                                    </div>
                                                    <div class ="row">
                                                        <div class= "col-4">
                                                         <label>ประเภทการเสีย :</label>  
                                                         <label><?php echo $row['reh_type']?></label>  
                                                        </div>
                                                    </div>
                                                    <div class ="row">
                                                        <div class= "col-4">
                                                         <label>วันที่ซ่อม :</label>  
                                                         <label><?php echo $row['reh_date']?></label>  
                                                        </div>
                                                    </div>
                                                    <div class ="row">
                                                        <div class= "col-4">
                                                         <label>รายละเอียด :</label>  
                                                         <label><?php echo $row['reh_data']?></label>  
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $Worker=$row['emp_id'];
                                                    }
                                                    ?>
                                                    <?php
                                                    $sql=$mysqli->query("SELECT * 
                                                                        FROM employee
                                                                        WHERE emp_id='$reh_emp'");
                                                     while($row = $sql->fetch_assoc())
                                                     {
                                                    ?>

                                                    <div class ="row">
                                                        <div class= "col-12">
                                                         <label>ผู้ปฎิบัติงาน :</label>  
                                                         <label><?php echo $row['emp_name']?></label>  
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
                                            <!--------------------------------------- Button trigger modal --------------------------------->
                                            <a href="showdata_hotel2.php?Start_date=<?php echo$_SESSION['Start_date']?>&End_date=<?php echo $_SESSION['End_date']?>&type=<?=$_SESSION['type'];?>" class="btn btn-facebook">ย้อนกลับ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--=========================== สิ้นสุด bok1 ==================================-->
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
    <!--<div class="testshow"></div>-->
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
        
    <!-- Core -->
    <script src="./assets/vendor/jquery/jquery-3.4.1.js"></script>
    <script src="./assets/vendor/popper/popper.min.js"></script>
    <script src="./assets/vendor/bootstrap/bootstrap.min.js"></script>
    <!--validate-->
    <!-- Theme JS -->
    <script src="./assets/js/argon.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
      <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
      <script src="assets/js/core/bootstrap-material-design.min.js"></script>
</body>

</html>