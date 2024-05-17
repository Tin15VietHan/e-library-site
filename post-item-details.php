<?php
include_once('master_layout/header.php');
require('connect.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<?php
if (isset($_GET['id']) && isset($_GET['khoaID'])) {
    $id = $_GET['id'];
    $khoaID = $_GET['khoaID'];
    $sql = "SELECT * FROM sach WHERE id='$id'"; // Câu lệnh select
    $query = mysqli_query($conn, $sql); // thực hiện câu lệnh query - select. Kết quả trả về là 1 mảng collection (các row)

    $rn = $query->fetch_array(MYSQLI_ASSOC); // Lấy bản ghi đầu tiên của kết quả
    if (mysqli_num_rows($query)  == 0) {
        header('Location: index.php');
    }

    $sql = "SELECT * FROM sach WHERE khoaID='$khoaID' AND id <> '$id'  ORDER BY id DESC LIMIT 5";
    $query_post = mysqli_query($conn, $sql);

    //-----------------------------------------------------------------------------------------------

    $user_id =  $account_id = $_SESSION['account']['id'];
    // Kiểm tra xem đã có bản ghi tương ứng trong bảng chưa
    $sql_check = "SELECT * FROM checkview WHERE docgiaID= '$user_id' AND sachID = '$id'";
    $query_check = mysqli_query($conn, $sql_check);
    $num_rows = mysqli_num_rows($query_check);

    if ($num_rows == 0) {
        // Thực hiện truy vấn UPDATE
        $sqlupview = "UPDATE sach SET luotxem = luotxem + 1 WHERE id = '$id'";
        $queryview = mysqli_query($conn, $sqlupview);

        // Thêm một bản ghi mới vào bảng
        $sql_insert = "INSERT INTO checkview (docgiaID, sachID) VALUES ('$user_id', '$id')";
        $query_insert = mysqli_query($conn, $sql_insert);
    }
} else {
    header('Location: index.php');
}

?>

<div class="container">
    <div class="page-header">
        <h1><b><?php echo $rn['tensach'] ?></b></h1>
    </div>

    <div id="news">
        <div id="news_image" style="text-align: center;">
            <?php
            $anh;
            if ($rn['anh'] == null) {
                $anh = "Database/anh_bia/SachChuacobia.jpg";
            } else {
                $anh = $rn['anh'];
            }
            ?>
            <img alt="<?php echo $rn['tensach']; ?>" src="<?php echo $anh ?>" class="rounded" width="300">
        </div>
        <div id="news_content">
            <p><?php echo $rn['gioithieusach']; ?></p>
        </div>
        <div class="read-book" id="read-book">
            <h3 style="margin: 5px" ;>ĐỌC SÁCH</h3>
        </div>
        <div id="news_more">
            <h4><?php echo "<a>||</a>Sách liên quan"; ?></h4></br>
            <ul>
                <?php if (mysqli_num_rows($query_post) == 0) {
                    echo "Không có sách liên quan";
                } else {
                    while ($row = mysqli_fetch_array($query_post)) { 
                        $id = $row['id'];
                        $tensach = $row['tensach'];
                        echo "<li><a href='post-item-details.php?khoaID=$khoaID&id=$id'  style='color: #000'><strong>$tensach</strong></a></li><br>";
                    }
                } ?>
            </ul>
            
        </div>
        <div class="card">
        
                <div class="fb-comments" data-href="https://e-library.site/<?php echo $id; ?>" data-width="700" data-numposts="7"></div>
        </div>
    </div>
</div>
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
            


            <!-- bage header End -->

            <!-- Footer Start -->

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
            <script src="./assets/js/ajax-comment.js"></script>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0" nonce="YKOtrvoU"></script>
            <?php

            // include_once('./master_layout/footer.php')
            ?>
            <style>
                #news {
                    width: 700px;
                    margin-left: 170px;
                }

                p {
                    width: 700px;
                    margin-top: 30px;
                    color: #222;
                    letter-spacing: 1px;
                    font-size: 15px;
                    font-family: Arial, sans-serif;
                }

                #news_more {
                    margin-top: 25px;
                    margin-bottom: 25px;
                }

                a {
                    color: #06c;
                }

                .well {
                    margin-top: 75px;
                    margin-bottom: 50px;
                }
            </style>
            <style>
                  footer{
                    position: relative;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    /* background-color: #f8f9fa; */
                    /* padding: 20px 0; */
                    text-align: center;
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

            <script>
                var link = "<?php echo $rn['contens']; ?>";
                // Chọn div có id là myDiv
                var divElement = document.getElementById("read-book");

                // Gắn sự kiện click cho div đó
                divElement.addEventListener("click", function() {
                    if (link == "") {
                        alert("Xin lỗi sách này chưa có file pdf ");
                    } else {
                        window.open(link, "_blank");
                    }
                });
            </script>