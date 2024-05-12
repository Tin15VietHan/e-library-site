<?php
require('layouts/header.php');
require('./../connect.php');

$status = "";
$search = "";
$limit = 10;
$page = 1;
if (isset($_REQUEST['p']) && (int)$_REQUEST['p'] >= 1) {
  $page = (int) $_REQUEST['p'];
}
if (isset($_GET['txtsearch'])) {
  $search = $_GET['txtsearch'];
}
if (isset($_GET['status'])) {
  $status = $_GET['status'];
}

$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM muon_sach WHERE masv LIKE '%$search%'";
if (!empty($status)) {
  $sql .= " AND trang_thai = '$status'";
}
$query = mysqli_query($conn, $sql . " LIMIT $offset, $limit");
$count = mysqli_num_rows(mysqli_query($conn, $sql));
$totalPage = ceil($count / $limit) ?? 0;

$sql_muon_sach = "SELECT * FROM `muon_sach` ORDER BY `muon_sach`.`updated_at` DESC";
$queryy =mysqli_query ($conn,$sql_muon_sach);
?>

<div class="content-wrapper" style="min-height: 365px;">

  <section class="content">
    <div class="container-fluid">
      <h3><b>DANH SÁCH NGƯỜI MƯỢN TRẢ</b></h3></br>
      <form action="" method="GET" class='searchform'>
        <input type="text" name="txtsearch" class='form' placeholder="Nhập mã sinh viên..."/>
        <button class='sbutton' type="submit">Search</button>
      </form></br>
      <form action="" method="GET" class='searchform'>
  
  <!-- Thêm dropdown menu cho trạng thái -->
  <select name="status" class='form' style="width: 190px;">
    <option value="">Chọn Trạng Thái</option>
    <option value="Đang Mượn">Đang Mượn</option>
    <option value="Đã trả">Đã trả</option>
    <option value="Đã Quá Hạn Trả">Đã Quá Hạn Trả</option>
  </select>
  <button class='sbutton' type="submit">Search</button>
</form></br>

      <div class="row">
        <div class="table-responsive">
          <table cellspacing="0" cellpadding="0" class="table" style="display: block !important; overflow-x: auto !important; width: 100% !important;">
            <thead>
              <tr>
                <th >STT</th>
                <th >Mã Sinh Viên</th>
                <th >Tên Người Mượn</th>
                <th >Số Điện Thoại</th>
                <th >Địa Chỉ</th>
                <th >Tên Sách</th>
                <th >Ngày Mượn</th>
                <th >Ngày Hẹn Trả</th>
                <th >Trạng Thái</th>
                <th >Ngày Cập Nhật</th>
                <th >Người Tạo</th>
                <th scope="row" colspan="2">Thao Tác</th>
              </tr>
            </thead>
            <tbody>
              <?php 
$stt = ($page - 1) * $limit + 1; // Sửa lại tính toán STT
while ($row = mysqli_fetch_array($query)) :
?>
  <tr>
    <td><?php echo $stt; ?></td>
    <td><?php echo $row['masv']; ?></td>
    <td><?php echo $row['ten_nguoi_muon']; ?></td>
    <td><?php echo $row['sdt']; ?></td>
    <td><?php echo $row['dia_chi']; ?></td>
    <td><?php echo $row['sach_muon']; ?></td>
    <td><?php echo $row['ngay_muon']; ?></td>
    <td><?php echo $row['ngay_hen_tra']; ?></td>
    <td><?php echo $row['trang_thai']; ?></td>
    <td><?php echo $row['updated_at']; ?></td>
    <td><?php echo $row['data_creator']; ?></td>
    <td><a href="trasach.php?id=<?php echo $row['id']; ?>">Trả Sách</a></td>
    <td><a href="sua_nguoi_muon_sach.php?id=<?php echo $row['id']; ?>">Sửa</a></td>
    <td><a href="xoa_nguoi_muon.php?id=<?php echo $row['id']; ?>">Xóa</a></td>
  </tr>
<?php
  $stt++; // Tăng giá trị STT cho dòng tiếp theo
endwhile;
?>

            </tbody>
          </table>

         
          <?php 
           for ($i=1; $i <= $totalPage; $i++)
           if($i == $page) {
            echo "<a href = 'ds_nguoi_muon_sach.php?p=$i' style='font-size: 20px; color: red; margin: 0px 4px;'> $i </a>";
           } else{
            echo "<a href = 'ds_nguoi_muon_sach.php?p=$i' style='margin: 0px 2px;'> $i </a>";
           }
          ?>
        </div>
      </div>

    </div>
  </section>
</div>

<?php require('layouts/footer.php'); ?>

<style>

h3{
 padding-top: 30px;
 color:#1E90FF;
}
  
.form{
  border: 2px solid black;
  border-radius: 5px;
}

.sbutton {
color: #007bff;
border-radius: 10px;
}
 
</style>
