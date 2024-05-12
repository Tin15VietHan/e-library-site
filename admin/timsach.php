<?php
// Kết nối đến cơ sở dữ liệu
require('./../connect.php'); 

/// Lấy dữ liệu từ yêu cầu tìm kiếm
$searchTerm = $_GET['term'];

// Câu lệnh SQL truy vấn dữ liệu gợi ý
$sql = "SELECT `title` FROM `posts` WHERE `title` LIKE '%$searchTerm%' ORDER BY `updated_at` DESC";

// Thực hiện truy vấn
$result = $conn->query($sql);

// Lưu trữ kết quả trong một mảng
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row['title'];
    }
}

// Trả về dữ liệu dưới dạng JSON
echo json_encode($data);

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>


