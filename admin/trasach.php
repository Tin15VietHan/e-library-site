<?php
require('./../connect.php');

if(isset($_GET['id']) && $_GET['id'] != ""){
    $id = $_GET['id'];

    // Cập nhật trạng thái trong bảng muon_sach
    $sql_update = "UPDATE `muon_sach` SET `trang_thai`='Đã Trả' WHERE `id` = $id";
    $result_update = mysqli_query($conn, $sql_update);

    if ($result_update) {
    header("location: ds_nguoi_muon_sach.php");
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    
} else {
    echo "ID không hợp lệ";
}

$conn->close();
?>
