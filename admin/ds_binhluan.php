<?php
require('layouts/header.php'); ?>
<?php
require('./../connect.php'); ?>

<?php
  $search = "";
  $limit = 15;
  $page = 1;
  if(isset($_REQUEST['p']) && (int)$_REQUEST['p'] >= 1) {
    $page = (int) $_REQUEST['p'];
  }
  if(isset($_GET['txtsearch'])){
    $search = $_GET['txtsearch'];
  }

  $offset = ($page - 1) * $limit;
  $sql = "SELECT * FROM binhluan WHERE noidungbinhluan LIKE '%$search%'";
  $query = mysqli_query($conn ,$sql . " LIMIT $offset, $limit");
  $count = mysqli_num_rows(mysqli_query($conn ,$sql));
  $totalPage = ceil($count/$limit) ?? 0;
?>

<div class="content-wrapper" style="min-height: 365px;">
     <section class="content">
     <div class="container-fluid">
        <h3><b>DANH SÁCH BÌNH LUẬN</b></h3></br>
        <form  action="" method="GET">
           <input type="text" name="txtsearch" class='form'/>
           <input class='sbutton' type="submit" value="Search"/>
        </form></br>
    <div class="row">
        <div class="table-responsive">
            <table cellspacing="0" cellpadding="0" class="table" style="display: block !important; overflow-x: auto !important; width: 100% !important;">
              <thead>
                <tr>
                   <th scope="col">STT</th>
                   <th scope="col">NỘI DUNG</th>
                   <th scope="col">SÁCH_ID</th>
                   <th scope="col">ĐỘCGIẢ_ID</th>
        
                   <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
<?php 
$stt = $offset + 1; // Khởi tạo STT dựa trên trang hiện tại
while($row = mysqli_fetch_array($query)): ?>
                <tr>
                   <td><?php echo $stt++; ?></td>
                   <td><?php echo $row['noidungbinhluan']; ?></td>
                   <td><?php echo $row['sach_id']; ?></td>
                   <td><?php echo $row['docgia_id']; ?></td>
                  
                   <td><a href="xoa_binhluan.php?id=<?php echo $row['id']; ?>">Xóa</a></td>
                </tr>
<?php endwhile; ?>
              </tbody>
            </table>
          </div>
  <?php 
  for ($i = 1; $i <= $totalPage; $i++) {
    if($i == $page) {
      echo "<a href='ds_binhluan.php?p=$i' style='font-size: 20px; color: red; margin: 0px 4px;'> $i </a>";
    } else {
      echo "<a href='ds_binhluan.php?p=$i' style='margin: 0px 2px;'> $i </a>";
    }
  }
  ?>
      </div>
    </div>

   </div>
 </section>
</div>

<?php require('layouts/footer.php'); ?>

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
