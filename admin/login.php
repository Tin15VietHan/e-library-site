<?php
require('layouts/header.php'); ?>
<?php
require('./../connect.php');
$errors = []; // biến để lưu tất cả các lỗi ở server thực hiện và trả về cho người dùng (1 mảng)
$success = ""; // là 1 chuỗi thông báo thành công (1 chuỗi)

$fullname = "";
$username = "";
$idaccount = "";
?>

<?php
if (isset($_SESSION['account_admin'])) {
    header('Location: index.php'); // Chuyển đến một trang khác có tên là index.php
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
    $query = "SELECT id, username, email, fullname, gender, phone, birthday FROM taikhoanadmin WHERE (username = '{$username}' OR email = '{$username}') AND password = '{$password}' AND status = 'ACTIVE' OR status = 'PREMIUM' AND role = 'admin' OR role = 'manage'";
    $result = mysqli_query($conn, $query); // thực hiện lệnh sql => trả về 1 mảng (các bản ghi)
    // Đếm xem có bao nhiêu bản ghi thỏa mãn mãn câu sql. Nếu mà > 0 => thông báo
    if (mysqli_num_rows($result) > 0) { // mysqli_num_rows: kiểm tra (đếm) có bao nhiêu bản ghi (rows)
        // Đăng nhập thành công
        // $_SESSION: biến toàn cục và là kiểu mảng
        //$row = mysqli_fetch_assoc($result);
        $account = $result->fetch_array(MYSQLI_ASSOC); //fetch_array đọc kết quả của result (tìm và trả về 1 dòng kết quả của câu truy vấn)
        $_SESSION['account_admin'] = $account; // $_SESSION: biến toàn cục và là kiểu mảng
        $_SESSION['fullname'] = $account['fullname']; // $_SESSION: biến toàn cục và là kiểu mảng
        $_SESSION['username'] = $account['username']; // $_SESSION: biến toàn cục và là kiểu mảng
        $_SESSION['id'] = $account['id'];
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
        <div class="col col-md-6 offset-md-3" style="padding-top:50px">
            <div class="card">
                <div class="card-header text-center" style="background-color:#106494;color:#fff;text-align:center">
                    Đăng nhập
                </div>
                <div class="card-body">
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
                            <label for="username">Email hoặc tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nhập Email hoặc tên đăng nhập">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                        </div>

                        <button type="submit" class="btn btn-primary mt-4" name='submit'style="
                         background-color: #106494;border-color:#106494">Đăng nhập</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-5" style="height:100px; background-color: red;">

        </div> -->
    </div>
</div>
</br>
<section class="map mt-2">
  <div class="container-fluids p-0">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4366.148442070775!2d105.67735815007774!3d18.7
        06083332593316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3139ce1da2d94441%3A0x21f3b0f10d92f97b!2zVHLGsOG7nW
        5nIENhbyDEkeG6s25nIEvhu7kgVGh14bqtdCBDw7RuZyBOZ2hp4buHcCBWaeG7h3QgTmFtIC0gSMOgbiBRdeG7kWM!5e0!3m2!1svi!2s!4v1709721577723!5m2!1svi!2s" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
  </div>
</section>
<footer>
  <div class="container" style="color: #fff;">
    <div class="copyright">
     Bản quyền thuộc Trường Cao Đẳng Kỹ Thuật Công Nghiệp Việt Nam - Hàn Quốc
    <br>
     Địa chỉ: Đường Hồ Tông Thốc  - TP.Vinh - Tỉnh Nghệ An
     <br>
     Số điện thoại: 02383.3511454 *** Fax: 038.852194
     <br>
     Website: www.vkc.edu.vn hoặc www.cdvhnghean.edu.vn
    </div>
  </div>
</footer>
<style>
  footer {
  position: relative;
  bottom: 0;
  left: 0;
  width: 100%;
  background-color: #106494; /* Màu nền */
  color: #fff; /* Màu chữ */
  padding: 5px 0; /* Khoảng cách giữa nội dung và lề trên dưới */
  text-align: center;
}
 button{
     background-color:#106494;
 }
 .map {
    padding: 0;
    margin-bottom: -12px;
  }
  .map iframe {
    width: 100%;
    height: 300px;
  }

  .copyright {
    text-align: center;
    padding-top: 20px;
    padding-bottom: 20px;
  }

  /* CSS for the back-to-top button */
  .back-to-top {
    position: fixed;
    right: 15px;
  bottom: 15px;
    z-index: 99999;
    display: none;
    background: #68A4C4;
  width: 40px;
  height: 40px;
    color: #fff;
    padding: 10px;
    border-radius: 4px;
    text-align: center;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
  }

  .back-to-top i {
    font-size: 20px;
  color: #fff;
  line-height: 0px;
  }
</style>
<?php
require('layouts/footer.php'); ?>