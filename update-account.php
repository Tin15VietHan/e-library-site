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
if (isset($_POST['submit'])) {
  /**
   * isset là kiểm tra có tại tại biến không?
   * $_POST: phương thức post của form 
   * $_POST['submit']: lấy giá trị trong phương thức post của form với name là submit
   * $_POST['username']: lấy giá trị trong phương thức post của form với name là username
   */
}
?>

<!-- Giao diện đăng nhập -->
<div class="container">
  <div class="row">
    <div class="col col-md-6"  style="float: center;">
    <div class="loading-dots" style="float: center;">
      <h3 style="margin-top: 10px";>Đang đợi xử lý</h3>
  <div class="dot"></div>
  <div class="dot"></div>
  <div class="dot"></div>
</div>

      <!-- Hiện mã qr ở đây -->
      <!-- Hiển thị mã QR -->
      <div id="qr-container"></div>

      <!-- Kịch bản JavaScript -->
      <script>
        var customContent = "Hoi Vien <?php echo $_SESSION['account']['fullname']; ?>";
        // Gọi generate_qr.php để lấy mã QR
        fetch(`generate_qr.php?customContent=${customContent}`)
          .then(response => response.text())
          .then(qrData => {
            // Hiển thị mã QR trên trang web
            const qrContainer = document.getElementById('qr-container');
            qrContainer.innerHTML = qrData;
          })
          .catch(error => console.error('Error fetching QR code:', error));
      </script>
    </div>
  </div>
</div>

<!-- jQuery -->
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
<script src="./assets/js/change-password.js"></script>

<style>
  div .row{
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .loading-dots {
    display: flex;
    justify-content: center;
    align-items: center;
}

.dot {
  width: 10px;
  height: 10px;
  background-color: #333;
  border-radius: 50%;
  display: inline-block;
  margin: 0 5px;
  animation: moveRight 1.5s infinite alternate ease-in-out;
}

.dot:nth-child(2) {
  animation-delay: 0.25s;
}

.dot:nth-child(3) {
  animation-delay: 0.5s;
}

@keyframes moveRight {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(20px);
  }
}

</style>
