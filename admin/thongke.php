<?php require('layouts/header.php'); ?>
<?php require('./../connect.php');

$totaldanhmuc = 0;
$totalnguoidung = 0;
$totalsach = 0;
$totalcmt = 0;
$totalmuonsach = 0;
$sqldanhmuc = "SELECT COUNT(*) AS total FROM khoa";
$sqlnguoidung = "SELECT COUNT(*) AS total FROM docgia ";
$sqlsach = "SELECT COUNT(*) AS total FROM sach";
$sqlcmt = "SELECT COUNT(*) AS total FROM muon_sach WHERE trang_thai = 'Đang Mượn'";
$sqlmuonsach = "SELECT COUNT(*) AS total FROM muon_sach ";

$sql_weekly_borrows = "
SELECT DAYOFWEEK(ngay_muon) AS day_of_week, COUNT(DISTINCT id) AS borrow_count
FROM muon_sach
WHERE ngay_muon BETWEEN DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) 
AND DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 7 DAY)
GROUP BY DAYOFWEEK(ngay_muon)
ORDER BY DAYOFWEEK(ngay_muon)";

$result1 = mysqli_query($conn, $sqldanhmuc);
$result2 = mysqli_query($conn, $sqlnguoidung);
$result3 = mysqli_query($conn, $sqlsach);
$result4 = mysqli_query($conn, $sqlcmt);
$result5 = mysqli_query($conn, $sqlmuonsach);
$result_weekly_borrows = mysqli_query($conn, $sql_weekly_borrows);
// Kiểm tra nếu truy vấn thành công
if ($result1 && $result2 && $result3 && $result4 && $result5)  {
	// Lấy kết quả trả về
	$row1 = mysqli_fetch_assoc($result1);
	$row2 = mysqli_fetch_assoc($result2);
	$row3 = mysqli_fetch_assoc($result3);
	$row4 = mysqli_fetch_assoc($result4);
	$row5 = mysqli_fetch_assoc($result5);

	// Số lượng dòng dữ liệu trong bảng categories
	$totaldanhmuc = $row1['total'];
	$totalnguoidung = $row2['total'];
	$totalsach = $row3['total'];
	$totalcmt = $row4['total'];
	$totalmuonsach = $row5['total'];
} else {
	// Xử lý khi truy vấn thất bại
	echo "Lỗi: " . mysqli_error($conn);
}

// Xử lý kết quả của truy vấn mượn sách hàng tuần
$weekly_borrow_data = array_fill(1, 7, 0); // Tạo mảng với 7 phần tử bằng 0, tương ứng với T2 đến CN
$total_weekly_borrow = 0;

if ($result_weekly_borrows) {
	while ($row = mysqli_fetch_assoc($result_weekly_borrows)) {
		$weekly_borrow_data[$row['day_of_week']] = $row['borrow_count'];
		$total_weekly_borrow += $row['borrow_count'];
	}
} else {
	echo "Lỗi: " . mysqli_error($conn);
}
// Điều chỉnh mảng để đảm bảo thứ 2 là phần tử đầu tiên
$weekly_borrow_data_adjusted = [
	$weekly_borrow_data[2], // Thứ 2
	$weekly_borrow_data[3], // Thứ 3
	$weekly_borrow_data[4], // Thứ 4
	$weekly_borrow_data[5], // Thứ 5
	$weekly_borrow_data[6], // Thứ 6
	$weekly_borrow_data[7], // Thứ 7
	$weekly_borrow_data[1]  // Chủ nhật
];


// Truy vấn dữ liệu mượn sách theo ngày trong tháng hiện tại
$sql_monthly_borrows = "
SELECT DAY(ngay_muon) AS day_of_month, COUNT(DISTINCT id) AS borrow_count
FROM muon_sach
WHERE MONTH(ngay_muon) = MONTH(CURDATE()) AND YEAR(ngay_muon) = YEAR(CURDATE())
GROUP BY DAY(ngay_muon)
ORDER BY DAY(ngay_muon)";

$result_monthly_borrows = mysqli_query($conn, $sql_monthly_borrows);

// Khởi tạo mảng với 31 phần tử bằng 0, tương ứng với ngày 1 đến ngày 31
$monthly_borrow_data = array_fill(1, 31, 0);
$total_month_borrow = 0;
if ($result_monthly_borrows) {
    while ($row = mysqli_fetch_assoc($result_monthly_borrows)) {
        $monthly_borrow_data[$row['day_of_month']] = $row['borrow_count'];
		$total_month_borrow += $row['borrow_count'];
    }
} else {
    echo "Lỗi: " . mysqli_error($conn);
}

