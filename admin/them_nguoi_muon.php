<?php
// Kết nối đến cơ sở dữ liệu
session_start();
require('./../connect.php'); 

// Kiểm tra xem form có được gửi đi không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form và bảo mật đầu vào
    $madocgia = mysqli_real_escape_string($conn, $_POST['madocgia']);
    $hoten = mysqli_real_escape_string($conn, $_POST['hoten']);
    $sdt = mysqli_real_escape_string($conn, $_POST['sdt']);
    $diachi = mysqli_real_escape_string($conn, $_POST['diachi']);
    $ngayhentra = mysqli_real_escape_string($conn, $_POST['ngayhentra']);
    $sach = $_POST['sach']; // Đây là một mảng các sách
    $nguoitao = mysqli_real_escape_string($conn, $_SESSION['hoten']);

    // Chuyển mảng sách thành chuỗi, ngăn cách bởi dấu phẩy
    $sachmuon = implode(', ', array_map(function($sach_item) use ($conn) {
        return mysqli_real_escape_string($conn, $sach_item);
    }, $sach));

    // Xây dựng câu lệnh insert
    $sql = "INSERT INTO `muon_sach` (`madocgia`, `hoten`, `sdt`, `diachi`, `sach_muon`, `ngay_hen_tra`, `nguoitao`) 
            VALUES ('$madocgia', '$hoten', '$sdt', '$diachi', '$sachmuon', '$ngayhentra', '$nguoitao')";

    // Thực thi câu lệnh insert
    if (mysqli_query($conn, $sql)) {
        echo "Dữ liệu đã được chèn thành công vào cơ sở dữ liệu!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
