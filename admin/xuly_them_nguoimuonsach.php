<?php
// Kết nối đến cơ sở dữ liệu
require('./../connect.php');

// Lấy ID của sách từ AJAX
$id_sach = $_POST['id'];

// Giảm số lượng sách trong bảng posts
$sql_giam_soluong = "UPDATE posts SET soluong = soluong - 1 WHERE id = '$id'";

// Thực hiện truy vấn
if(mysqli_query($conn, $sql_giam_soluong)) {
    // Trả về kết quả thành công nếu không có lỗi
    echo "Số lượng sách đã được cập nhật.";
} else {
    // Trả về thông báo lỗi nếu có lỗi xảy ra
    echo "Lỗi: " . mysqli_error($conn);
}

// Đóng kết nối
mysqli_close($conn);
?>
