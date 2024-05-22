<?php
require('./../connect.php');
if (isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
    $id = $_GET['id'];
    // Cập nhật các bản ghi trong bảng `posts` tham chiếu đến danh mục hiện tại thành giá trị mặc định
   // $sql_update_khoa = "UPDATE khoa SET id = 999 WHERE id= '$id'";
    //$result_update_khoa = mysqli_query($conn, $sql_update_khoa);
    //if ($result_update_khoa) {
        // Sau khi cập nhật, tiến hành xóa bản ghi trong bảng `categories`
        $sql_delete_category = "DELETE FROM khoa WHERE id='$id'";
        $result_delete_category = mysqli_query($conn, $sql_delete_category);

        if ($result_delete_category) {
            echo "Xoá thành công!";
            echo "<div id='countdown'></div>";
             echo "<a href='https://e-library.site/admin/ds_danhmuc.php'></a>";
        } else {
            echo "Error deleting category: " . mysqli_error($conn);
        }
    //} else {
      // echo "Error updating posts: " . mysqli_error($conn);
    //}
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
            window.location.href = "https://e-library.site/admin/ds_danhmuc.php"; // Chuyển hướng về trang index.php

        }
    }, 1000); // Cập nhật mỗi 1 giây (1000 milliseconds)
</script>
