<?php
// Kết nối đến cơ sở dữ liệu MySQL
$host = 'localhost';
$username = 'id21773647_library';
$password = 'Tt15@20092002';
$database = 'id21773647_library';
$conn = mysqli_connect($host, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Lấy dữ liệu từ yêu cầu POST của ứng dụng Android
$masv = $_POST['masv'];
$matkhau = $_POST['matkhau'];

// Truy vấn để kiểm tra thông tin đăng nhập
$sql = "SELECT * FROM sinhvien WHERE masv = '$masv' AND matkhau = '$matkhau'";
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả trả về
if (mysqli_num_rows($result) > 0) {
    // Thông tin đăng nhập chính xác
    echo "success";
} else {
    // Thông tin đăng nhập không chính xác
    echo "failure";
}

// Đóng kết nối
mysqli_close($conn);
?>
