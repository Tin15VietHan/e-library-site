<?php
require('./../connect.php');
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
    // Sau khi cập nhật, tiến hành xóa bản ghi trong bảng `categories`
    $sql_delete = "DELETE FROM docgia WHERE id='$id'";
    $result_delete = mysqli_query($conn, $sql_delete);
    if ($result_delete) {
        echo "Xoá thành công!";
        echo "<div id='countdown'></div>";
             echo "<a href='https://e-library.site/admin/ds_sinhvien.php'></a>";
    } else {
        echo "Error deleting category: " . mysqli_error($conn);
    }
} else {
    echo "Error updating posts: " . mysqli_error($conn);
}

$conn->close();
?>
<script>
    // Số giây để đếm ngược
    var seconds = 1;



    // Lấy phần tử có id="countdown" từ HTML
    var countdownElement = document.getElementById("countdown");

    // Đếm ngược và cập nhật giá trị trên trang
    var countdownInterval = setInterval(function() {
        seconds--;
        countdownElement.textContent = "Redirecting in " + seconds + " seconds...";

        // Nếu countdown kết thúc, chuyển hướng về trang index
        if (seconds <= 0) {
            clearInterval(countdownInterval); // Dừng đếm ngược
            window.location.href = "https://e-library.site/admin/ds_sinhvien.php"; // Chuyển hướng về trang index.php

        }
    }, 1000); // Cập nhật mỗi 1 giây (1000 milliseconds)
</script>
