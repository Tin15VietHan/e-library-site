<?php
require('layouts/header.php');
require('./../connect.php');

$errors = [];
$category_query = "SELECT tenkhoa FROM khoa";
$category_result = mysqli_query($conn, $category_query);
$categories = mysqli_fetch_all($category_result, MYSQLI_ASSOC);


if (isset($_POST['add'])) {
    $madocgia = $_POST['madocgia'];
    $hoten = $_POST['hoten'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $khoa = $_POST['khoa'];
 
    if (empty($madocgia)) {
        $errors[] =  "Vui lòng nhập mã độc giả!";
    } else {
        // Kiểm tra xem mã sinh viên đã tồn tại trong cơ sở dữ liệu chưa
        $check_query = "SELECT * FROM docgia WHERE madocgia = '$madocgia'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $errors[] = "Mã độc giả đã tồn tại. Vui lòng nhập mã độc giả khác!";
        }
    }
    if (empty($hoten)) {
        $errors[] =  "Vui lòng nhập họ tên độc giả !";
    }
     if (empty($username)) {
        $errors[] =  "Vui lòng nhập username!";
    }
    if (empty($password)) {
        $errors[] =  "Vui lòng nhập mk độc giả!";
    }
    if (empty($gioitinh)) {
        $errors[] =  "Vui lòng chọn giới tính!";
    }
    if (empty($ngaysinh)) {
        $errors[] =  "Vui lòng nhập ngày sinh!";
    }
    if (empty($sdt)) {
        $errors[] =  "Vui lòng nhập số điện thoại!";
    }
    if (empty($diachi)) {
        $errors[] =  "Vui lòng nhập địa chỉ!";
    }
    if (empty($khoa)) {
        $errors[] =  "Vui lòng nhập khoa!";
    }

    
}
?>
<?php require('layouts/footer.php'); ?>
<div class="login_form">
    <form method="POST" action="" class="form" enctype="multipart/form-data">
        <h2>THÊM ĐỘC GIẢ</h2>
                   
        <label>Mã Độc Giả</label><input type="text" name="madocgia" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['madocgia'])) : ?>
            <p class="errors">Vui lòng nhập mã độc giả</p>
        <?php endif; ?>

        <label>Họ Tên Độc Giả</label><input type="text" name="hoten" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['hoten'])) : ?>
            <p class="errors">Vui lòng nhập tên độc giả</p>
        <?php endif; ?>
        <label>Username</label><input type="text" name="username" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['username'])) : ?>
            <p class="errors">Vui lòng nhập tên độc giả</p>
        <?php endif; ?>
        <label>Mật khẩu</label><input type="text" name="password" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['password'])) : ?>
            <p class="errors">Vui lòng nhập mật khẩu</p>
        <?php endif; ?>
        <br />
        <label>Giới tính</label>
        <select name="gioitinh" class="gioitinh">
            <option value="Nam" <?php if(isset($_POST['gioitinh']) && $_POST['gioitinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
            <option value="Nữ" <?php if(isset($_POST['gioitinh']) && $_POST['gioitinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
            <option value="Khác" <?php if(isset($_POST['gioitinh']) && $_POST['gioitinh'] == 'Khác') echo 'selected'; ?>>Khác</option>
        </select><br /><br />

        <label>Ngày sinh</label><input type="date" name="ngaysinh" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['ngaysinh'])) : ?>
            <p class="errors">Vui lòng nhập ngày sinh</p>
        <?php endif; ?>

        <label>Số Điện Thoại</label><input type="text" name="sdt" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['sdt'])) : ?>
            <p class="errors">Vui lòng nhập số điện thoại</p>
        <?php endif; ?>

        <label>Địa chỉ</label><input type="text" name="diachi" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['diachi'])) : ?>
            <p class="errors">Vui lòng nhập địa chỉ</p>
        <?php endif; ?>
        <br />
        <label>Khoa</label>
        <select name="khoa">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['tenkhoa']; ?>"><?php echo $category['tenkhoa']; ?></option>
            <?php endforeach; ?>
        </select>
        <br />
        <div class="funtion">
            <ul>
                <li><input type="submit" name="add" value="Thêm" class="add" /></li>
            </ul>
        </div>
    </form>
