<?php
require('./../connect.php');

$response = array('success' => false);

if (isset($_POST['madocgia'])) {
    $madocgia = mysqli_real_escape_string($conn, $_POST['madocgia']);
    $query = "SELECT hoten, sdt, diachi FROM docgia WHERE madocgia = '$madocgia' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $response['success'] = true;
        $response['data'] = $data;
    }
}

mysqli_close($conn);
echo json_encode($response);
?>
