<?php
require('./../connect.php'); ?>

<?php
    $id = $_GET['id'];
    
    // Truy vấn để lấy đường dẫn tới file PDF
$sql = "SELECT noidungdientu FROM sach WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$pdf_path = $row['noidungdientu'];


   $sqls = "DELETE FROM sach WHERE id= $id";
if (mysqli_query($conn, $sqls))
//Thông báo nếu thành công
{
    // Xóa file PDF từ máy chủ
    
        echo 'Xóa thành công';
        echo "<div id='countdown'></div>";
        echo "<a href='https://e-library.site/admin/ds_sach.php'></a>";
    }
      
   else
       //Hiện thông báo khi không thành công
       echo 'Không thành công. Lỗi' . mysqli_error($conn);
       
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
            window.location.href = "https://e-library.site/admin/ds_sach.php"; // Chuyển hướng về trang index.php

        }
    }, 1000); // Cập nhật mỗi 1 giây (1000 milliseconds)
</script>
