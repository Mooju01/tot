
<?php include("connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="assets/img/apple-icon.png"
    />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      ค้าหาเบอร์
    </title>
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
      name="viewport"
    />
    <!-----------------------Fonts and icons ------------------------------->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
      rel="stylesheet"
    />
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet" />
    <link
      href="./assets/vendor/font-awesome/css/font-awesome.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
    />
    <link rel="stylesheet" href="./assets/vendor/font-awesome/css/font-awesome.css">
   <!----------------------------- Theme CSS --------------------------------->
 <link type="text/css" href="./assets/css/argon.min.css" rel="stylesheet" />
   <!----------------------------- CSS Files ---------------------------------->
   <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project ---------->
    <link href="assets/demo/demo.css" rel="stylesheet" />
    <!------------------------------style custom------------------------------->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
    <script type="text/javascript"></script>
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/bootstrap/bootstrap.min.js"></script>
    <!---------------------------- pagination table ---------------------------->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" ></script>  
  </head>

<body class="">
    <div class="wrapper ">
      <!--sidenav-->
      <?php
      include "header.php";
      ?>
      <!--sidenav-->
      <div class="main-panel">
        <!-- Navbar -->
        <?php
        include "navbar.php"
        ?>     
        <!-- End Navbar -->
        <div class="content">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">ค้นหาเบอร์</h4>
                    <!--<p class="card-category">Complete your profile</p>-->
                  </div>
                  <div class="card-body"> 
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                          <div class="row" id="block1">
                    <div class="col-10">
                      <div class="form-group">
                        <div class="row justify-content-center">
                          <div class="row">
                            <table id="example" class="table table-striped table-bordered" style="width:120%">
                              <thead>
                                    <tr>
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>อีเมลล์</th>
                                    <th>ส่วนงานที่สังกัด</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    </tr>
                                </thead>   
                                <tbody>
                                <?php 
                                $sql=$mysqli->query("SELECT * FROM employee e left join center on e.center_id = center.center_id ORDER BY tel  ASC");
                                while($row = $sql->fetch_assoc())
                                {
                                ?>
                                <tr>
                                  <td><?php echo $row["emp_id"]; ?></a></td>
                                  <td><?php echo $row["emp_name"]; ?></td>
                                  <td><?php echo $row["emp_email"]; ?></td>
                                  <td><?php echo $row["div_code"]; ?></td>
                                  <td><?php echo $row["tel"]; ?></td> 
                                  </tr>
                                <?php } ?>
                                </tbody>
                               
                              </table>
                            </div>
                         <div class="modal fade" id="addbookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                         <div class="modal-dialog" id="addbook_dialog_modal" role="document"></div>
                         </div>
                        </div>
                   
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  </body>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    } );  
   </script>

</html>
