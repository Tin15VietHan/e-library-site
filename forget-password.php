<?php include_once('./master_layout/header.php') ?>
<?php
if (isset($_SESSION['account'])) {
    header('Location: index.php');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require('connect.php');
$errors = []; // biến để lưu tất cả các lỗi ở server thực hiện và trả về cho người dùng (1 mảng)
$success = ""; // là 1 chuỗi thông báo thành công (1 chuỗi)
date_default_timezone_set("Asia/Ho_Chi_Minh"); // xét timezone (múi giờ)

function generateRandomString($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}


if (isset($_POST['submit'])) {
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    /**
     * Kiểm tra xem trong bảng taikhoanadmin có tồn tại bản ghi nào với email và username trùng với thông tin ở form không
     * Nếu không thỏa mãn thì thông báo không tồn tại tài khoản
     * Nếu thoả mãn thì mình đổi mật khẩu ngẫu nhiên và gửi mail lại kho người dùng
     */
    $query = "SELECT * FROM docgia where email = '{$email}' AND username = '{$username}'";
    $result = mysqli_query($conn, $query); // thực hiện lệnh sql => trả về 1 mảng (các bản ghi)
    // Đếm xem có bao nhiêu bản ghi thỏa mãn mãn câu sql. Nếu mà > 0 => thông báo
    if (mysqli_num_rows($result) == 0) { // mysqli_num_rows: kiểm tra (đếm) có bao nhiêu bản ghi (rows)
        // Thông báo 
        $errors[] = "Không tồn tại tài khoản cần tìm";
    } else {
        // Gửi email thông báo
        $dt = date("Y-m-d H:i:s");
        $password = generateRandomString(7);
        $query = "UPDATE docgia SET password = '{$password}' where email = '{$email}' AND username = '{$username}'";
        if (mysqli_query($conn, $query)) {
            // Gửi thông báo về email
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';

            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'laylaimatkhau@e-library.site';                     //SMTP username
            $mail->Password   = 'AnhquocQH@2002@';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //Recipients
            $mail->setFrom('laylaimatkhau@e-library.site', 'laylaimatkhau@e-library.site');
            $mail->addAddress($email, '');
            // Content
            $mail->isHTML(true);   // Set email format to HTML
            $mail->Subject = 'Cấp lại mật khẩu';
            $mail->Body = "Mật khẩu mới của bạn là: <b>'{$password}'</b>";

            $mail->send();
            $success = "Mật khẩu đã được thay đổi và gửi vào email {$email} của bạn";
        } else {
            $errors[] = "ĐỔi mật khẩu thất bại: " . mysqli_error($conn); // mysqli_error: là cú pháp hiện lỗi của mysqli
        }
    }
}
?>



<!-- Giao diện đăng nhập -->
<div class="container">
    <div class="row">
        <div class="col col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center; font-weight: 900; font-size: 30px; color: #106494; font-family: 'Verdana', sans-serif;">
                 Quên Mật Khẩu
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
                    <form method="POST" action="" onsubmit="return handeFormSubmit();">
                        <div class="form-group">
                            <label for="email" style="color: #106494;">Email </label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Nhập Email">
                        </div>
                        <div class="form-group">
                            <label for="username" style="color: #106494;">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nhập tên">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-4" name="submit">Cấp Lại Mật Khẩu</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-md-5" style="height:100px; background-color: red;">

        </div> -->
    </div>
</div>

<?php include_once('./master_layout/footer.php') ?>
<script src="./assets/js/forget-password.js"></script>