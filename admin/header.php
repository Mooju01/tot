      <div class="sidebar" data-background-color="white"data-image="assets/img/sidebar-1.jpg">
        <div class="logo">
          <a href="index.php" class="simple-text logo-normal">
          ระบบข่ายสายโทรศัพท์ TOT
          </a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
          <li class="nav-item <?php if($page==='indexadmin'){ echo 'active';}?>">
              <a class="nav-link" href="index.php">
              <i class="fa fa-home" aria-hidden="true"></i>
                <p>หน้าแรก</p>
              </a>
            </li>
            <li class="nav-item <?php if($page==='manage'){ echo 'active';}?>">
              <a class="nav-link" href="manage.php">
              <i class="fa fa-users"></i>
                <p>จัดการสมาชิก</p>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#nav_manage_emp" aria-expended="true">
              <i class="fa fa-address-card-o" aria-hidden="true"></i>
                <p>จัดการข้อมูลพนักงาน <b class="caret"></b></p>
              </a>
              <div class="collapse in" id="nav_manage_emp" aria-expended="true">
                <ul class="nav">
                  <li class="nav-item <?php echo $page=='addemp'?'active':NULL;?>">
                    <a href="./addemp.php" class="nav-link">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                      <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">เพิ่มพนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='edit_emp_info'?'active':NULL;?>">
                    <a class="nav-link" href="./edit_emp_info.php">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">แก้ไขข้อมูลพนักงาน</span>
                    </a>
                  </li>
                  <li class="nav-item <?php echo $page=='delete_emp'?'active':NULL;?>">
                    <a class="nav-link" href="./delete_emp.php">
                    <span class="sidebar-mini" style="font-weight:bold;"></span>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      <span class="sidebar-normal">ลบข้อมูลพนักงาน</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item <?php if($page==='report_all'){ echo 'active';}?>">
              <a class="nav-link" href="report.php">
              <i class="fa fa-file-text-o" aria-hidden="true"></i>
                <p>รายงาน</p>
              </a>
            </li>
            <!-- <li class="nav-item <?php if($page==='log'){ echo 'active';}?>">
              <a class="nav-link" href="log.php">
              <i class="fa fa-history"></i>
                <p>ประวัติการใช้งาน</p>
              </a>
            </li> -->
          </ul>
        </div>
      </div>