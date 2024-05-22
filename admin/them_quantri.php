<?php
require('layouts/header.php'); ?>
<?php
require('./../connect.php'); ?>
<?php
$errors = [];
if (isset($_POST['add'])) {
    $username = trim($_POST["username"]) ;
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);
    $fullname = trim($_POST['fullname']);
    $role = $_POST['role'];

    if ($username == "") {
        $errors[] =  "Vui lòng nhập tên tài khoản!";
    }
    if ($password == "") {
        $errors[] =  "Vui lòng nhập mật khẩu!";
    }
    if ($_POST["repassword"] != $_POST["password"]) {
        $errors[] =  "Mật khẩu không trùng khớp!";
    }
    if ($fullname == "") {
        $errors[] =  "Vui lòng nhập tên đầy đủ của bạn!";
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO `taikhoanadmin`(`hoten`, `username`, `password`, `quyen`) VALUES('$fullname', ' $username', '$password', '$role')";
        $query = mysqli_query($conn, $sql);
        header("location: ds_quantri.php");
    }
}
?>
<?php require('layouts/footer.php'); ?>
<div class="login_form">
    <form method="POST" action="" class="form">
        <h2>THÊM THÀNH VIÊN</h2>
        <label>Tên đăng nhập</label><input type="text" name="username" /><br />
        <div style="background-color: white;">
            <?php if (isset($_POST['add']) && empty($_POST['username'])) : ?>
                <p class="errors">Vui lòng nhập tên người dùng</p>
            <?php endif; ?>
        </div>

        <label>Mật khẩu</label><input type="text" name="password" /><br />
        <div style="background-color: white;">
            <?php if (isset($_POST['add']) && empty($_POST['password'])) : ?>
                <p class="errors">Vui lòng nhập mật khẩu</p>
            <?php endif; ?>
        </div><br />
        <label>Nhập lại mật khẩu</label><input type="text" name="repassword" /><br />
        <div style="background-color: white;">
            <?php
            if (isset($_POST['add']) && ($_POST["repassword"] != $_POST["password"])) {
                echo "<p class='errors'>Mật khẩu không trùng khớp!</p>";
            }
            ?>
        </div><br />
        <label>Tên đầy đủ</label><input type="text" name="fullname" /><br />
        <div style="background-color: white;">
            <?php
            if (isset($_POST['add']) && $fullname == "") {
                echo "<p class='errors'>Vui lòng nhập tên đầy đủ của bạn!</p>";
            }
            ?>
        </div><br />
        <label>Quyền</label> <select name="role" class="role">
            <option value="Admin">Admin</option>
            <option value="Manage">Manage</option>
        </select><br /><br />
        <div class="funtion">
            <ul>
                <li><input type="submit" name="add" value="Thêm" class="add" /></li>
            </ul>
        </div>
    </form>
</div>


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