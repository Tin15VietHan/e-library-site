<?php require('layouts/header.php'); ?>
<?php require('./../connect.php');

$totaldanhmuc = 0;
$totalnguoidung = 0;
$totalsach = 0;
$totalcmt = 0;

$sqldanhmuc = "SELECT COUNT(*) AS total FROM categories";
$sqlnguoidung = "SELECT COUNT(*) AS total FROM accounts ";
$sqlsach = "SELECT COUNT(*) AS total FROM posts";
$sqlcmt = "SELECT COUNT(*) AS total FROM muon_sach WHERE trang_thai = 'Đang Mượn'";

$result1 = mysqli_query($conn, $sqldanhmuc);
$result2 = mysqli_query($conn, $sqlnguoidung);
$result3 = mysqli_query($conn, $sqlsach);
$result4 = mysqli_query($conn, $sqlcmt);

// Kiểm tra nếu truy vấn thành công
if ($result1 && $result2 && $result3 && $result4) {
	// Lấy kết quả trả về
	$row1 = mysqli_fetch_assoc($result1);
	$row2 = mysqli_fetch_assoc($result2);
	$row3 = mysqli_fetch_assoc($result3);
	$row4 = mysqli_fetch_assoc($result4);

	// Số lượng dòng dữ liệu trong bảng categories
	$totaldanhmuc = $row1['total'];
	$totalnguoidung = $row2['total'];
	$totalsach = $row3['total'];
	$totalcmt = $row4['total'];
} else {
	// Xử lý khi truy vấn thất bại
	echo "Lỗi: " . mysqli_error($conn);
}


// Đóng kết nối
mysqli_close($conn);
?>
<div class="content-wrapper" style="min-height: 365px;">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark"><b>BẢNG THỐNG KÊ THƯ VIỆN</b></h1>
				</div><!-- /.col -->
			</div>
		</div>
	</div></br>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php echo $totaldanhmuc; ?></h3>
							<h4>QUẢN LÝ KHOA</h4>
						</div>
						<div class="icon">
							<i class='bx bx-book-bookmark'></i>
						</div>
						<a href="ds_danhmuc.php" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3>
								<h3><?php echo $totalsach; ?></h3>
							</h3>

							<h4>QUẢN LÝ SÁCH</h4>
						</div>
						<div class="icon">
							<i class='bx bx-book-open'></i>
						</div>
						<a href="ds_sach.php" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">

					<div class="small-box bg-warning">
						<div class="inner">
							<h3>
								<h3><?php echo $totalnguoidung; ?></h3>
							</h3>

							<h4 style="color: #fff">THÀNH VIÊN</h4>
						</div>
						<div class="icon">
							<i class='bx bx-user'></i>
						</div>
						<?php $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'ad';
						if ($username == 'admin') {
							echo "<a href='ds_thanhvien.php' class='small-box-footer'>Chi tiết <i class='fas fa-arrow-circle-right'></i></a>";
						} else {
						}; ?>

					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3><?php echo $totalcmt ?></h3>

							<h4>NGƯỜI ĐANG MƯỢN SÁCH</h4>
						</div>
						<div class="icon">
						<i class='bx bxs-group'></i>
						</div>
						<a href="ds_nguoi_muon_sach.php" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
		</div>
	</section>