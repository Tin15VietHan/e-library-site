<?php session_start(); ?>

<?php
// Kiểm tra xem người dùng đã đăng nhập chưa và có trạng thái là "PREMIUM" hay không
if(isset($_SESSION['account']) && $_SESSION['account']['trangthai'] === 'PREMIUM') {
    // Nếu có, chuyển hướng người dùng đến trang khác hoặc hiển thị thông báo
    echo "Bạn đã thanh toán thành công premium";
    exit(); // Dừng việc thực thi mã PHP
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Tạo mới đơn hàng</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap.min.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="assets/jumbotron-narrow.css" rel="stylesheet">  
        <script src="assets/jquery-1.11.3.min.js"></script>
    </head>

    <body>
        <?php require_once("./config.php"); ?>             
        <div class="container">
        <h3>Giao dịch thanh toán nâng cấp premium</h3>
            <div class="table-responsive">
                <form action="vnpay_create_payment.php" id="frmCreateOrder" method="post">        
                    <div class="form-group">
                        <label for="amount">Số tiền</label>
                        <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="amount" type="number" value="99999" Readonly/>
                    </div>
                     <h4>Chọn phương thức thanh toán</h4>
                    <div class="form-group">
                        <h5>Cách 1: Chuyển hướng sang Cổng VNPAY chọn phương thức thanh toán</h5>
                       <input type="radio" Checked="True" id="bankCode" name="bankCode" value="">
                       <label for="bankCode">Cổng thanh toán VNPAYQR</label><br>
                       
                       <h5>Cách 2: Tách phương thức tại site của đơn vị kết nối</h5>
                       <input type="radio" id="bankCode" name="bankCode" value="VNPAYQR">
                       <label for="bankCode">Thanh toán bằng ứng dụng hỗ trợ VNPAYQR</label><br>
                       
                       <input type="radio" id="bankCode" name="bankCode" value="VNBANK">
                       <label for="bankCode">Thanh toán qua thẻ ATM/Tài khoản nội địa</label><br>
                       
                       <input type="radio" id="bankCode" name="bankCode" value="INTCARD">
                       <label for="bankCode">Thanh toán qua thẻ quốc tế</label><br>
                       
                    </div>
                    <div class="form-group">
                        <h5>Chọn ngôn ngữ giao diện thanh toán:</h5>
                         <input type="radio" id="language" Checked="True" name="language" value="vn">
                         <label for="language">Tiếng việt</label><br>
                         <input type="radio" id="language" name="language" value="en">
                         <label for="language">Tiếng anh</label><br>
                         
                    </div>
                    <button type="submit" class="btn btn-default" href>Thanh toán</button>
                </form>
            </div>
            <p>
                &nbsp;
            </p>
        </div>  
        <section class="map mt-2">
              <div class="container-fluids p-0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4366.148442070775!2d105.67735815007774!3d18.7
                    06083332593316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3139ce1da2d94441%3A0x21f3b0f10d92f97b!2zVHLGsOG7nW
                    5nIENhbyDEkeG6s25nIEvhu7kgVGh14bqtdCBDw7RuZyBOZ2hp4buHcCBWaeG7h3QgTmFtIC0gSMOgbiBRdeG7kWM!5e0!3m2!1svi!2s!4v1709721577723!5m2!1svi!2s" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
              </div>
            </section><!-- End Map Section -->
            <footer>
              <div class="container"style="color: #fff;">
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
              footer{
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background-color: #106494; /* Màu nền footer */
                padding: 5px 0;
                text-align: center;
                color: #fff; /* Màu chữ trong footer */
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
    </body>
</html>

