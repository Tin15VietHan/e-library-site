<?php
require('layouts/header.php'); ?>
<?php
require('./../connect.php'); ?>

<?php
$id=$_GET['id'];
$query=mysqli_query($conn,"select * from `docgia` where id='$id'");
$row=mysqli_fetch_assoc($query);
?>

<div class="container">
    <div class="row">
        <div class="fix_form">
            <div class="card">
                <div class="card-header text-center" style="background-color:#106494;color:#fff;text-align:center">
                    <h5>Sửa Độc Giả</h5>
                </div>
                <div class="card-body">
                    <form method="post" class="form" action="" onsubmit="return handeFormSubmit();">
                        <div class="form-group">
                            <label>Mã độc giả: <input type="text" value="<?php echo $row['madocgia']; ?>" name="madocgia"></label><br/>
                            <label>Họ tên: <input type="text" value="<?php echo $row['hoten']; ?>" name="hoten"></label><br/>
                            <label>Tên tài khoản: <input type="text" value="<?php echo $row['username']; ?>" name="username"></label><br/>
                            <label>Mật khẩu: <input type="text" value="<?php echo $row['password']; ?>" name="password"></label><br/>
                            <label>Giới tính:<select name="gender" class="gender" value="<?php echo $row['gioitinh']; ?>" name="gioitinh" >
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                        <option value="Khác">Khác</option>
                                       </select></br>
                            <label>Ngày sinh: <input type="date" value="<?php echo $row['ngaysinh']; ?>" name="ngaysinh"></label><br/>
                            <label>Số điện thoại: <input type="number" value="<?php echo $row['sdt']; ?>" name="sdt"></label><br/>
                            <label>Địa chỉ: <input type="text" value="<?php echo $row['diachi']; ?>" name="diachi"></label><br/>
                            <label>Khoa: <input type="text" value="<?php echo $row['khoaID']; ?>" name="khoaID"></label><br/>
                        </div>
                         <button class="btn btn-primary mt-4" class="update_khoa" type="submit" name="update_user"style="background-color: #106494;border-color:#106494;color: white;width: 200px;margin: 0 auto; display: block;">
                             Cập Nhật
                         </button>
                    </form>
                </div>
            </div>
        </div>
<?php
if (isset($_POST['update_user'])){
$id=$_GET['id'];
$madocgia=$_POST['madocgia'];
$hoten=$_POST['hoten'];
$username=$_POST['username'];
$password=$_POST['password'];
$gioitinh=$_POST['gioitinh'];
$ngaysinh=$_POST['ngaysinh'];
$sdt=$_POST['sdt'];
$diachi=$_POST['diachi'];
$khoaID=$_POST['khoaID'];


// Create connection
$conn = new mysqli("localhost", "u395921506_thuvienviethan", "AnhquocQH@2002@", "u395921506_thuvienviethan");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `docgia` SET madocgia='$madocgia', hoten='$hoten', username='$username', password='$password', gioitinh='$gioitinh', ngaysinh='$ngaysinh', sdt='$sdt', diachi='$diachi', khoaID='$khoaID' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
echo "Cập nhật thành công";
header("location: ds_docgia.php");
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

<?php require('layouts/footer.php'); ?>

<style>




.fix_form{
    justify-content: center;
    padding-top: 15px;
    padding-bottom: 20px;
    margin-left: 500px;
}

.form {
 width: 350px;
 padding: 20px;
 margin: 0 auto;
 font-weight: 700px;
 background-color: white;
 margin-top: 0%;
}

.form label{
    background-color: white;
}

label input {
 width: 300px;
 height: 35px;
 padding: 10px 0;
 margin: 10px 0;
 border-radius: 5px;
 background-color: white;
}

.role{
margin: 7px 32px;
width: 100px;
height: 30px;
border-radius: 5px;
background-color: white;

}

.role option{
background-color: white;    
}

.gender{
margin: 7px 15px;
width: 100px;
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

.status option{
    background-color: white;
}

.gender option{
background-color: white;
}

.update_user{
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

</style>
