<?php include_once('./master_layout/header.php') ?>
<?php
      require "connect.php";
?> 

<?php
  $search = "";
  $limit = 15;
  $page = 1;
  if(isset($_REQUEST['p']) && (int)$_REQUEST['p'] >= 1) {
    $page = (int) $_REQUEST['p'];
  }
  if(isset($_GET['txtsearch'])){
    $search = $_GET['txtsearch'];
  } else {
    header('Location: index.php');
  }

  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM sach WHERE tensach LIKE '%$search%'";
  $query = mysqli_query($conn ,$sql . " LIMIT $offset, $limit");
  $count = mysqli_num_rows(mysqli_query($conn ,$sql));
  $totalPage = ceil($count/$limit) ?? 0;
?>
  <div class="container"> 
    
    <!-- bage header start -->
  <div class="page-header" style="margin-top:  20px" ;>
    <h2>Kết quả tìm kiếm </h2>
  </div>
  <div class="news">
    <ul>
      <?php if (isset($_SESSION['account'])) { ?>
        <?php while ($row = mysqli_fetch_array($query)) : ?>
          <li>
            <div class="news_item">
              <a class="news_item_avatar" tensach="<?php echo $row['tensach']; ?>" href=<?php echo "post-item-details.php?id=" . $row['id'] . "&category_id=" . $row['category_id']; ?>>

                <div class="news_item_img">
                  <img alt="<?php echo $row['tensach']; ?>" src="<?php echo $row['image'] ?>" class="rounded" width="190" height="260px">
                </div>
              </a>
              <div class="news_item_content">
                <h3 class="news_item_tensach" style="margin-top:  0px;">
                  <a>
                    <?php echo $row['tensach']; ?>
                  </a>
                </h3>
                <p class="news_item_sapo" tensach="<?php echo $row['tensach']; ?>" href="">
                  <?php echo substr($row['content'], 0, 650); ?>

                </p>
              </div>
            </div>
          </li>
        <?php endwhile; ?>
      <?php   } else { ?>
        <?php while ($row = mysqli_fetch_array($query)) : ?>
          <li>
            <div class="news_item"  onclick='showAlert()';>
              <a class="news_item_avatar" tensach="<?php echo $row['tensach']; ?>"   >

                <div class="news_item_img">
                  <img alt="<?php echo $row['tensach']; ?>" src="<?php echo $row['image'] ?>" class="rounded" width="190" height="260px">
                </div>
              </a>
              <div class="news_item_content">
                <h3 class="news_item_tensach" style="margin-top:  0px;">
                  <a>
                    <?php echo $row['tensach']; ?>
                  </a>
                </h3>
                <p class="news_item_sapo" tensach="<?php echo $row['tensach']; ?>" href="">
                  <?php echo substr($row['content'], 0, 650); ?>

                </p>
              </div>
            </div>
          </li>
        <?php endwhile; ?>
      <?php  } ?>

    </ul>


  </div>
  <!-- bage header end -->
</div>


<!-- data start -->


<?php
for ($i = 1; $i <= $totalPage; $i++)
  if ($i == $page) {
    echo "<a href = 'search-result-found.php?p=$i' style='font-size: 20px; color: red; margin: 0px 4px;'> $i </a>";
  } else {
    echo "<a href = 'search-result-found.php?p=$i' style='margin: 0px 2px;'> $i </a>";
  }
?>
<?php include_once('./master_layout/footer.php') ?>
<style>
  /* .btn {
    outline: none;
    display: inline-block;
    margin-bottom: 0;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 8px 12px;
    font-size: 13px;
    line-height: 1.3846154;
    border-radius: 4px;
    background-color: #e2e8f2;
    border-color: #e2e8f2;
    padding: 12px 20px;
    font-size: 17px;
    line-height: 23px;
  } */


  ul li {
    list-style-type: none;
  }

  a {
    text-decoration: none;
  }

  p {
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    display: -webkit-box;
    max-height: 3.2rem;
    -webkit-box-orient: vertical;
    max-height: 3.2rem;
    white-space: normal;
    line-height: 1.6rem;
  }

  .news_item {
    display: flex;
    padding-top: 25px;
  }

  .news_item_content {
    margin: 0px 20px;
  }
</style>

<script>
    function showAlert() {
        // Hiển thị thông báo khi hình ảnh được nhấp vào
        alert('Vui lòng đăng nhập để đọc sách!');
        window.handleAlertOK = window.location.href = 'login.php';
    }
</script>

