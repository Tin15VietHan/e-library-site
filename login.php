<?php include_once('./master_layout/header.php') ?>
<?php
require('./connect.php');
$errors = []; // biến để lưu tất cả các lỗi ở server thực hiện và trả về cho người dùng (1 mảng)
$success = ""; // là 1 chuỗi thông báo thành công (1 chuỗi)
?>

<?php
if (isset($_SESSION['account'])) {
    header('Location: index.php');
}
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    /**
     * Tìm xem có tài khoản nào mà 
     *  + tên đăng nhập hoặc email trùng với thông tin username ở form 
     *  + mật khẩu trùng với password ở form
     * Không có thì thông báo lỗi, để nhập lại.
     * Nếu có thì lưu thông tin bằng session và load lại trang
     */
    $query = "SELECT *
    FROM accounts 
    WHERE (username = '{$username}' OR email = '{$username}') 
    AND password = '{$password}' ";

    $result = mysqli_query($conn, $query); // thực hiện lệnh sql => trả về 1 mảng (các bản ghi)
    // Đếm xem có bao nhiêu bản ghi thỏa mãn mãn câu sql. Nếu mà > 0 => thông báo
    if (mysqli_num_rows($result) > 0) { // mysqli_num_rows: kiểm tra (đếm) có bao nhiêu bản ghi (rows)
        // Đăng nhập thành công
        $account = $result->fetch_array(MYSQLI_ASSOC); //fetch_array đọc kết quả của result (tìm và trả về 1 dòng kết quả của câu truy vấn)
        $_SESSION['account'] = $account; // $_SESSION: biến toàn cục và là kiểu mảng
        header('Location: index.php');
    } else {
        // Đăng nhập thất bại
        $errors[] = "Thông tin đăng nhập chưa đúng. Vui lòng đăng nhập lại";
    }
}
?>

<!-- Giao diện đăng nhập -->
<div class="container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <div class="panel panel-defaul">
                <div class="panel-heading" style="background-color:#106494;color:#fff;text-align:center">
                    Đăng nhập
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

                    <form method="post" action="" onsubmit="return handeFormSubmit();" style="border-color:#106494">
                        <div class="form-group">
                            <label for="username">Email hoặc tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nhập Email hoặc tên đăng nhập">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                        </div>

                        <button type="submit" class="btn btn-primary mt-4" name='submit'>Đăng nhập</button>
                        <button type="button" class="btn btn-primary mt-4" style="margin-left: auto; margin-right:auto;"><a href="forget-password.php" style="color: #fff">Quên mật khẩu</a>
                            <br><button type="button" class="btn btn-primary mt-4" style="float: right"><a href="regisin.php" style="color: #fff;">Tạo tài khoản</a></button>
                    </form>

                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-5" style="height:100px; background-color: red;">

        </div> -->
    </div>
</div>

<?php include_once('./master_layout/footer.php') ?>
<style>
    body{
        background: aliceblue;
    }
</style>
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

