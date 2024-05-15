<?php
include_once('./master_layout/header.php');
include_once('functions.php');
require('./connect.php'); 

?>
<div class="container blogging-style" style="background: #ffffff;">
  <div class="page-header" style="margin-top: 5px;">

    <h2>Trang chủ</h2>
    
  </div>


  <div class="row">
    
    <div class="ind">
      <?php

      $sql = "SELECT * FROM posts ORDER BY id ASC";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_array($result)) {
        $idtin = $row['id'];
        $tieude = $row['title'] ;
        $view = $row['view'] ;
        $category_id = $row['category_id'];
        $time = $row['created_at'];

        $image;
        if($row['image'] == null){
          $image = "Database/anh_bia/SachChuacobia.jpg";
        }else{
          $image = $row['image'];
        }

      ?>
        <div class="col-md-3 col-sm-5 col-xs-8 items">
          <li class=bantin>
            <?php 
            if (isset($_SESSION['account'])){
              echo "<a href='post-item-details.php?id=$idtin&category_id=$category_id'  ><div class='overlay' title='$view'><span class='	glyphicon glyphicon-eye-open'></span>  ".formatNumber($view)." views</div></a>";
              echo "<a href='post-item-details.php?id=$idtin&category_id=$category_id'  ><img src='$image' title='$tieude' width='100%' height='260px' loading='lazy'/></a>";
              echo "<a href='post-item-details.php?id=$idtin&category_id=$category_id' ><h4 style='font-size: 13px' title='$tieude'> $tieude</h4></a>";
            }
            else{
              echo "<a href='#'><img src='$image' width='100%' height='260px' loading='lazy' title='$tieude' onclick='showAlert()';/></a>";
              echo "<a href='#' onclick='showAlert();'><h4 style='font-size: 13px' title='$tieude'> $tieude</h4></a>";
            }
            ?>
          </li>
        </div>
      <?php } ?>

    </div>
  </div>

  <!-- calendar start -->
  <div class="col-sm-16 bt-space wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="50">
    <div class="single pull-left"></div>
  </div>
  <!-- calendar end -->
  <div class="fb-comments" data-href="https://localhost/E-LiBrary/index.php" data-width="700px" data-numposts="5"></div>
</div>



<?php include_once('./master_layout/footer.php') ?>

<script>
    function showAlert() {
        // Hiển thị thông báo khi hình ảnh được nhấp vào
        alert('Vui lòng đăng nhập để đọc sách!');
        window.handleAlertOK = window.location.href = 'login.php';
    }
</script>