</div>

<script>
    function checkFileImage() {
        var fileInput = document.getElementById('img');
        var file = fileInput.files[0];
        var fileName = file.name;
        var fileExt = fileName.split('.').pop().toLowerCase();
        var allowedExtensions = ['jpg', 'png', 'jpeg', 'webp', 'gif', 'bmp', 'tiff'];

        if (!allowedExtensions.includes(fileExt)) {
            document.getElementById('fileError').innerHTML = "Chỉ được phép upload các file có định dạng JPG, PNG, JPEG, WEBP, GIF, BMP, TIFF.";
            fileInput.value = '';
            document.getElementById('preview').style.display = 'none';
            return false;
        } else {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview').style.display = 'block';
            }
            reader.readAsDataURL(file);
            document.getElementById('fileError').innerHTML = '';
            return true;
        }
    }
</script>





<style>
    .login_form {
        justify-content: center;
        margin-top: 10px;
        margin-bottom: 20px;
        margin-left: 250px;
    }

    .form h2 {
        background-color: white;
    }

    .form {
        width: 350px;
        border: 1px solid #007bff;
        padding: 20px;
        margin: auto;
        font-weight: 700px;
        background-color: white;
        margin-top: 0%;
    }

    .form label {
        background-color: white;
    }

    .form input {
        width: 100%;
        height: 35px;
        padding: 10px 0;
        margin: 10px 0;
        border-radius: 5px;
        background-color: white;
        justify-content: center;
    }

    .role {
        margin: 7px 27px;
        width: 30%;
        height: 30px;
        border-radius: 5px;
        background-color: white;

    }

    .role option {
        background-color: white;
    }

    .gender {
        margin: 7px 10px;
        width: 30%;
        height: 30px;
        border-radius: 5px;
        background-color: white;

    }

    .status {
        margin: 7px 5px;
        width: 30%;
        height: 30px;
        border-radius: 5px;
        background-color: white;
    }

    .status option {
        background-color: white;
    }

    .gender option {
        background-color: white;
    }

    .funtion {
        background-color: white;

    }

    .funtion ul {
        display: flex;
        justify-content: space-between;
        list-style: none;
        background-color: white;
        margin: 0 0px;

    }

    .funtion ul li {
        margin: 0 0x;
        background-color: white;



    }

    .funtion input {
        text-align: center;
        padding: 5px;
        width: 150px;
        background-color: #007bff;
        color: #fff;
        border: 1px solid #fff;
        margin-left: 35px;
    }
</style>


<style>
    .login_form {
        justify-content: center;
        margin-top: 10px;
        margin-bottom: 20px;
        margin-left: 250px;
    }

    .form h2 {
        background-color: white;
    }

    .form {
        width: 350px;
        border: 1px solid #007bff;
        padding: 20px;
        margin: auto;
        font-weight: 700px;
        background-color: white;
        margin-top: 0%;
    }

    .form label {
        background-color: white;
    }

    .form input {
        width: 100%;
        height: 35px;
        padding: 10px 0;
        margin: 10px 0;
        border-radius: 5px;
        background-color: white;
        justify-content: center;
    }

    .role {
        margin: 7px 27px;
        width: 30%;
        height: 30px;
        border-radius: 5px;
        background-color: white;

    }

    .role option {
        background-color: white;
    }

    .gender {
        margin: 7px 10px;
        width: 30%;
        height: 30px;
        border-radius: 5px;
        background-color: white;

    }

    .status {
        margin: 7px 5px;
        width: 30%;
        height: 30px;
        border-radius: 5px;
        background-color: white;
    }

    .status option {
        background-color: white;
    }

    .gender option {
        background-color: white;
    }

    .funtion {
        background-color: white;

    }

    .funtion ul {
        display: flex;
        justify-content: space-between;
        list-style: none;
        background-color: white;
        margin: 0 0px;

    }

    .funtion ul li {
        margin: 0 0x;
        background-color: white;



    }

    .funtion input {
        text-align: center;
        padding: 5px;
        width: 150px;
        background-color: #007bff;
        color: #fff;
        border: 1px solid #fff;
        margin-left: 35px;
    }
</style>