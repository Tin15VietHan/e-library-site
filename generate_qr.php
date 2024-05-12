<?php
ob_start();
session_start();

// Lấy nội dung tùy chỉnh từ biến POST hoặc GET
//$customContent = isset($_POST['custom_content']) ? $_POST['custom_content'] : '';
$customContent = "Noi dung ck";
$customContent = $_GET['customContent'];
$contensck;
// Khởi tạo một cURL session
$curl = curl_init();

// Thiết lập các tùy chọn cho cURL session
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.vietqr.io/v2/generate',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(array(
        "accountNo" => "0370186439999",
        "accountName" => "NGUYEN KHAC ANH QUOC",
        "acqId" => "970422",
        "addInfo" => $customContent,
        "amount" => "99000",
        "format" => "json",
        "template" => "print"
    )),
    CURLOPT_HTTPHEADER => array(
        'x-client-id: 30b410ba-e3db-4196-8731-05b8b2d2e45b',
        'x-api-key: 5be36605-d62e-43b2-841e-4e4f2e871ef0',
        'Content-Type: application/json'
    )
));

// Thực hiện yêu cầu cURL và lấy kết quả
$response = curl_exec($curl);

// Đóng cURL session
curl_close($curl);

// Xử lý kết quả trả về
$data = json_decode($response, true); // Chuyển chuỗi JSON thành một mảng PHP
if ($data && isset($data['data']['qrDataURL'])) {
    $qrDataURL = $data['data']['qrDataURL']; // Lấy đường dẫn URL của hình ảnh mã QR
    echo '<img src="' . $qrDataURL . '" alt="VietQR">'; // Hiển thị hình ảnh mã QR trên trang web
}
?>
