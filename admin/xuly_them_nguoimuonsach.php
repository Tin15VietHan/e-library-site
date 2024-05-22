<?php
require('./../connect.php');

// Kiểm tra xem POST request có chứa danh sách ID sách hay không
if (isset($_POST['books']) && is_array($_POST['books'])) {
    $bookIDs = $_POST['books'];

    // Chuẩn bị câu lệnh SQL với prepared statements để tránh SQL injection
    $stmt = $conn->prepare("UPDATE posts SET soluong_conlai = soluong_conlai - 1 WHERE id = ?");

    if ($stmt) {
        // Lặp qua từng ID sách và thực hiện cập nhật số lượng
        foreach ($bookIDs as $bookID) {
            // Kiểm tra xem ID sách có hợp lệ hay không
            if (filter_var($bookID, FILTER_VALIDATE_INT) !== false) {
                $stmt->bind_param("i", $bookID);
                $stmt->execute();
            } else {
                // Xử lý trường hợp ID sách không hợp lệ
                echo "ID sách không hợp lệ: $bookID";
            }
        }

        // Đóng câu lệnh chuẩn bị
        $stmt->close();
    } else {
        // Xử lý lỗi nếu không thể chuẩn bị câu lệnh SQL
        echo "Lỗi: " . $conn->error;
    }

    // Đóng kết nối cơ sở dữ liệu
    mysqli_close($conn);
} else {
    echo "Dữ liệu không hợp lệ hoặc không tồn tại.";
}
?>
