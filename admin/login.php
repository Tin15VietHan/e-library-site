<?php
require('layouts/header.php'); ?>
<?php
require('./../connect.php');
$errors = []; // variable to store server-side errors and return to the user (an array)
$success = ""; // a string to display success messages

$username = "";
$idaccount = "";
?>

<?php
if (isset($_SESSION['account_admin'])) {
    header('Location: index.php'); // Redirect to a different page named index.php
}
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    /**
     * Check if there is an account with
     *  + username or email matching the username in the form
     *  + password matching the password in the form
     * If not, display an error message for re-entry.
     * If yes, save the information in session and reload the page
     */
    $query = "SELECT * FROM taikhoanadmin WHERE (username = '{$username}' AND password = '{$password}') ";
    $result = mysqli_query($conn, $query); // execute the sql command => return an array (records)
    // Count how many records match the sql query. If > 0 => success
    if (mysqli_num_rows($result) > 0) { // mysqli_num_rows: check (count) how many records (rows) there are
        // Successful login
        // $_SESSION: global variable and is an array
        //$row = mysqli_fetch_assoc($result);
        $account = $result->fetch_array(MYSQLI_ASSOC); //fetch_array reads the result of the query (finds and returns one row of the query result)
        $_SESSION['account_admin'] = $account; // $_SESSION: global variable and is an array
        $_SESSION['hoten'] = $account['hoten']; // $_SESSION: global variable and is an array
        $_SESSION['username'] = $account['username'];
        $_SESSION['id'] = $account['id'];
        $_SESSION['quyen'] = $account['quyen'];
        header('Location: index.php');
    } else {
        // Failed login
        $errors[] = "Thông tin đăng nhập chưa đúng. Vui lòng đăng nhập lại";
    }
}
?>

<div class="row g-0 min-vh-100">
    <div class="col-md-6 d-flex align-items-center bg-body-extra-light bg-white">
        <div class="p-3 w-100">
            <div class="mb-3 text-center" style="color: #0000FF;">
                <h1>E-LIBRARY</h1>
                <h2>VIỆT - HÀN</h2>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-sm-8 col-xl-6">
                    <?php if (count($errors) > 0) : ?>
                        <?php for ($i = 0; $i < count($errors); $i++) : ?>
                            <p class="errors" style="color: red;"> <?php echo $errors[$i]; ?> </p>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php if ($success) : ?>
                        <p class="success" style="color: green;"> <?php echo $success; ?> </p>
                    <?php endif; ?>
                    <form method="post" action="" onsubmit="return handeFormSubmit();">
                        <div class="py-3">
                            <div class="mb-4">
                                <input type="text" class="form-control form-control-lg form-control-alt" id="login-username" name="username" placeholder="Tài Khoản">
                            </div>
                            <div class="mb-4">
                                <input type="password" class="form-control form-control-lg form-control-alt" id="login-password" name="password" placeholder="Mật khẩu">
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn w-100 btn-lg btn-hero btn-primary" name='submit'>
                                <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Đăng nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex flex-column justify-content-between position-relative" style="background-image: url('https://img.upanh.tv/2024/05/23/snapedit_1716476085245.png'); background-size: cover; background-position: center;">
        <div class="color-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;  z-index: 1;"></div>
        <div class="container position-relative" style="z-index: 2;">
            <!-- Optional content here -->
        </div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="copyright" style="text-align: center; padding: 20px; color: white; border-radius: 10px; background-color: rgba(0, 0, 0, 0.7)">
                Bản quyền thuộc Trường Cao Đẳng Kỹ Thuật Công Nghiệp Việt Nam - Hàn Quốc
                <br>
                Địa chỉ: Đường Hồ Tông Thốc - TP.Vinh - Tỉnh Nghệ An
                <br>
                Số điện thoại: 02383.3511454 *** Fax: 038.852194
                <br>
                Website: www.vkc.edu.vn hoặc www.cdvhnghean.edu.vn
            </div>
        </div>
    </div>
</div>



<style>
  footer {
    position: relative;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #106494; /* Background color */
    color: #0000FF; /* Text color */
    padding: 5px 0; /* Padding top and bottom */
    text-align: center;
  }
  button {
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
