<?php include_once('./master_layout/header.php');
require "connect.php";
?>
<?php include_once 'functions.php'; ?>
<!-- sticky header end -->
<div class="container blogging-style">
  <div class="page-header" style="margin-top: 20px;display: flex; align-items: center;">
    <?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT name FROM categories WHERE id ='$id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
    ?>
      <h2><?php echo $row['name'] ?></h2>
      <form class="navbar-form navbar-left" action="search-result-found.php" method="GET" role="search">
            <div class="input-group" style="bottom: -5px;">
              <input type="text" class="form-control" style="width: 270px;" placeholder="Search" name="txtsearch" id="search-input">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit" id="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </div>
              <ul id="search-suggestions"></ul>
            </div>
          </form>
  </div>
  <div class="row">
    <div class="ind">
    <?php
    }
if(isset($_GET['submit'])){
  $search = $_GET['txtsearch'];
}
    $sql = "SELECT * FROM posts WHERE category_id='$id' ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $idtin = $row['id'];
      $tieude = substr($row['title'], 0, 50);
      $category_id = $row['category_id'];
      $view = $row['view'] ;
      $image;
      if ($row['image'] == null) {
        $image = "https://localhost/E-Library/database/anh_bia/SachChuacobia.jpg";
      } else {
        $image = $row['image'];
      }


    ?>

      <div class="col-md-3 col-sm-5 col-xs-8 items">
        <li class=bantin>
          <?php
          echo "<a href='post-item-details.php?id=$idtin&category_id=$category_id'  ><div class='overlay' title='$view'><span class='	glyphicon glyphicon-eye-open'></span>  " . formatNumber($view) . " views</div></a>";
          echo "<a href='post-item-details.php?id=$idtin&category_id=$category_id'  ><img src='$image' title='$tieude' width='100%' height='260px' loading='lazy'/></a>";
          echo "<a href='post-item-details.php?id=$idtin&category_id=$category_id' ><h4 style='font-size: 13px' title='$tieude'> $tieude</h4></a>";
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
</div>

<?php include_once('./master_layout/footer.php') ?>
<style>



</style>