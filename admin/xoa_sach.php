<?php
require('./../connect.php'); ?>

<?php
    $id = $_GET['id'];
    
    // Truy vấn để lấy đường dẫn tới file PDF
$sql = "SELECT contens FROM posts WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$pdf_path = $row['contens'];


   $sqls = "DELETE FROM posts WHERE id= $id";
if (mysqli_query($conn, $sqls))
//Thông báo nếu thành công
{
    // Xóa file PDF từ máy chủ
    if (unlink('https://dulieuappdoctruyen.000webhostapp.com/Database/pdf/b.pdf')) {
        echo 'Xóa thành công';
    } else {
        echo $pdf_path;
        echo 'Không thể xóa file PDF';
    }
        //echo '<script>window.history.back();</script>';
       }
   else
       //Hiện thông báo khi không thành công
       echo 'Không thành công. Lỗi' . mysqli_error($conn);
       
?>