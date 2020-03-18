      <div class="sidebar" data-background-color="white"data-image="assets/img/sidebar-1.jpg">
        <div class="logo">
          <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/index.php'":"href='./index.php'"; ?> class="simple-text logo-normal">
            ระบบข่ายสายโทรศัพท์ TOT
          </a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
          <li class="nav-item <?php echo ($page==='indexuser')?'active':NULL;?>">
              <a class="nav-link" <?php echo ($_SESSION['user_status']=='3')?"href='../user/index.php'":"href='./index.php'"; ?>>
              <i class="fa fa-home" aria-hidden="true"></i>
                <p>หน้าแรก</p>
              </a>
            </li>
            <?php
            if($_SESSION['user_status']=='3'){
            ?>
            <li class="nav-item <?php if($page==='manage'){ echo 'active';}?>">
              <a class="nav-link" href="../admin/manage.php">
              <i class="fa fa-users"></i>
                <p>จัดการสมาชิก</p>
              </a>
            </li>
            <?php 
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#nav_search_tel" aria-expended="true">
              <i class="fa fa-search" aria-hidden="true"></i>
                <p>ค้นหาเบอร์โทรศัพท์ <b class="caret"></b></p>
              </a>
              <div class="collapse in" id="nav_search_tel" aria-expended="true">
                <ul class="nav">
                  <li class="nav-item <?php echo $page=='searchtel'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/SearchTel.php'":"href='./SearchTel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                      <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ค้นหาเบอร์โทรศัพท์พนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='searchtelhotel'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/SearchTel_hotel.php'":"href='./SearchTel_hotel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ค้นหาเบอร์โทรศัพท์หอพัก/โรงแรม</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='searchtelprivate'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/SearchTel_private.php'":"href='./SearchTel_private.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ค้นหาเบอร์ประจำชั้น</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item <?php echo ($page==='structure')?'active':NULL;?>">
              <a class="nav-link" <?php echo ($_SESSION['user_status']=='3')?"href='../user/structure.php'":"href='./structure.php'"; ?>>
              <i class="fa fa-users" aria-hidden="true"></i>
                <p>โครงสร้างส่วนงาน</p>
              </a>
            </li>
            <?php
            if($_SESSION['user_status']=='3'){
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#nav_manage_emp" aria-expended="true">
              <i class="fa fa-address-card-o" aria-hidden="true"></i>
                <p>จัดการข้อมูลพนักงาน <b class="caret"></b></p>
              </a>
              <div class="collapse in" id="nav_manage_emp" aria-expended="true">
                <ul class="nav">
                  <li class="nav-item <?php echo $page=='addemp'?'active':NULL;?>">
                    <a href="../admin/addemp.php" class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                      <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">เพิ่มพนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='edit_emp_info'?'active':NULL;?>">
                    <a class="nav-link" href="../admin/edit_emp_info.php">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">แก้ไขข้อมูลพนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='delete_emp'?'active':NULL;?>">
                    <a class="nav-link" href="../admin/delete_emp.php">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ลบข้อมูลพนักงาน</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <?php
            }
            ?>
            <li class="nav-item <?php echo ($page==='addroom')?'active':NULL;?>">
              <a class="nav-link" <?php echo ($_SESSION['user_status']=='3')?"href='../user/add_private_room.php'":"href='./add_private_room.php'"; ?>>
              <i class="fa fa-university" aria-hidden="true"></i>
                <p>เพิ่มห้อง</p>
              </a>
            </li>
            <li class="nav-item <?php echo ($page==='show')?'active':NULL;?>">
              <a class="nav-link" <?php echo ($_SESSION['user_status']=='3')?"href='../user/src_terminal.php'":"href='./src_terminal.php'"; ?>>
              <i class="fa fa-table" aria-hidden="true"></i>
                <p>show terminal</p>
              </a>
            </li>
            <?php
            if($_SESSION['user_status']=='3'){
            ?>
            <li class="nav-item <?php echo ($page==='edit')?'active':NULL;?>">
              <a class="nav-link" <?php echo ($_SESSION['user_status']=='3')?"href='../user/edit_teminal.php'":"href='./edit_teminal.php'"; ?>>
              <i class="fa fa-pencil" aria-hidden="true"></i>
                <p>edit terminal</p>
              </a>
            </li>
            <?php 
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#add" aria-expended="true">
              <i class="fa fa-plus-circle" aria-hidden="true"></i>
                <p>เพิ่ม/พ่วง เบอร์โทร <b class="caret"></b></p>
              </a>
              <div class="collapse in" id="add" aria-expended="true">
                <ul class="nav">
                  <li class="nav-item <?php echo $page=='addtel_emp'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/AddTel.php'":"href='./AddTel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">เพิ่มเบอร์พนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='addtel_hotel'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/AddTel_hotel.php'":"href='./AddTel_hotel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">เพิ่มเบอร์หอพัก/โรงแรม</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='addtel_private'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/AddTel_private.php'":"href='./AddTel_private.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">เพิ่มเบอร์ประจำชั้น</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <!-- <li class="nav-item ">
              <a data-toggle="collapse" href="#Components" class="nav-link" aria-expanded="true">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                <p>เพิ่ม/พ่วง เบอร์โทร <b class="caret"></b></p>
              </a>
              <div class="collapse in" id="Components" aria-expanded="true">
                <ul class="nav">
             
                <li class="nav-item <?php echo ($page==='addtel_emp')?'active':NULL;?>">
                  <a class="nav-link" href="./AddTel.php">
                    <span class="sidebar-mini" style="font-weight:bold;">></span>
                    <span class="sidebar-normal">เพิ่มเบอร์พนักงาน</span>
                  </a>
                </li>
                <li class="nav-item <?php echo ($page==='addtel_hotel')?'active':NULL;?>">
                  <a href="./AddTel_hotel.php" class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;">></span>
                    <span class="sidebar-normal">เพิ่มเบอร์หอพัก/โรงแรม</span>
                  </a>
                </li>
                <li class="nav-item <?php echo ($page==='addtel_private')?'active':NULL;?>">
                  <a href="./AddTel_private.php" class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;">></span>
                    <span class="sidebar-normal">เพิ่มเบอร์ประจำชั้น</span>
                  </a>
                </li>
                </ul>
              </div>
            </li> -->
            <li class="nav-item <?php echo ($page==='move')?'active':NULL;?>">
              <a class="nav-link" <?php echo ($_SESSION['user_status']=='3')?"href='../user/MoveTel.php'":"href='./MoveTel.php'"; ?>>
              <i class="fa fa-random" aria-hidden="true"></i>
                <p>ย้ายเบอร์</p>
              </a>
            </li>
            <li class="nav-item <?php echo ($page==='change')?'active':NULL;?>">
              <a class="nav-link" href="#change" data-toggle="collapse" aria-expended="true">
              <i class="fa fa-exchange" aria-hidden="true"></i>
                <p>เปลี่ยนเบอร์โทรศัพท์ <b class="caret"></b></p>
              </a>
              <div class="collapse in" id="change" aria-expended="true">
                <ul class="nav">
                  <li class="nav-item <?php echo $page=='changeemp'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/ChangeTel.php'":"href='./ChangeTel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">เปลี่ยนเบอร์พนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='changehotel'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/ChangeTel_hotel.php'":"href='./ChangeTel_hotel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    <span class="sidebar-normal">เปลี่ยนเบอร์หอพัก/โรงแรม</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='changeprivate'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/ChangeTel_private.php'":"href='./ChangeTel_private.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    <span class="sidebar-normal">เปลี่ยนเบอร์ประจำชั้น</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#delete" aria-expended="true">
              <i class="fa fa-trash" aria-hidden="true"></i>
                <p>ลบเบอร์โทรศัพท์ <b class="caret"></b></p>
              </a>
              <div class="collapse in" id="delete" aria-expended="true">
                <ul class="nav">
                  <li class="nav-item <?php echo $page=='deleteemp'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/DeleteTel.php'":"href='./DeleteTel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ลบเบอร์พนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='deletehotel'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/DeleteTel_hotel.php'":"href='./DeleteTel_hotel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ลบเบอร์หอพัก/โรงแรม</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='deleteprivate'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/DeleteTel_private.php'":"href='./DeleteTel_private.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ลบเบอร์ประจำชั้น</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#repair" aria-expended="true">
              <i class="fa fa-wrench" aria-hidden="true"></i>
                <p>ซ่อมเบอร์โทรศัพท์ <b class="caret"></b></p>
              </a>
              <div class="collapse in" id="repair" aria-expended="true">
                <ul class="nav">
                  <li class="nav-item <?php echo $page=='Mendtel'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/Mendtel.php'":"href='./Mendtel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ซ่อมเบอร์โทรศัพท์พนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='MendHotel'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/Changehotel.php'":"href='./Changehotel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ซ่อมเบอร์โทรศัพท์หอพัก</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#report" aria-expended="true">
              <i class="fa fa-file-text-o" aria-hidden="true"></i>
                <p>รายงานการซ่อม <b class="caret"></b></p>
              </a>
              <div class="collapse in" id="report" aria-expended="true">
                <ul class="nav">
                  <li class="nav-item <?php echo $page=='report'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/showreport.php'":"href='./showreport.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">รายงานซ่อมเบอร์พนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='report_hotel'?'active':NULL;?>">
                    <a <?php echo ($_SESSION['user_status']=='3')?"href='../user/showdata_hotel.php'":"href='./showdata_hotel.php'"; ?> class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">รายงานซ่อมเบอร์หอพัก</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <?php
            if($_SESSION['user_status']=='3'){
            ?>
            <li class="nav-item <?php if($page==='report_all'){ echo 'active';}?>">
              <a class="nav-link" href="../admin/report.php">
              <i class="fa fa-file-text-o" aria-hidden="true"></i>
                <p>รายงาน</p>
              </a>
            </li>
            <?php
            }
            ?>
            
                  <!-- <li class="nav-item <?php if($page==='Mendtel'){ echo 'active';}?>">
                    <a class="nav-link" href="./Mendtel.php">
                    <i class="fa fa-history"></i>
                      <p>ซ่อมเบอร์โทรศัพท์พนักงาน</p>
                    </a>
                  </li>
				          <li class="nav-item <?php if($page==='MendHotel'){ echo 'active';}?>">
                    <a class="nav-link" href="./Changehotel.php">
                    <i class="fa fa-history"></i>
                      <p>ซ่อมเบอร์โทรศัพท์หอพัก</p>
                    </a>
                  </li> -->
                  <!-- <li class="nav-item <?php if($page==='report'){ echo 'active';}?>">
                    <a class="nav-link" href="showreport.php">
                    <i class="material-icons">content_paste</i>
                      <p>รายงานซ่อมเบอร์พนักงาน</p>
                    </a>
                  </li>
				          <li class="nav-item <?php if($page==='report_hotel'){ echo 'active';}?>">
                    <a class="nav-link" href="./showdata_hotel.php">
                    <i class="material-icons">content_paste</i>
                      <p>รายงานซ่อมเบอร์หอพัก</p>
                    </a>
                  </li> -->
          </ul>
        </div>
      </div>