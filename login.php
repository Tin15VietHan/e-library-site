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
     * Nếu có thì lưu thông tin bằng session và load lại trangok nha
     */
    $query = "SELECT *
    FROM docgia 
    WHERE (username = '{$username}' OR madocgia = '{$username}') 
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
            <div class="panel panel-default">
               <div class="panel-heading" style="text-align: center; font-weight: 900; font-size: 30px; color: #106494; font-family: 'Verdana', sans-serif;">
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

                    <form method="post" action="" onsubmit="return handleFormSubmit();" style="">
                        <div class="form-group">
                            <label for="username" style="color: #106494;">Email hoặc tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nhập Email hoặc tên đăng nhập">
                        </div>
                        <div class="form-group">
                            <label for="password" style="color: #106494;">Mật khẩu</label>
                            
                                <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                                <div class="input-group-append">
                                    
                                    
                                <div class="input-group-text">
                                        <input type="checkbox" id="showPassword" style="padding-bottom: 20px;" onclick="togglePasswordVisibility()">
                                        <small><label for="showPassword" style="color: #106494;">Hiện mật khẩu</label></small>
                                    </div>
                                </div>                        
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-4" name="submit">Đăng nhập</button>
                        <div class="row mt-3">
                            <div class="col text-center">
                                <button type="button" class="btn btn-link btn-sm">
                                    <a href="forget-password.php" style="color: #106494; text-decoration: none;">Quên mật khẩu</a>
                                </button>
                                <button type="button" class="btn btn-link btn-sm">
                                    <a href="regisin.php" style="color: #106494; text-decoration: none;">Tạo tài khoản</a>
                                </button>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}
</script>


<?php include_once('./master_layout/footer.php') ?>
<style>
    body {
        background: aliceblue;
    }
    .panel-defaul{
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  width: 500px;
  padding: 20px;
  box-sizing: border-box;
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