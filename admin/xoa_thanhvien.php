<?php
require('./../connect.php');
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];

 // Cập nhật các bản ghi trong bảng `posts` tham chiếu đến danh mục hiện tại thành giá trị mặc định
 $sql_update_posts = "UPDATE posts SET accounts_id = 0 WHERE accounts_id = '$id'";
 $result_update_posts = mysqli_query($conn, $sql_update_posts);

 if ($result_update_posts) {
    // Sau khi cập nhật, tiến hành xóa bản ghi trong bảng `categories`
    $sql_delete = "DELETE FROM accounts WHERE id='$id'";
    $result_delete = mysqli_query($conn, $sql_delete);

    if ($result_delete) {
        echo "Xoá thành công!";
    } else {
        echo "Error deleting category: " . mysqli_error($conn);
    }
} else {
    echo "Error updating posts: " . mysqli_error($conn);
}

header("location: ds_thanhvien.php");
}

$conn->close();
?>