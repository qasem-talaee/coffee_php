<?php
include('includes/outh.php');
include('includes/db.php');
include('includes/user.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>بخش مدیریت</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="./images/favicon.png" />
    <script type="text/javascript" src="js/sweetalert.js"></script>
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> 
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">به بخش مدیریت خوش آمدید</h5>
          <ul class="navbar-nav navbar-nav-right ml-auto text-right">
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <span class="font-weight-normal"> <?php echo($name); ?> </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <p class="mb-1 mt-3"><?php echo($name); ?></p>
                  <p class="font-weight-light text-muted mb-0"><?php echo($email); ?></p>
                </div>
                <a class="dropdown-item" href="?profile"><i class="dropdown-item-icon icon-user text-primary"></i> پروفایل من</a>
                <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon icon-power text-primary"></i>خروج</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav text-right">
            <li class="nav-item nav-profile text-right">
              <a href="?profile" class="nav-link">
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo($name); ?></p>
                  <p class="designation"><?php echo($user_status); ?></p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category text-right">
              <span class="nav-link text-right">سایت من</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" target="_blank" href="../index.php">
                <span class="menu-title">سایت من</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            <li class="nav-item nav-category text-right">
              <span class="nav-link text-right">داشبورد</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?dash">
                <span class="menu-title">داشبورد</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            <li class="nav-item nav-category"><span class="nav-link">مدیریت</span></li>
            <li class="nav-item">
              <a class="nav-link" href="?ana">
                <span class="menu-title">آنالیز</span>
                <i class="icon-globe menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?menu">
                <span class="menu-title">مدیریت منو</span>
                <i class="icon-globe menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?cat">
                <span class="menu-title">دسته بندی ها</span>
                <i class="icon-book-open menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?table">
                <span class="menu-title">میزها</span>
                <i class="icon-chart menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?info">
                <span class="menu-title">اطلاعات سایت</span>
                <i class="icon-grid menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?profile">
                <span class="menu-title">پروفایل</span>
                <i class="icon-grid menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?order">
                <span class="menu-title">سفارشات</span>
                <i class="icon-grid menu-icon"></i>
              </a>
            </li>
            <?php
            if($user_status == "admin"){ ?>
            <li class="nav-item">
              <a class="nav-link" href="?user">
                <span class="menu-title">کارمندان</span>
                <i class="icon-grid menu-icon"></i>
              </a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item nav-category"><span class="nav-link">خروج</span></li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">
                <span class="menu-title">خروج</span>
                <i class="icon-globe menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <?php
          if(isset($_GET['dash'])){
            include('pages/dash.php');
          }
          elseif(isset($_GET['ana'])){
            include('pages/ana.php');
          }
          elseif(isset($_GET['cat'])){
            include('pages/cat.php');
          }
          elseif(isset($_GET['add_cat'])){
            include('pages/add_cat.php');
          }
          elseif(isset($_GET['edit_cat'])){
            include('pages/edit_cat.php');
          }
          elseif(isset($_GET['table'])){
            include('pages/table.php');
          }
          elseif(isset($_GET['add_table'])){
            include('pages/add_table.php');
          }
          elseif(isset($_GET['edit_table'])){
            include('pages/edit_table.php');
          }
          elseif(isset($_GET['info'])){
            include('pages/info.php');
          }
          elseif(isset($_GET['profile'])){
            include('pages/profile.php');
          }
          elseif(isset($_GET['order'])){
            include('pages/order.php');
          }
          elseif(isset($_GET['user'])){
            include('pages/user.php');
          }
          elseif(isset($_GET['add_user'])){
            include('pages/add_user.php');
          }
          elseif(isset($_GET['edit_user'])){
            include('pages/edit_user.php');
          }
          elseif(isset($_GET['menu'])){
            include('pages/menu.php');
          }
          elseif(isset($_GET['add_menu'])){
            include('pages/add_menu.php');
          }
          elseif(isset($_GET['edit_menu'])){
            include('pages/edit_menu.php');
          }
          else{
            include('pages/dash.php');
          }
          ?>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer text-center" style="direction:rtl">
            <div class="row tm-copyright" style="direction:rtl;margin-top:50px;"> 
            <p class="col-lg-12 small copyright-text text-center ">توسعه داده شده با عشق توسط <a class="btn btn-primary" target="_blank" href="http://qtle.ir">http://qtle.ir</a>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>