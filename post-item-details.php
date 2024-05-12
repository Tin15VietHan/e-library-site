<?php
include_once('master_layout/header.php');
require('connect.php');
?>
<?php
if (isset($_POST['content']) && isset($_POST['submit'])) {
    $content = $_POST['content'];
    if (isset($_SESSION['account'])) {
        $post_id = $_GET['id'];
        $account_id = $_SESSION['account']['id'];
        $query = "INSERT comments(account_id, post_id, content) VALUES('$account_id', '$post_id', '$content')";

        $result = mysqli_query($conn, $query);
    }
}
 //-----------------------------------------------------------------------------------------------

if (isset($_POST['idCmt']) && isset($_POST['deleteCmt'])) {
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (isset($_SESSION['account'])) {
        $id = $_POST['idCmt'];
        // Escape biến $id để tránh SQL Injection
        $id = mysqli_real_escape_string($conn, $id);

        // Sử dụng câu lệnh DELETE FROM thay vì DELETE *
        $deletecmt = "DELETE FROM comments WHERE id = '$id'";
        $result2 = mysqli_query($conn, $deletecmt);
    }
}
 //-----------------------------------------------------------------------------------------------
 if (isset($_POST['cmt']) && isset($_POST['editCmt'])) {
    $content = $_POST['cmt'];
    $cmt_id = $_POST['idCmt'];
    $queryedit = "UPDATE comments SET content = '$content', updated_at = NOW()  WHERE id = '$cmt_id'";
    $resultedit = mysqli_query($conn, $queryedit);
}



?>
<?php
if (isset($_GET['id']) && isset($_GET['category_id'])) {
    $id = $_GET['id'];
    $category_id = $_GET['category_id'];
    $sql = "SELECT * FROM posts WHERE id='$id'"; // Câu lệnh select
    $query = mysqli_query($conn, $sql); // thực hiện câu lệnh query - select. Kết quả trả về là 1 mảng collection (các row)

    $rn = $query->fetch_array(MYSQLI_ASSOC); // Lấy bản ghi đầu tiên của kết quả
    if (mysqli_num_rows($query)  == 0) {
        header('Location: index.php');
    }

    $sql = "SELECT * FROM posts WHERE category_id='$category_id' AND id <> '$id'  ORDER BY id DESC LIMIT 5";
    $query_post = mysqli_query($conn, $sql);

     $sql_comments = "SELECT c.id, c.account_id, c.content, c.post_id, c.updated_at, a.fullname FROM comments AS c INNER JOIN accounts AS a ON c.account_id = a.id WHERE c.post_id = $id ORDER BY  c.updated_at DESC";
    $query_comments = mysqli_query($conn, $sql_comments);
    

    //-----------------------------------------------------------------------------------------------
    $sql_count_cmt = "SELECT count(*) FROM `comments`  WHERE  post_id= '$id'";
    $query_count_cmt =  mysqli_query($conn, $sql_count_cmt);

    // Trích xuất kết quả từ câu truy vấn
    $result_count_cmt = mysqli_fetch_array($query_count_cmt);

    // Lấy giá trị số lượng bình luận
    $count_comments = $result_count_cmt[0];
    //-----------------------------------------------------------------------------------------------

    $user_id =  $account_id = $_SESSION['account']['id'];
    // Kiểm tra xem đã có bản ghi tương ứng trong bảng chưa
    $sql_check = "SELECT * FROM checkview WHERE user_id = '$user_id' AND post_id = '$id'";
    $query_check = mysqli_query($conn, $sql_check);
    $num_rows = mysqli_num_rows($query_check);

    if ($num_rows == 0) {
        // Thực hiện truy vấn UPDATE
        $sqlupview = "UPDATE posts SET view = view + 1 WHERE id = '$id'";
        $queryview = mysqli_query($conn, $sqlupview);

        // Thêm một bản ghi mới vào bảng
        $sql_insert = "INSERT INTO checkview (user_id, post_id) VALUES ('$user_id', '$id')";
        $query_insert = mysqli_query($conn, $sql_insert);
    }
} else {
    header('Location: index.php');
}

