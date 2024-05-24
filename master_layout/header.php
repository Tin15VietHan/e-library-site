<?php ob_start();  session_start(); ?>
<?php date_default_timezone_set('Asia/Ho_Chi_Minh');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8 without BOM">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thư Viện Điện Tử</title>
  <link rel="shortcut icon" href="./assets/images/logo_viethan.png" type="image/x-icon">
  <link rel="icon" href="./assets/images/logo_viethan.png" type="image/x-icon">
  <!-- bootstrap styles-->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- google font -->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>
  <!-- ionicons font -->
  <link href="./assets/css/ionicons.min.css" rel="stylesheet">
  <!-- animation styles -->
  <link rel="stylesheet" href="./assets/css/animate.css" />
  <!-- custom styles -->
    <link rel="stylesheet" href="stylese.css" />
  <link rel="stylesheet" href="./assets/css/stylee.css"   id="style">
  <!-- owl carousel styles-->
  <link rel="stylesheet" href="./assets/css/owl.carousel.css">
  <link rel="stylesheet" href="./assets/css/owl.transitions.css">
  <!-- magnific popup styles -->
  <link rel="stylesheet" href="./assets/css/magnific-popup.css">
  <link rel="stylesheet" href="./assets/css/switch.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.0/css/boxicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Reem+Kufi+Fun:wght@400..700&display=swap" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault();
        });
    </script>
    Content-Disposition: inline; filename="filename.pdf"
X-Content-Type-Options: nosniff
</head>

<body>
  <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0" nonce="dT0uS0Mq"></script>
  <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1280181819534389" crossorigin="anonymous"></script>
  <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-1280181819534389" data-ad-slot="8373286137" data-ad-format="auto" data-full-width-responsive="true"></ins>
  <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
  </script> -->
  <!-- preloader start -->
  <div id="preloader">
    <div id="status"></div>
  </div>
  <div class="wrapper">
    <!-- header toolbar start -->
    <div class="header-toolbar" style="background: #cccs;">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-uppercase">
            <div class="row align-items-center">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row  text-center">
                  <?php if (isset($_SESSION['account'])) : ?>
                    <marquee behavior="scroll" direction="left" scrollamount="10" style="font-size: 15px; color: #00f; font-family: 'Reem Kufi Fun', sans-serif;" ><?php echo 'Xin chào, ' . $_SESSION['account']['hoten'] . ' . Cảm ơn bạn đã truy cập trang web của chúng tôi !'; ?>.</marquee>
                  <?php else : ?>
                    <marquee behavior="scroll" direction="left" scrollamount="10" style="font-size: 15px; color: #106494; font-family: 'Reem Kufi Fun', sans-serif;" >Xin chào bạn đọc thân mến, Để nâng cao quyền riêng tư Vui lòng đăng nhập để đọc truyện.</marquee>
                  <?php endif; ?>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once(realpath(dirname(__FILE__) . "/menu.php")); ?>

  <!-- preloader end -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggleCheckbox = document.getElementById('toggleCheckbox');
      const body = document.body; // Thay body bằng phần tử chứa nội dung trang của bạn nếu cần

      toggleCheckbox.addEventListener('change', function() {
        if (toggleCheckbox.checked) {
          // Chuyển sang chế độ tối
          body.classList.add('dark-mode'); // Thêm lớp CSS dark-mode
        } else {
          // Chuyển sang chế độ sáng
          body.classList.remove('dark-mode'); // Xóa lớp CSS dark-mode
        }
      });
    });
  </script>



  <style>
    a {
      color: #000000;
    }

    body {
      margin: 0;
      height: 100%;
      transition: background-color .25s;
      color: #ccc;
      background-size: 300% 300%;
      background-position: top left;
      transition: background-position .6s;
      
    }

    /* Điều chỉnh kích thước và vị trí của nút toggle */
    .iput {
      visibility: hidden;
    }

    .lab {
      display: block;
      height: 100%;
      width: 2.75em;
      font-size: 1.7rem;
      border: .125em solid currentColor;
      border-radius: 2em;
      -webkit-tap-highlight-color: transparent;
      cursor: pointer;
      position: relative;
      position: absolute;
      top: 0em;
      right: 1em;
    }

    /* Rest of the CSS remains the same */
    .lab::before,
    .lab::after {
      content: '';
      display: block;
      border-radius: 1em;
      position: absolute;
      z-index: 1;
    }

    .lab::after {
      width: 1em;
      height: 1em;
      box-shadow: .25em .25em #000000;
      right: .4em;
      top: -.3em;
    }

    .lab::before {
      width: .225em;
      height: .225em;
      background-color: #ffc409;
      outline: .19em dotted #ffc409;
      outline-offset: .125em;
      left: .5em;
      top: .4em;
    }

    .spans {
      display: block;
      width: 1em;
      height: 1em;
      background-color: currentColor;
      border-radius: 2em;
      top: .0em;
      left: .13em;
      overflow: hidden;
      position: absolute;
      text-indent: -9999px;
      transition: left .25s;
      z-index: 2;
    }

    .iput:checked~label span {
      left: 1.4em;
    }

    body:has(.iput:checked) {
      background-position: 100% 100%;
      color: #fff;

    }

    .iput:checked a {
      color: white;
    }

    @media (max-width: 767px) {
      .header-toolbar {
        display: none;
      }

    }
  </style>