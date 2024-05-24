<?php include_once('./master_layout/header.php') ?>
<?php
if (!isset($_SESSION['account'])) {
    header('Location: login.php');
}
require('./connect.php');
$errors = []; // biến để lưu tất cả các lỗi ở server thực hiện và trả về cho người dùng (1 mảng)
$success = ""; // là 1 chuỗi thông báo thành công (1 chuỗi)
date_default_timezone_set("Asia/Ho_Chi_Minh"); // xét timezone (múi giờ)

$account = $_SESSION['account'];
$fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : trim($account['hoten']);
$gender = isset($_POST['gender']) ? trim($_POST['gender']) : trim($account['gioitinh']);
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : trim($account['sdt']);
$birthday = isset($_POST['birthday']) ? trim($_POST['birthday']) : trim($account['ngaysinh']);

if (isset($_POST['delete'])) {
    // Gọi hàm xóa tài khoản
    $query = "DELETE FROM docgia WHERE id = '{$account['id']}'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        /**
         * Xóa thành công thì phải đăng xuất => Xóa $_SESSION
         * Chuyển về trang index.php và hiện thông báo
         */
        // Xóa session 
        session_destroy();
        // Phải thông báo
        header("Location:index.php");
        // ina mã js
        echo '<script language="javascript">';
        echo 'alert(Bạn đã xóa tài khoản thành công)';  //not showing an alert box.
        echo '</script>';
    } else {
        $errors[] = "Xóa tài khoản thất bại: " . mysqli_error($conn); // mysqli_error: là cú pháp hiện lỗi của mysqli
    }
}

if (isset($_POST['submit'])) {
    /**
     * isset là kiểm tra có tại tại biến không?
     * $_POST: phương thức post của form 
     * $_POST['submit']: lấy giá trị trong phương thức post của form với name là submit
     * $_POST['username']: lấy giá trị trong phương thức post của form với name là username
     */
    $query = "UPDATE docgia SET `hoten` = '{$fullname}', `gioitinh` = '{$gender}', `sdt` = '{$phone}', `ngaysinh` = '{$birthday}' WHERE id = '{$account['id']}'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $query = "SELECT * FROM docgia WHERE id = '{$account['id']}'";
        $result = mysqli_query($conn, $query);
        $account = $result->fetch_array(MYSQLI_ASSOC);
        $_SESSION['account'] = $account;
        $success = "Sửa tài khoản thành công";
    } else {
        $errors[] = "Sửa tài khoản thất bại: " . mysqli_error($conn); // mysqli_error: là cú pháp hiện lỗi của mysqli
    }
}

?>
<!-- Giao diện đăng nhập -->
<div class="container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sửa thông tin tài khoản <?php echo $account['id'] ?>
                </div>
                <div class="panel-body">
                    <?php if (count($errors) > 0) : ?>
                        <?php for ($i = 0; $i < count($errors); $i++) : ?>
                            <p class="errors" style="color: red;"> <?php echo $errors[$i]; ?> </p>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php if ($success) : ?>
                        <p class="success" style="color: green;"> <?php echo $success; ?> </p>
                    <?php endif; ?>
                    <form method="post" action="" onsubmit="return handeFormSubmit();">
                        <div class="form-group">
                            <label for="fullname">Tên đầy đủ</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nhập tên đầy đủ" value="<?php echo $fullname ?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">Giới tính</label>
                            <div class="radio-inline" for="male">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="NAM" <?php if ($gender == 'NAM') echo 'checked'; ?>>
                                Nam

                            </div>
                            <div class="radio-inline" for="female">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="NU" <?php if ($gender == 'NU') echo 'checked'; ?>>
                                Nữ
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" min="10" max="10" class="form-control" name="phone" id="phone" placeholder="Nhập số điện thoại" value=<?php echo $phone ?> />
                        </div>
                        <div class="form-group">
                            <label for="birthday">Ngày sinh</label>
                            <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Nhập ngày sinh" value=<?php echo $birthday ?> />
                        </div>
                         <div class="d-grid gap-2">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary mt-4 " name="submit">Sửa thông tin</button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary mt-4">
                                    <a href="change-password.php" style="color: #fff">Đổi mật khẩu</a>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" onclick="return handeSubmitDelete()" name="delete" class="btn btn-danger mt-4">Xóa tài khoản</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-5" style="height:100px; background-color: red;">

        </div> -->
    </div>
</div>

<?php include_once('./master_layout/footer.php') ?>
<script src="./assets/js/edit-account.js"></script>
<script src="./assets/js/login.js"></script>
<script src="./assets/js/jquery.min.js"></script> 
<!--jQuery easing--> 
<script src="./assets/js/jquery.easing.1.3.js"></script> 
<!-- bootstrab js --> 
<script src="./assets/js/bootstrap.js"></script> 
<!--style switcher--> 
<script src="./assets/js/style-switcher.js"></script> <!--wow animation--> 
<script src="./assets/js/wow.min.js"></script> 
<!-- time and date --> 
<script src="./assets/js/moment.min.js"></script> 
<!--news ticker--> 
<script src="./assets/js/jquery.ticker.js"></script> 
<!-- owl carousel --> 
<script src="./assets/js/owl.carousel.js"></script> 
<!-- magnific popup --> 
<script src="./assets/js/jquery.magnific-popup.js"></script> 
<!-- weather --> 
<script src="./assets/js/jquery.simpleWeather.min.js"></script> 
<!-- calendar--> 
<script src="./assets/js/jquery.pickmeup.js"></script> 
<!-- go to top --> 
<script src="./assets/js/jquery.scrollUp.js"></script> 
<!-- scroll bar --> 
<script src="./assets/js/jquery.nicescroll.js"></script> 
<script src="./assets/js/jquery.nicescroll.plus.js"></script> 
<!--masonry--> 
<script src="./assets/js/masonry.pkgd.js"></script> 
<!--media queries to js--> 
<script src="./assets/js/enquire.js"></script> 
<!--custom functions--> 
<script src="./assets/js/custom-fun.js"></script>