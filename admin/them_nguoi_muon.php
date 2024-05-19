<?php
// Kết nối đến cơ sở dữ liệu
ob_start();
session_start();
require('./../connect.php'); 

// Lấy dữ liệu từ form
$nguoimuon = $_POST['nguoimuon'];
$ngayhentra = $_POST['ngayhentra'];
$sach = $_POST['sach'];
$fullname =  $_SESSION['hoten'];

// Xây dựng câu lệnh insert

$sql = "INSERT INTO `muon_sach`( `docgiaID` , `sachID`, `ngay_hen_tra`, `nguoitaoID`)  VALUES ('$nguoimuon', '$sach', '$ngayhentra', '$fullname')";

// Thực thi câu lệnh insert
if (mysqli_query($conn, $sql)) {
    echo "Dữ liệu đã được chèn thành công vào cơ sở dữ liệu!";
} else {
    echo "Lỗi: " . mysqli_error($conn);
}


// Đóng kết nối
mysqli_close($conn);
?>


