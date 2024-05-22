<?php ob_start(); session_start(); ?>
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<?php
require('./../connect.php');
if (!isset($_SESSION['account_admin']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header('Location: login.php');
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin E-Library Việt Hàn</title>
    <link rel="shortcut icon" href="./Public/admin/dist/img/logo_viethan.png" type="image/x-icon">
    <link rel="icon" href="./Public/admin/dist/img/logo_viethan.png" type="image/x-icon">
    <link rel="stylesheet" href="./Public/admin/dist/css/stylead.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Public/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="./Public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="./Public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="./Public/admin/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="./Public/admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="./Public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="./Public/admin/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./Public/admin/plugins/summernote/summernote-bs4.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../../Public/admin/dist/js/functionsad.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed printable">
   <?php if (isset($_SESSION['account_admin'])) : ?>
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="./Public/admin/dist/img/logo_viethan.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><strong>E-LIBRARY VIỆT HÀN</strong></span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="justify-content: space-around;">
                    <div class="info">
                        <a href="#" class="d-block"><?php $fullname = isset($_SESSION['hoten']) ? $_SESSION['hoten'] : 'ad'; echo $fullname ?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="nav-items">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
                                <i class='bx bxs-tachometer'></i>
                                <p>Trang Chủ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ds_nguoi_muon_sach.php" class="nav-link <?php echo $current_page == 'ds_nguoi_muon_sach.php' ? 'active' : ''; ?>">
                                <i class='bx bx-book-reader'></i>
                                <p>Quản Lý Mượn Trả</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ds_danhmuc.php" class="nav-link <?php echo $current_page == 'ds_danhmuc.php' ? 'active' : ''; ?>">
                                <i class='bx bx-book-bookmark'></i>
                                <p>Quản Lý Khoa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ds_sach.php" class="nav-link <?php echo $current_page == 'ds_sach.php' ? 'active' : ''; ?>">
                                <i class='bx bx-book-open'></i>
                                <p>Quản Lý Sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ds_docgia.php" class="nav-link <?php echo $current_page == 'ds_docgia.php' ? 'active' : ''; ?>">
                                <i class='bx bx-user'></i>
                                <p>Quản Lý Độc Giả</p>
                            </a>
                        </li>
                        <?php $username = isset($_SESSION['quyen']) ? $_SESSION['quyen'] : 'ad';
                        if ($username == 'Admin') : ?>
                        <li class="nav-item">
                            <a href="ds_quantri.php" class="nav-link <?php echo $current_page == 'ds_quantri.php' ? 'active' : ''; ?>">
                                <i class='bx bx-user'></i>
                                <p>Quản Lý Thành Viên</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="thongke.php" class="nav-link <?php echo $current_page == 'thongke.php' ? 'active' : ''; ?>">
                                <i class='bx bx-bar-chart-alt-2'></i>
                                <p>Thống Kê</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class='bx bx-log-out'></i>
                                <p>Đăng Xuất</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
    <script>
        // Add event listener to nav links
        document.querySelectorAll('.nav-link').forEach(item => {
            item.addEventListener('click', event => {
                // Remove active class from all nav links
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                });
                // Add active class to the clicked nav link
                event.currentTarget.classList.add('active');
            });
        });
    </script>
<?php endif; ?>

<!-- jQuery --> 
<script src="./assets/js/jquery.min.js"></script> 
<!--jQuery easing--> 
<script src="./assets/js/jquery.easing.1.3.js"></script> 
<!-- bootstrab js --> 
<script src="./assets/js/bootstrap.js"></script> 
<!--style switcher--> 
<script src="./assets/js/style-switcher.js"></script> <!--wow animation--> 
<script src="./assets/js/wow.min.js"></script> 
<!-- time and date --> 
<script src="./assets/js/moment.min.js"></script> 
<!--news ticker--> 
<script src="./assets/js/jquery.ticker.js"></script> 
<!-- owl carousel --> 
<script src="./assets/js/owl.carousel.js"></script> 
<!-- magnific popup --> 
<script src="./assets/js/jquery.magnific-popup.js"></script> 
<!-- weather --> 
<script src="./assets/js/jquery.simpleWeather.min.js"></script> 
<!-- calendar--> 
<script src="./assets/js/jquery.pickmeup.js"></script> 
<!-- go to top --> 
<script src="./assets/js/jquery.scrollUp.js"></script> 
<!-- scroll bar --> 
<script src="./assets/js/jquery.nicescroll.js"></script> 
<script src="./assets/js/jquery.nicescroll.plus.js"></script> 
<!--masonry--> 
<script src="./assets/js/masonry.pkgd.js"></script> 
<!--media queries to js--> 
<script src="./assets/js/enquire.js"></script> 
<!--custom functions--> 
<script src="./assets/js/custom-fun.js"></script>
<script src="./assets/js/block-copy.js"></script>
