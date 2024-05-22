<?php
require('layouts/header.php'); ?>
<!DOCTYPE html>
<html>
<head>
<title>Sửa Danh Mục</title>
<link rel="stylesheet" href="style.css"/>
</head>
<body>

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

<div class="container">
    <div class="row">
        <div class="fix_form">
            <div class="card">
                <div class="card-header text-center" style="background-color:#106494;color:#fff;text-align:center">
                    <h4>Chỉnh Sửa Khoa</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="form" action="" onsubmit="return handeFormSubmit();">
                        <div class="form-group">
                            <label>Tên Khoa:</label><br/>
                            <input type=" text" value="<?php echo $row['tenkhoa']; ?>" name="tenkhoa">
                        </div>
                         <button class="btn btn-primary mt-4" class="update_khoa" type="submit" name="update_khoa"style="background-color: #106494;border-color:#106494;color: white;width: 200px;margin: 0 auto; display: block;">
                             Cập Nhật
                         </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-5" style="height:100px; background-color: red;">

        </div> -->
    </div>
</div>

<?php require('layouts/footer.php'); ?>
<?php
if (isset($_POST['update_khoa'])){
$id=$_GET['id'];
$name=$_POST['tenkhoa'];
// Create connection
$conn = new mysqli("localhost", "u395921506_thuvienviethan", "AnhquocQH@2002@", "u395921506_thuvienviethan");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `khoa` SET tenkhoa='$name' WHERE id='$id'";

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
    margin-top: 50px;
    margin-bottom: 530px;
    margin-left: 450px;
}

.form{
 width: 400px;
 padding: 20px 20px 10px 20px;
 margin: 0 auto;
 font-weight: 700px;
 background-color: white;
}

.form label{
    background-color: white;
}

.form input{
 width:  360px;
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
