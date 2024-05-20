<!DOCTYPE html>
<html>
<head>
<title>Sửa Danh Mục</title>
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php

// Kết nối Database
require('layouts/header.php'); ?>
<?php
require('./../connect.php'); ?>

<?php
// Hàm xử lý dữ liệu đầu vào
function sanitize_input($data) {
    // Tạo bảng ánh xạ các ký tự có dấu sang các ký tự không dấu
    $charMap = array(
     'à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a',
     'è' => 'e', 'é' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e',
     'ì' => 'i', 'í' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
     'ò' => 'o', 'ó' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o',
     'ù' => 'u', 'ú' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
     'ỳ' => 'y', 'ý' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
     'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a',
     'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
     'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
     'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',
     'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
     'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
     'đ' => 'd',
 );
 
 // Loại bỏ các ký tự đặc biệt và chuyển đổi thành chữ thường
 $data = mb_strtolower($data, 'UTF-8');
 
 // Thực hiện ánh xạ các ký tự có dấu sang các ký tự không dấu
 $data = strtr($data, $charMap);
 
 // Thay dấu cách bằng gạch ngang
 $data = str_replace(' ', '-', $data);
     return $data;
 
 }

$id=$_GET['id'];
$query=mysqli_query($conn,"select * from `khoa` where id='$id'");
$row=mysqli_fetch_assoc($query);
?>
<div class="fix_form">
<form method="POST" class="form">
<h2>Sửa khoa</h2>
<label>Tên khoa: <input type="text" value="<?php echo $row['tenkhoa']; ?>" name="tenkhoa"></label><br/>
<label>Trạng thái:<select name="trangthai" class="trangthai" value="<?php echo $row['trangthai']; ?>" name="trangthai">
            <option value="ACTIVE">ACTIVE</option>
            <option value="INACTIVE">INACTIVE</option>
         </select></br> 
<div class="funtion">
        <ul>
           <li><input type="submit" name="update_categories" value="Update" class="update_categories" /></li>
        </ul>   
    </div>
</div>   

<?php require('layouts/footer.php'); ?>
<?php
if (isset($_POST['update_categories'])){
$id=$_GET['id'];
$name=$_POST['tenkhoa'];
$status=$_POST['trangthai'];


// Create connection
$conn = new mysqli("localhost", "id21773647_library", "", "id21773647_library");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `khoa` SET name='$name', status='$status',  updated_at = CURRENT_TIMESTAMP() WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
echo "Cập nhật thành công";
header("location: ds_danhmuc.php");
} else {
echo "Cập nhật thất bại: " . $conn->error;
}

$conn->close();
}
?>
</form>
</div>
</body>
</html>

<style>

.form h2{
    background-color: white;
 }

.fix_form{
    justify-content: center;
    margin-top: 10px;
    margin-bottom: 20px;
    margin-left: 250px;
}

.form{
 width: 900px;
 padding: 20px 20px 5px 20px;
 margin: 0 auto;
 font-weight: 700px;
 background-color: white;
}

.form label{
    background-color: white;
}

.form input{
 width:  900px;
 height: 35px;
 padding: 10px 0;
 margin: 10px 0;
 border-radius: 5px;
 background-color: white;
}

.role{
margin: 7px 27px;
width: 30%;
height: 30px;
border-radius: 5px;
background-color: white;

}

.role option{
background-color: white;    
}

.gender{
margin: 7px 10px;
width: 30%;
height: 30px;
border-radius: 5px;
background-color: white;

}

.status{
margin: 7px 5px;
width: 100px;
height: 30px;
border-radius: 5px;
background-color: white; 
}



.update_categories{
 height: 35px;
 padding: 10px 0;
 margin-top: 35px;
 border-radius: 5px;
 width: 150px;
 background-color: #007bff;
 color: #fff;
 border: 1px solid #fff;
 margin-left: 75px;
}

.funtion{
    background-color: white;
    margin-left: 150px;
}

.funtion ul{
    display: flex;
    list-style: none;
    background-color: white;
}

.funtion ul li{
    margin: 0 60px;
    background-color: white;
    
}

.funtion input{
    width: 300px;
    background-color: #003333;
    color: #fff;
    border: 1px solid #fff;
}

</style>
