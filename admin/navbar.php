<nav
          class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top "
        >
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <a class="navbar-brand" href="index.php"><?php if($page==='indexadmin')?></a>
            </div>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              aria-controls="navigation-index"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
              <form class="navbar-form">
                <div class="input-group no-border"> 
                </div>
              </form>
              <ul class="navbar-nav">
                    
                <li class="nav-item dropdown">
                  <a
                    class="nav-link"
                    href="#pablo"
                    id="navbarDropdownProfile"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                  <i class="fa fa-user" aria-hidden="true"></i>
                    
                    User : <?=$_SESSION['username']?>
                   
                  </a>
                  <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbarDropdownProfile"
                  >   
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="repassword.php"><i class="fa fa-key" ></i> เปลี่ยนรหัส</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>