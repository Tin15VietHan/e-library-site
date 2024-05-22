<?php
// Kết nối đến cơ sở dữ liệu
require('./../connect.php');

// Lấy mã sinh viên từ yêu cầu AJAX
$masv = $_POST['masv'];

// Truy vấn cơ sở dữ liệu để lấy thông tin người mượn dựa trên mã sinh viên
$sql = "SELECT tensv, sdt, diachi FROM sinhvien WHERE masv = '$masv'";
$result = mysqli_query($conn, $sql);

// Kiểm tra xem truy vấn có thành công hay không
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Trả về dữ liệu dưới dạng JSON
    echo json_encode($row);
} else {
    // Trả về thông báo lỗi nếu không tìm thấy thông tin
    echo json_encode(['error' => 'Không tìm thấy thông tin người mượn.']);
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>
