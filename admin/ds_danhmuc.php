<?php
require('layouts/header.php');
require('./../connect.php');

$search = "";
$limit = 10;
$page = 1;
if (isset($_REQUEST['p']) && (int)$_REQUEST['p'] >= 1) {
    $page = (int)$_REQUEST['p'];
}
if (isset($_GET['txtsearch'])) {
    $search = $_GET['txtsearch'];
}

$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM khoa WHERE tenkhoa LIKE '%$search%'";
$query = mysqli_query($conn, $sql . " LIMIT $offset, $limit");
$count = mysqli_num_rows(mysqli_query($conn, $sql));
$totalPage = ceil($count / $limit) ?? 0;
?>

<div class="content-wrapper" style="min-height: 365px;">
    <section class="content">
        <div class="container-fluid">
            <h3><b>KHOA</b></h3>
            <br>
            <form action="" method="GET">
                <input type="text" name="txtsearch" class="form" placeholder="Tìm kiếm..." />
                <button class="sbutton" type="submit">
                    <i class="fa fa-search"></i> Tìm kiếm
                </button>
            </form>
            <br>
            <a href="them_danhmuc.php" class="btn btn-success btn-sm rounded-icon" data-toggle="tooltip" data-placement="top" title="Thêm Khoa" style="float:right;margin-top: -10px;">
                <i class="fa fa-plus fa-sm"></i> Thêm Khoa
            </a>
            <br><br>
            <div class="row">
                <div class="table-responsive">
                    <table cellspacing="0" cellpadding="0" class="table table-bordered table-rounded">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã Khoa</th>
                                <th scope="col">Tên Khoa</th>
                                <th scope="col">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = ($page - 1) * $limit + 1;
                            while ($row = mysqli_fetch_array($query)) :
                            ?>
                                <tr>
                                    <td><?php echo $stt++; ?></td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['tenkhoa']; ?></td>
                                    <td>
                                        <a href="sua_danhmuc.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm rounded-icon" data-toggle="tooltip" data-placement="top" title="Sửa">
                                            <i class="fa fa-edit fa-sm"></i>
                                        </a>
                                        <a href="xoa_danhmuc.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm rounded-icon" data-toggle="tooltip" data-placement="top" title="Xóa">
                                            <i class="fa fa-trash fa-sm"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php 
                            for ($i = 1; $i <= $totalPage; $i++) {
                                if ($i == $page) {
                                    echo "<li class='page-item active'><a class='page-link' href='ds_danhmuc.php?p=$i'>$i</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='ds_danhmuc.php?p=$i'>$i</a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </section>
</div>

<?php require('layouts/footer.php'); ?>

<style>
    .page-link {
        width: 30px;
        height: 30px;
    }
    .pagination {
        font-size: 12px;
    }
    .sbutton {
        color: #fff;
        background-color: #007bff;
        border: none;
        padding: 9px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-size: 14px;
    }
    .sbutton:hover {
        background-color: #0056b3;
    }
    .sbutton i {
        margin-right: 5px;
    }
    h3 {
        padding-top: 30px;
        color: #1E90FF;
    }
    .form {
        border: 2px solid black;
        border-radius: 5px;
        padding: 5px;
        margin-right: 10px;
    }
    .table-rounded {
        border-radius: 10px;
        overflow: hidden;
    }
    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
    }
    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .table th {
        background-color: #f2f2f2;
    }
    .btn {
        padding: 5px 10px;
        margin: 2px;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: #fff;
    }
    .btn-sm {
        padding: 5px;
        font-size: 14px;
    }
    .rounded-icon {
        border-radius: 5px;
        padding: 6px;
    }
    .rounded-icon i {
        width: 18px;
        height: 18px;
        line-height: 18px;
        text-align: center;
    }

    /* Highlight row on hover with smooth transition */
    .table tbody tr {
        transition: background-color 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #dcdcdc;
    }
</style>


<!-- Include FontAwesome for the icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Include jQuery and Bootstrap for tooltip functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
