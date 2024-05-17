<?php
ob_start();
session_start();
require('./../connect.php');
?>
<?php
if (!isset($_SESSION['account_admin']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header('Location: login.php');
}
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
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./Public/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="./Public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./Public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./Public/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./Public/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./Public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./Public/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="./Public/admin/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Thêm link CSS của Boxicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="../../Public/admin/dist/js/functionsad.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- thư viện biểu đồ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed  printable">

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
                            <a href="#" class="d-block"><?php $fullname = isset($_SESSION['username']) ? $_SESSION['username'] : 'ad';
                                                        echo $fullname ?></a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview">
                                <a href="index.php" class="nav-link active">
                                    <i class='bx bxs-tachometer'></i>
                                    <p>
                                        Trang Chủ
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="ds_nguoi_muon_sach.php" class="nav-link">
                                    <i class='bx bx-book-reader'></i>
                                    <p>
                                        Quản Lý Mượn Trả
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="ds_danhmuc.php" class="nav-link">
                                    <i class='bx bx-book-bookmark'></i>
                                    <p>
                                        Quản Lý Thể Loại
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="ds_sach.php" class="nav-link">
                                    <i class='bx bx-book-open'></i>
                                    <p>
                                        Quản Lý Sách
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="ds_binhluan.php" class="nav-link">
                                    <i class='bx bxs-chat'></i>
                                    <p>
                                        Quản Lý Bình Luận
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="ds_sinhvien.php" class="nav-link">
                                    <i class='bx bx-user'></i>
                                    <p>
                                        Quản Lý Sinh Viên
                                    </p>
                                </a>
                            </li>
                            <?php $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'ad';
                            if ($username == 'admin') {
                                echo "<li class='nav-item has-treeview'>
                                <a href='ds_thanhvien.php' class='nav-link'>
                                    <i class='bx bx-user'></i>
                                    <p>
                                        Quản Lý Thành Viên
                                    </p>
                                </a>
                            </li>
                                ";
                            } else {
                            }; ?>
                            <li class="nav-item has-treeview">
                                <a href="thongke.php" class="nav-link">
                                    <i class='bx bx-bar-chart-alt-2'></i>
                                    <p>
                                        Thống Kê
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
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
        <?php endif; ?>