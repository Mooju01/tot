      <div class="sidebar" data-background-color="white"data-image="assets/img/sidebar-1.jpg">
        <div class="logo">
          <a href="index.php" class="simple-text logo-normal">
             ระบบข่ายสายโทรศัพท์ TOT
          </a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
          <li class="nav-item <?php if($page==='index'){ echo 'active';}?>">
              <a class="nav-link" href="index.php">
              <i class="fa fa-home" aria-hidden="true"></i>
                <p>หน้าแรก</p>
              </a>
            </li>
            <li class="nav-item <?php if($page==='structure'){ echo 'active';}?>">
              <a class="nav-link" href="./structure.php">
              <i class="fa fa-users" aria-hidden="true"></i>
                <p>โครงสร้างส่วนงาน</p>
              </a>
            </li>
            <li class="nav-item <?php if($page==='search'){ echo 'active';}?>">
              <a class="nav-link" href="search.php">
              <i class="fa fa-search" aria-hidden="true"></i>
                <p>ค้นหาเบอร์โทรศัพท์</p>
              </a>
            </li>  
          </ul>
        </div>
      </div>