// Truy vấn dữ liệu mượn sách theo tháng trong năm hiện tại
$sql_yearly_borrows = "
SELECT MONTH(ngay_muon) AS month_of_year, COUNT(DISTINCT id) AS borrow_count
FROM muon_sach
WHERE YEAR(ngay_muon) = YEAR(CURDATE())
GROUP BY MONTH(ngay_muon)
ORDER BY MONTH(ngay_muon)";

$result_yearly_borrows = mysqli_query($conn, $sql_yearly_borrows);

// Khởi tạo mảng với 12 phần tử bằng 0, tương ứng với tháng 1 đến tháng 12
$yearly_borrow_data = array_fill(1, 12, 0);
$total_year_borrow = 0;
if ($result_yearly_borrows) {
    while ($row = mysqli_fetch_assoc($result_yearly_borrows)) {
        $yearly_borrow_data[$row['month_of_year']] = $row['borrow_count'];
		$total_year_borrow += $row['borrow_count'];
    }
} else {
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
					<h1 class="m-0 text-dark"><b style="color:#1E90FF">BẢNG THỐNG KÊ THƯ VIỆN</b></h1>
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
							<h4>THỂ LOẠI</h4>
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
							<h3><?php echo $totalsach; ?></h3>
							<h4>SÁCH</h4>
						</div>
						<div class="icon">
							<i class='bx bx-book-open'></i>
						</div>
						<a href="ds_sach.php" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<div class="small-box bg-warning" style="color: aliceblue !important;" ;>
						<div class="inner">
							<h3><?php echo $totalnguoidung; ?></h3>
							<h4>ĐỘC GIẢ</h4>
						</div>
						<div class="icon">
							<i class='bx bx-user'></i>
						</div>
						<a style="color: aliceblue !important;" href='ds_docgia.php' class='small-box-footer'>Chi tiết <i class='fas fa-arrow-circle-right'></i></a>
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
           <div class="row justify-content-end pr-3">
            <button id="printWeekly" class="print-btn">
                <img src="https://img.upanh.tv/2024/05/22/printer.png" alt="Printer Icon" style="width: 16px; height: 16px; margin-right: 5px;">
                In Tuần
            </button>
            <button id="printMonthly" class="print-btn">
                <img src="https://img.upanh.tv/2024/05/22/printer.png" alt="Printer Icon" style="width: 16px; height: 16px; margin-right: 5px;">
                In Tháng
            </button>
            <button id="printYearly" class="print-btn">
                <img src="https://img.upanh.tv/2024/05/22/printer.png" alt="Printer Icon" style="width: 16px; height: 16px; margin-right: 5px;">
                In Năm
            </button>
            </div>


	</section>

	<!-- Thẻ canvas để vẽ biểu đồ -->
    	<canvas id="waveChart" width="800" height="300"></canvas>
          <div class="row justify-content-center">
        <!-- Nút chọn tuần -->
        <button id="weekBtn" class="print-btn">Tuần</button>
        <!-- Nút chọn tháng -->
        <button id="monthBtn" class="print-btn" >Tháng</button>
        <!-- Nút chọn năm -->
        <button id="yearBtn"  class="print-btn">Năm</button>
    </div>
    
    <style>
        /* Màu chữ khi hover */
        button:hover {
            color: #1e88e5; /* Màu xanh trời */
        }
    
        /* Màu chữ khi focus */
        button:focus {
            color: #1e88e5; /* Màu xanh trời */
            outline: none; /* Loại bỏ đường viền khi focus */
        }
    
        /* Màu viền khi hover */
        button:hover {
            border-color: #1e88e5; /* Màu viền xanh trời */
        }
    
        /* Màu viền khi focus */
        button:focus {
            border-color: #1e88e5; /* Màu viền xanh trời */
        }
        .print-btn {
        margin-right: 20px;
        width: 110px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        border: 2px solid rgb(213, 213, 213);
        border-radius: 10px;
        gap: 10px;
        font-size: 16px;
        cursor: pointer;
        overflow: hidden;
        font-weight: 500;
        box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.065);
        transition: all 0.3s;
        }
    </style>
	<script>
		// Lấy tham chiếu đến canvas
		var ctx = document.getElementById('waveChart').getContext('2d');

		// Dữ liệu lượt mượn sách hàng tuần từ PHP
		var weeklyBorrowData = <?php echo json_encode(array_values($weekly_borrow_data_adjusted)); ?>;
		// Khởi tạo biểu đồ mặc định là biểu đồ tuần
		var defaultData = {
			labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
			datasets: [{
				label: 'Lượt Mượn Sách:  ' + <?php echo $total_weekly_borrow; ?> + '  / ( ' + <?php echo $totalmuonsach; ?> + ')',
				data: weeklyBorrowData,
				borderColor: 'rgba(75, 192, 192, 1)',
				backgroundColor: 'rgba(75, 192, 192, 0.2)',
				borderWidth: 1,
				tension: 0.3,
				fill: true
			}]
		};

		// Tạo biểu đồ mặc định
		var waveChart = new Chart(ctx, {
			type: 'line',
			data: defaultData,
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
		// Lắng nghe sự kiện khi người dùng nhấp vào nút "Tuần"
		document.getElementById('weekBtn').addEventListener('click', function() {
			var WeekData = {
				labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
				datasets: [{
					label: 'Lượt Mượn Sách:  ' + <?php echo $total_weekly_borrow; ?> + '   / ( ' + <?php echo $totalmuonsach; ?> + ')',
					data: weeklyBorrowData,
					borderColor: 'rgba(75, 192, 192, 1)',
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					borderWidth: 1,
					tension: 0.3,
					fill: true
				}]
			};
			// Cập nhật dữ liệu cho biểu đồ
			waveChart.data = WeekData;
			waveChart.update();
		});
		// Lắng nghe sự kiện khi người dùng nhấp vào nút "Tháng"
		document.getElementById('monthBtn').addEventListener('click', function() {
			var monthBorrowData = <?php echo json_encode(array_values($monthly_borrow_data)); ?>;
			// Cập nhật dữ liệu cho biểu đồ tháng
			var monthData = {
				labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
				datasets: [{
					label: 'Lượt Mượn Sách:  ' + <?php echo $total_month_borrow; ?> + '   / ( ' + <?php echo $totalmuonsach; ?> + ')',
					data: monthBorrowData,
					borderColor: 'rgba(75, 192, 192, 1)',
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					borderWidth: 1,
					tension: 0.3,
					fill: true
				}]
			};
			// Cập nhật dữ liệu cho biểu đồ
			waveChart.data = monthData;
			waveChart.update();
		});
		// Lắng nghe sự kiện khi người dùng nhấp vào nút "Năm"
		document.getElementById('yearBtn').addEventListener('click', function() {
			var yearBorrowData = <?php echo json_encode(array_values($yearly_borrow_data)); ?>;
			// Cập nhật dữ liệu cho biểu đồ năm
			var yearData = {
				labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
				datasets: [{
					label: 'Lượt Mượn Sách:  ' + <?php echo $total_year_borrow; ?> + '   / ( ' + <?php echo $totalmuonsach; ?> + ')',
					data: yearBorrowData,
					borderColor: 'rgba(75, 192, 192, 1)',
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					borderWidth: 1,
					tension: 0.3,
					fill: true
				}]
			};
			// Cập nhật dữ liệu cho biểu đồ
			waveChart.data = yearData;
			waveChart.update();
		});
// Lắng nghe sự kiện khi người dùng nhấp vào nút "In Tuần"
document.getElementById('printWeekly').addEventListener('click', function() {
    // Lấy ngày, tháng và năm hiện tại
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    var currentWeek = getWeekNumber(currentDate);
    var weekStartDate = getStartDateOfWeek(currentDate);
    var weekEndDate = new Date(weekStartDate);
    weekEndDate.setDate(weekEndDate.getDate() + 6);
    // Gọi hàm in với thông kê lượt mượn sách của tuần và thêm thông tin về tuần vào tiêu đề
    printStatistics(
        'Trường Cao đẳng Việt Nam Hàn Quốc',
        `Thông Kê Lượt Mượn Sách Của Tuần ${currentWeek} (${formatDate(weekStartDate)} - ${formatDate(weekEndDate)})`,
        <?php echo $total_weekly_borrow; ?>,
        <?php echo $totalmuonsach; ?>,
        currentWeek,
        null,
        currentYear
    );
});
// Lắng nghe sự kiện khi người dùng nhấp vào nút "In Tháng"
document.getElementById('printMonthly').addEventListener('click', function() {
    // Lấy ngày, tháng và năm hiện tại
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0 nên cần cộng thêm 1
    var currentYear = currentDate.getFullYear();
    var monthStartDate = new Date(currentYear, currentMonth - 1, 1);
    var monthEndDate = new Date(currentYear, currentMonth, 0);
    // Gọi hàm in với thông kê lượt mượn sách của tháng và thêm thông tin về tháng vào tiêu đề
    printStatistics(
        'Trường Cao đẳng Việt Nam Hàn Quốc',
        `Thông Kê Lượt Mượn Sách Của Tháng ${currentMonth}/${currentYear} (${formatDate(monthStartDate)} - ${formatDate(monthEndDate)})`,
        <?php echo $total_month_borrow; ?>,
        <?php echo $totalmuonsach; ?>,
        null,
        currentMonth,
        currentYear
    );
});
// Lắng nghe sự kiện khi người dùng nhấp vào nút "In Năm"
document.getElementById('printYearly').addEventListener('click', function() {
    // Lấy ngày, tháng và năm hiện tại
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    var yearStartDate = new Date(currentYear, 0, 1);
    var yearEndDate = new Date(currentYear, 11, 31);
    // Gọi hàm in với thông kê lượt mượn sách của năm và thêm thông tin về năm vào tiêu đề
    printStatistics(
        'Trường Cao đẳng Việt Nam Hàn Quốc',
        `Thông Kê Lượt Mượn Sách Của Năm ${currentYear} (${formatDate(yearStartDate)} - ${formatDate(yearEndDate)})`,
        <?php echo $total_year_borrow; ?>,
        <?php echo $totalmuonsach; ?>,
        null,
        null,
        currentYear
    );
});
// Hàm in thông kê lượt mượn sách
function printStatistics(schoolName, chartTitle, borrowCount, totalMuonsach, weekInfo, monthInfo, yearInfo) {
    // Tạo một chuỗi chứa nội dung bạn muốn in
    var contentToPrint = `
        <div style="font-family: Arial, sans-serif; padding: 20px;">
            <h1 style="text-align: center; margin-bottom: 20px;">${schoolName}</h1>
            <div style="text-align: center; margin-top: 20px;">
            <img src="https://vkc.edu.vn/wp-content/uploads/2018/03/logo_viethan.png" alt="Descriptive text for the image" style=" width: 100px;height: 100px; border-radius: 10px;">
        </div>
            <div style="background-color: #f2f2f2; padding: 20px; border-radius: 10px;">
                <h2 style="margin-bottom: 10px;">${chartTitle}</h2>
                <p style="margin-bottom: 10px;">Lượt mượn sách: <strong>${borrowCount}</strong></p>
                <p>Tổng số sách Được Mượn: <strong>${totalMuonsach}</strong></p>
            </div>
             <div class="footer" style="margin-top: 70px; text-align: right;">
                <p style="margin-right:10px">Người Tạo Thống Kê</p>
                <p class="signature">
                    <?php 
                        $fullname = isset($_SESSION['hoten']) ? $_SESSION['hoten'] : 'ad'; 
                        echo $fullname; 
                    ?>
                </p>
            </div>
        </div>
    `;
    // Tạo một cửa sổ mới và hiển thị nội dung bạn muốn in
    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write(contentToPrint);
    printWindow.document.close();
    // In nội dung
    printWindow.print();
}
// Hàm lấy số tuần trong năm
function getWeekNumber(d) {
    // Copy date để tránh thay đổi date gốc
    d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
    // Lấy thứ tự thứ của ngày 1 tháng 1
    var dayNum = d.getUTCDay() || 7;
    // Di chuyển ngày đến thứ 2 của tuần đầu tiên
    d.setUTCDate(d.getUTCDate() + 4 - dayNum);
    // Tuần đầu tiên của năm là tuần 1
    var yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
    // Tính toán số tuần
    var weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
    // Trả về số tuần
    return weekNo;
}

// Hàm lấy ngày bắt đầu của tuần từ một ngày cho trước
function getStartDateOfWeek(date) {
    var day = date.getDay() || 7;
    if (day !== 1) 
        date.setHours(-24 * (day - 1)); 
    return date;
}
// Hàm định dạng ngày theo định dạng dd/mm/yyyy
function formatDate(date) {
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    return `${day}/${month}/${year}`;
}

	</script>
</div>
<?php require('layouts/footer.php'); ?>