<?php
require('layouts/header.php');
require('./../connect.php');

$errors = [];
$category_query = "SELECT name FROM categories";
$category_result = mysqli_query($conn, $category_query);
$categories = mysqli_fetch_all($category_result, MYSQLI_ASSOC);


if (isset($_POST['add'])) {
    $img = $_FILES['img']['name'];
    $masv = $_POST["masv"];
    $tensv = $_POST['tensv'];
    $matkhau = $_POST["matkhau"];
    $chucvu = $_POST["chucvu"];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $lop = $_POST['lop'];
    $khoa = $_POST['khoa'];
    $gvchunhiem = $_POST['gvchunhiem'];

   
    if (empty($img)) {
        $errors[] =  "Vui lòng chọn ảnh!";
    }
    if (empty($masv)) {
        $errors[] =  "Vui lòng nhập mã sinh viên!";
    } else {
        // Kiểm tra xem mã sinh viên đã tồn tại trong cơ sở dữ liệu chưa
        $check_query = "SELECT * FROM sinhvien WHERE masv = '$masv'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $errors[] = "Mã sinh viên đã tồn tại. Vui lòng nhập mã sinh viên khác!";
        }
    }
    if (empty($tensv)) {
        $errors[] =  "Vui lòng nhập tên sinh viên!";
    }
    if (empty($matkhau)) {
        $errors[] =  "Vui lòng nhập mk sinh viên!";
    }
    if (empty($chucvu)) {
        $errors[] =  "Vui lòng nhập chuc vu sinh viên!";
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
    if (empty($lop)) {
        $errors[] =  "Vui lòng nhập lớp!";
    }
    if (empty($khoa)) {
        $errors[] =  "Vui lòng nhập khoa!";
    }
    if (empty($gvchunhiem)) {
        $errors[] =  "Vui lòng nhập giáo viên chủ nhiệm!";
    }

    if (empty($errors)) {
        $file_tmp = $_FILES['img']['tmp_name'];
        $file_name = $_FILES['img']['name'];
        $upload_directory = "../Database/anh_bia/";

        if(move_uploaded_file($file_tmp, $upload_directory . $file_name)) {
            $url_anh = "https://dulieuappdoctruyen.000webhostapp.com/Database/anh_bia/" . $file_name;
            $sql = "INSERT INTO sinhvien(img, masv, tensv, matkhau, chucvu, gioitinh, ngaysinh, sdt, diachi, lop, khoa, gvchunhiem) VALUES('$url_anh', '$masv', '$tensv', '$matkhau', '$chucvu', '$gioitinh', '$ngaysinh', '$sdt', '$diachi', '$lop', '$khoa', '$gvchunhiem')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                header("location: ds_sinhvien.php");
                exit();
            } else {
                $errors[] = "Có lỗi xảy ra khi thêm sinh viên!";
            }
        } else {
            $errors[] = "Có lỗi xảy ra khi tải lên ảnh.";
        }
    }
}
?>

<div class="login_form">
    <form method="POST" action="" class="form" enctype="multipart/form-data">
        <h2>THÊM SINH VIÊN</h2>
        
        <label for="img">Ảnh</label>
        <input type="file" name="img" id="img" class="form-control" onchange="checkFileImage()">
        <div id="fileError" style="color: red;"></div>
        <img id="preview" src="#" alt="Ảnh sinh viên" style="display: none; width: 100px; 100height: px;">
                   
        <label>Mã SV</label><input type="text" name="masv" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['masv'])) : ?>
            <p class="errors">Vui lòng nhập mã sinh viên</p>
        <?php endif; ?>

        <label>Tên SV</label><input type="text" name="tensv" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['tensv'])) : ?>
            <p class="errors">Vui lòng nhập tên sinh viên</p>
        <?php endif; ?>
        <label>Mật khẩu</label><input type="text" name="matkhau" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['matkhau'])) : ?>
            <p class="errors">Vui lòng nhập mật khẩu</p>
        <?php endif; ?>
        <label>Chức vụ</label><input type="text" name="chucvu" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['chucvu'])) : ?>
            <p class="errors">Vui lòng nhập chức vụ</p>
        <?php endif; ?>

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

        <label>Lớp</label><input type="text" name="lop" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['lop'])) : ?>
            <p class="errors">Vui lòng nhập lớp</p>
        <?php endif; ?>

        <label>Khoa</label>
        <select name="khoa">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br />
        

        <label>Giáo Viên Chủ Nhiệm</label><input type="text" name="gvchunhiem" /><br />
        <?php if (isset($_POST['add']) && empty($_POST['gvchunhiem'])) : ?>
            <p class="errors">Vui lòng nhập giáo viên chủ nhiệm</p>
        <?php endif; ?>

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

<?php require('layouts/footer.php'); ?>



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