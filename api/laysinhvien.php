<?php
// Kết nối đến cơ sở dữ liệu MySQL
$server = 'localhost';
$user = 'u395921506_thuvienviethan';
$pass = 'AnhquocQH@2002@';
$database = 'u395921506_thuvienviethan';
$conn = mysqli_connect($server, $user, $pass, $database);
mysqli_set_charset($conn, 'utf8');

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Log incoming request data
file_put_contents('log.txt', "Received POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);

// Lấy dữ liệu từ yêu cầu POST của ứng dụng Android
$madocgia = mysqli_real_escape_string($conn, $_POST['madocgia']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Truy vấn để kiểm tra thông tin đăng nhập
$sql = "SELECT * FROM docgia WHERE madocgia = '$madocgia' AND password = '$password'";
$result = mysqli_query($conn, $sql);

// Log the query and result
file_put_contents('log.txt', "SQL Query: $sql\n", FILE_APPEND);
file_put_contents('log.txt', "Query Result: " . print_r(mysqli_num_rows($result), true) . "\n", FILE_APPEND);

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
