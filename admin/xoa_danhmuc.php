<?php
require('./../connect.php');

if (isset($_REQUEST['id']) && $_REQUEST['id'] != "") {
    $id = $_GET['id'];

    // Cập nhật các bản ghi trong bảng `posts` tham chiếu đến danh mục hiện tại thành giá trị mặc định
    $sql_update_posts = "UPDATE posts SET category_id = 999 WHERE category_id = '$id'";
    $result_update_posts = mysqli_query($conn, $sql_update_posts);

    if ($result_update_posts) {
        // Sau khi cập nhật, tiến hành xóa bản ghi trong bảng `categories`
        $sql_delete_category = "DELETE FROM categories WHERE id='$id'";
        $result_delete_category = mysqli_query($conn, $sql_delete_category);

        if ($result_delete_category) {
            echo "Xoá thành công!";
        } else {
            echo "Error deleting category: " . mysqli_error($conn);
        }
    } else {
        echo "Error updating posts: " . mysqli_error($conn);
    }

    header("location: ds_danhmuc.php");
}

$conn->close();
?>