?>

<div class="container">
    <div class="page-header">
        <h1><b><?php echo $rn['title'] ?></b></h1>
    </div>

    <div id="news">
        <div id="news_image" style="text-align: center;">
            <?php
            $image;
            if ($rn['image'] == null) {
                $image = "Database/anh_bia/SachChuacobia.jpg";
            } else {
                $image = $rn['image'];
            }
            ?>
            <img alt="<?php echo $rn['title']; ?>" src="<?php echo $image ?>" class="rounded" width="300">
        </div>
        <div id="news_content">
            <p><?php echo $rn['content']; ?></p>
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
                        $title = $row['title'];
                        echo "<li><a href='post-item-details.php?category_id=$category_id&id=$id'  style='color: #000'><strong>$title</strong></a></li><br>";
                    }
                } ?>
            </ul>
            
        </div>
        <div class="card">
        
            <span class="titles"><?php echo $count_comments; ?> Comments</span>
            <div class="text-box">
                <div class="box-container">
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <textarea class="form-control" name="content" rows="3"></textarea>
                        </div>
                        <div class="formatting">
                            
                            <?php if (isset($_SESSION['account'])) : ?>
                                <button type="submit" name="submit" value="Submit" class="cmt" title="Send">
                                    <i class='bx bx-send' style="font-size:  24px; float: right;"></i></button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <div class="news_comments" id="comment-section" style="display: grid;">
                    <?php while ($row = mysqli_fetch_array($query_comments)) : ?>
                        <div class="comments">
                            <div class="comment-react">
                            </div>
                            <div class="comment-container">
                                <div class="user">
                                    <div class="user-pic">
                                        <svg fill="none" viewBox="0 0 24 24" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linejoin="round" fill="#707277" stroke-linecap="round" stroke-width="2" stroke="#707277" d="M6.57757 15.4816C5.1628 16.324 1.45336 18.0441 3.71266 20.1966C4.81631 21.248 6.04549 22 7.59087 22H16.4091C17.9545 22 19.1837 21.248 20.2873 20.1966C22.5466 18.0441 18.8372 16.324 17.4224 15.4816C14.1048 13.5061 9.89519 13.5061 6.57757 15.4816Z"></path>
                                            <path stroke-width="2" fill="#707277" stroke="#707277" d="M16.5 6.5C16.5 8.98528 14.4853 11 12 11C9.51472 11 7.5 8.98528 7.5 6.5C7.5 4.01472 9.51472 2 12 2C14.4853 2 16.5 4.01472 16.5 6.5Z"></path>
                                        </svg>
                                    </div>
                                    <div class="user-info">
                                        <span><?php echo $row['fullname']; ?> <br> <?php echo $row['updated_at']; ?></span>
                                    </div>
                                </div>
                                <!-- bình luận -->
                                <form action="" method="POST" role="form">
                                    <input type="hidden" name="form" value="form1">
                                    <input type="text" name="idCmt" value="<?php echo $row['id'] ?>" style="display: none" ; />

                                    <?php
                                    if ($account_id == $row['account_id']) {
                                        echo "<textarea class='form-control' id='cmtTextarea' name='cmt' value='" . $row['content'] . "'>" . $row['content'] . "</textarea>";
                                        echo "<button class='btn-delete' type='submit' name='deleteCmt' style='display: block;'><i class='fa fa-trash'></i></button>";
                                        echo "<button class='btn-edit' type='submit' name='editCmt' style='display: block;' ><i class='fas fa-edit'></i></button>";
                                    } else {
                                        echo "<textarea readonly class='form-control' id='cmtTextarea' name='cmt'>" . $row['content'] . "</textarea>";
                                        echo "<button class='btn-delete' type='submit' name='deleteCmt' >Trả Lời</button>";
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
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