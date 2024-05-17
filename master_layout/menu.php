<?php
require('./connect.php');
?>
<nav class="navbar navbar-inverse"style="background-color: #106494; border-color:#106494">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="container mt-3">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><strong style="color: #fff">E-LIBRARY</strong></a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active theloaikhoi dropdown"><a href='#' class='dropdown-toggle' data-toggle='dropdown' style="color: #fff;" <?php if (!isset($_SESSION['account'])) : echo "onclick='showAlerts(event);'";  endif; ?>>Khoa Sách<span class='caret'></span></a>
              <ul class="dropdown-menu" <?php if (!isset($_SESSION['account'])) : echo "onclick='showAlerts(event);'";  endif; ?>>
                <?php
                $sql = "SELECT * FROM khoa ORDER BY id ASC";
                $result = mysqli_query($conn, $sql);
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                  $id = $row['id'];
                  $name = $row['tenkhoa'];
                    echo "<li><a href ='section-topic-details.php?id=$id' style='overflow: hidden;text-overflow: ellipsis; width: 220px' title='$name'>$name</a></li>";
                }
                ?>
              </ul>
            </li>
            <li class="theloaikhoi dropdown"><a href='#' class='dropdown-toggle' data-toggle='dropdown' style="color: #fff; "  <?php if (!isset($_SESSION['account'])) : echo "onclick='showAlerts(event);'";  endif; ?> >Mới nhất<span class='caret'></span></a>
              <ul class="dropdown-menu"  <?php if (!isset($_SESSION['account'])) : echo "onclick='showAlerts(event);'" ; echo "disabled";  endif; ?>>
                <?php
                $sql = "SELECT * FROM sach ORDER BY id DESC LIMIT 7";
                $result = mysqli_query($conn, $sql);
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                  $idtin = $row['id'];
                  $tensach = $row['tensach'];
                  $khoaID = $row['khoaID'];
                    echo "<li><a href ='post-item-details.php?id=$idtin&khoaID=$khoaID' style='overflow: hidden;text-overflow: ellipsis; width: 220px' title='$tensach'>$tensach</a></li>";
                }
                ?>
              </ul>
            </li>
            <li class="theloaikhoi dropdown"<?php if (!isset($_SESSION['account'])) : echo "onclick='showAlerts(event);'";  endif; ?>><a href='#' class='dropdown-toggle' data-toggle='dropdown' style="color: #fff;">Xem nhiều nhất<span class='caret'></span></a>
              <ul class="dropdown-menu"<?php if (!isset($_SESSION['account'])) : echo "onclick='showAlerts(event);'";  endif; ?>>
                <?php
                $sql = "SELECT * FROM sach ORDER BY luotxem DESC LIMIT 9";
                $result = mysqli_query($conn, $sql);
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                  $idtin = $row['id'];
                  $tensach = $row['tensach'];
                  $khoaID = $row['khoaID'];
                  $count++;
                  if ($count <= 7) {
                    echo "<li><a href ='post-item-details.php?id=$idtin&khoaID=$khoaID' style='overflow: hidden;text-overflow: ellipsis; width: 220px' title='$tensach'>$tensach</a></li>";
                  } else {
                    break;
                  }
                }
                ?>
              </ul>
            </li>

          </ul>
          <form class="navbar-form navbar-left" action="search-result-found.php" method="GET" role="search">
            <div class="input-group">
              <input type="text" class="form-control" style="width: 240px;" placeholder="Tìm kiếm" name="txtsearch" id="search-input">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </div>
              <ul id="search-suggestions"></ul>
            </div>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <?php if (!isset($_SESSION['account'])) : ?>
              <li style="color: #fff;"><a href="admin/login.php" data-effect="mfp-zoom-in"><span class="glyphicon glyphicon-cog"></span> ADMIN</a></li>
              <li style="color: #fff;"><a href="regisin.php" data-effect="mfp-zoom-in"><span class="glyphicon glyphicon-user"></span> SIGN UP</a></li>
              <li style="color: #fff;"><a href="login.php" data-effect="mfp-zoom-in"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['account'])) : ?>
              <?php if  ($_SESSION['account']['trangthai'] === 'PREMIUM') { echo" <li style='color: #fff;'><a href='' data-effect='mfp-zoom-in'><span class='glyphicon glyphicon-circle-arrow-up'></span>".$_SESSION['account']['trangthai']. "</a></li> " ;} 
              else{  echo" <li style='color: #fff;'><a href='ApiVnpay/vnpay_pay.php' data-effect='mfp-zoom-in'><span class='glyphicon glyphicon-circle-arrow-up'></span>GO PREMIUM</a></li> ";}?>
              <li style="color: #fff;"><a href="edit-account.php" data-effect="mfp-zoom-in" style="padding-left: 0px;"><span class="glyphicon glyphicon-user"></span> ACCOUNT</a></li>
              <li style="color: #fff;"><a href="logout.php" data-effect="mfp-zoom-in"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
            <?php endif; ?>


          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="sticky-header">
  <!-- header start -->
  <!-- <div class="container header">
      <div class="row">
        <div class="col-sm-16 col-md-16 wow fadeInUpLeft animated"><img src="./assets/images/Logo.png" alt="" style="width: 100%; height: 100%; object-fit: cover";/></div>
      </div>
    </div> -->
  <!-- header end -->

  <!-- search start -->

  <div class="search-container ">
    <div class="container">
      <form action="search-result-found.php" method="GET" role="search">
        <input id="search-bar" placeholder="Nhập từ khóa..." name="txtsearch" autocomplete="off" style="visibility: visible;">
      </form>
    </div>
  </div>
  <!-- search end -->
  </nav>
  <!--nav end-->
</div>
<!-- nav and search end-->
</div>
<style>
  ul .dropdown-menu{
  column-count: 3; /* Số cột bạn muốn hiển thị */
  column-gap: 0px; /* Khoảng cách giữa các cột */
}

  #search-suggestions {
  display: none;
  position: fixed; /* Đặt phần tử ở vị trí cố định trên trang */
  top: 50px; /* Điều chỉnh vị trí top tùy theo vị trí của phần tử mà bạn muốn hiển thị đè lên */
  left: 0; /* Đặt vị trí bắt đầu từ cạnh trái của trang */
  background-color: #fff;
  border: 1px solid #ccc;
  padding: 5px;
  width: 200px;
  z-index: 9999; /* Đảm bảo phần tử nằm trên tất cả các phần tử khác */
}


  .texttimkiem {
    width: 270px;
  }

  @media (max-width: 767px) {
    .navbar-nav.navbar-right {
      display: flex;
      flex-direction: row;
      align-items: center;
    }

    .navbar-nav.navbar-right li {
      /* margin-left: 10px; */
      /* Khoảng cách giữa các phần tử */
    }

    .navbar-nav.navbar-right li:first-child {
      margin-right: auto;
      /* Các phần tử bên trái sẽ căn vào bên trái */
    }
  }

  @media (max-width: 767px) {
    .theloaikhoi {
      display: inline-block;
      float: left;
    }

    .theloaikhoi ul.dropdown-menu {
      background: #57606f;
      right: 0;
      width: 230px;
    }
  }

  .navbar-inverse .navbar-nav>li>a {
    color: #fff;
  }
</style>

</style>


<script>
    function showAlerts(event) {
        // Hiển thị thông báo khi hình ảnh được nhấp vào
        event.preventDefault();
        alert('Vui lòng đăng nhập để hiển thị thêm!');
        window.handleAlertOK = window.location.href = 'login.php';
    }
</script>