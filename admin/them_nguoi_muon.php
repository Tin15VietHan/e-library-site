<?php
// Kết nối đến cơ sở dữ liệu
ob_start();
session_start();
require('./../connect.php'); 

// Lấy dữ liệu từ form
$masv = $_POST['masv'];
$nguoimuon = $_POST['nguoimuon'];
$sdt = $_POST['sdt'];
$diachi = $_POST['diachi'];
$ngayhentra = $_POST['ngayhentra'];
$sach = $_POST['sach'];
$fullname =  $_SESSION['fullname'];

// Xây dựng câu lệnh insert

$sql = "INSERT INTO `muon_sach`( `masv`,`ten_nguoi_muon`, `sdt`, `dia_chi`, `sach_muon`, `ngay_hen_tra`, `data_creator`)  VALUES ('$masv','$nguoimuon', '$sdt', '$diachi','$sach', '$ngayhentra', '$fullname')";

// Thực thi câu lệnh insert
if (mysqli_query($conn, $sql)) {
    echo "Dữ liệu đã được chèn thành công vào cơ sở dữ liệu!";
} else {
    echo "Lỗi: " . mysqli_error($conn);
}


// Đóng kết nối
mysqli_close($conn);
?>


