<?php
require('layouts/header.php'); ?>
<?php
require('./../connect.php'); ?>

<?php
  $search = "";
  $limit = 10;
  $page = 1;
  if(isset($_REQUEST['p']) && (int)$_REQUEST['p'] >= 1) {
    $page = (int) $_REQUEST['p'];
  }
  if(isset($_GET['txtsearch'])){
    $search = $_GET['txtsearch'];
  }

  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM khoa WHERE tenkhoa LIKE '%$search%'";
  $query = mysqli_query($conn ,$sql . " LIMIT $offset, $limit");
  $count = mysqli_num_rows(mysqli_query($conn ,$sql));
  $totalPage = ceil($count/$limit) ?? 0;
?>
<?php require('layouts/footer.php'); ?>

<div class="content-wrapper" style="min-height: 365px;">
  <section class="content">
    <div class="container-fluid">
      <h3><b>KHOA</b></h3></br>
      <form action="" method="GET">
        <input type="text" name="txtsearch" class='form' placeholder="Tìm kiếm..."/>
        <input class='sbutton' type="submit" value="Search"/>
      </form></br>
      <div class="row">
        <div class="table-responsive">
          <table cellspacing="0" cellpadding="0" class="table" style="display: block !important; overflow-x: auto !important; width: 100% !important;">
            <thead>
              <tr>
                <th scope="row">ID</th>
                <th scope="row">Tên Khoa</th>
                <th scope="row" colspan="2"><a href="them_danhmuc.php">Thêm</a></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $stt = ($page - 1) * $limit + 1;
              while($row = mysqli_fetch_array($query)):
              ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['tenkhoa']; ?></td>
                  <td><a href="sua_danhmuc.php?id=<?php echo $row['id']; ?>">Sửa</a></td>
                  <td><a href="xoa_danhmuc.php?id=<?php echo $row['id']; ?>">Xóa</a></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

          <?php 
          for ($i = 1; $i <= $totalPage; $i++) {
            if ($i == $page) {
              echo "<a href='ds_danhmuc.php?p=$i' style='font-size: 20px; color: red; margin: 0px 4px;'> $i </a>";
            } else {
              echo "<a href='ds_danhmuc.php?p=$i' style='margin: 0px 2px;'> $i </a>";
            }
          }
          ?>

        </div>
      </div>
    </div>
  </section>
</div>



<style>
.sbutton {
  color: #007bff;
  border-radius: 10px;
}

h3 {
  padding-top: 30px;
  color: #1E90FF;
}

.form {
  border: 2px solid black;
  border-radius: 5px;
}
</style>
