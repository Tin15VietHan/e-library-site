<?php
require('./../connect.php'); 

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

}?>

<?php
    $errors = [];
    if (isset($_POST['add'])) {
    $tenkhoa= $_POST['tenkhoa'];


    if ($tenkhoa == "") {
        $errors[] =  "Vui lòng nhập tên danh mục!";
    }

    // Kiểm tra xem tên danh mục đã tồn tại chưa
    $sql_check = "SELECT COUNT(*) AS count FROM khoa WHERE tenkhoa = '$tenkhoa'";
    $result_check = mysqli_query($conn, $sql_check);
    $row_check = mysqli_fetch_assoc($result_check);
    if ($row_check['count'] > 0) {
        $errors[] =  "Tên danh mục đã tồn tại!";
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO khoa (tenkhoa) VALUES('$tenkhoa')";
        $query = mysqli_query($conn, $sql);
        header("location: ds_danhmuc.php");
    }
}

?>

<div class="advertisement_form">
<form method="POST" action="" class="form">
    
    <h2>Thêm Danh Mục</h2>
    <ul style="background-color: white;">
        <?php foreach ($errors as $error) :?>
            <li style="color: red;background-color: white;"><?php echo $error; ?></li>
        <?php endforeach;?>
    </ul>
    <label>Tên danh muc</label><input type="text" name="tenkhoa" /><br /><br />
   
    <div class="funtion">
        <ul>
           <li><input type="submit" name="add" value="Thêm" class="add" /></li>
        </ul>   
    </div>
</form>
</div>  

<?php require('layouts/footer.php'); ?>

<style>
 
.advertisement_form{
    justify-content: center;
    margin-top: 10px;
    margin-bottom: 20px;
    margin-left: 250px;
}

.form h2{
    background-color: white;
 }

.form {
 width: 900px;
 padding: 20px 20px 5px 20px;
 margin: 0 auto;
 font-weight: 700px;
 background-color: white;

}

.form label{
    background-color: white;
}

.form input {
 width:  100%;
 height: 35px;
 padding: 10px 0;
 margin: 10px 0;
 border-radius: 5px;
 background-color: white;
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

.status{
margin: 7px 5px;
width: 100px;
height: 30px;
border-radius: 5px;
background-color: white; 
}

</style>
