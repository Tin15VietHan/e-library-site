<?php
require('layouts/header.php');
require('./../connect.php');

$search = "";
$category = ""; // Thêm biến $category để lưu giá trị của select box
$limit = 5;
$page = 1;

if (isset($_REQUEST['p']) && (int)$_REQUEST['p'] >= 1) {
  $page = (int) $_REQUEST['p'];
}

if (isset($_GET['txtsearch'])) {
  $search = $_GET['txtsearch'];
}

if (isset($_GET['category_search'])) { // Kiểm tra xem người dùng đã chọn khoa nào từ dropdown chưa
  $category = $_GET['category_search'];
}

$offset = ($page - 1) * $limit;

// Sửa câu truy vấn để lọc theo cả mã sinh viên và khoa
$sql = "SELECT * FROM sinhvien WHERE masv LIKE '%$search%'";

// Nếu người dùng đã chọn khoa từ dropdown, thêm điều kiện vào câu truy vấn
if ($category !== "") {
  $sql .= " AND khoa = '$category'";
}

$query = mysqli_query($conn, $sql . " LIMIT $offset, $limit");
$count = mysqli_num_rows(mysqli_query($conn, $sql));
$totalPage = ceil($count / $limit) ?? 0;
?>

<div class="content-wrapper" style="min-height: 365px;">
  <section class="content">
    <div class="container-fluid">
      <h3><b>DANH SÁCH SINH VIÊN</b></h3></br>
      <div class="form-wrapper">
      <form action="" method="GET" class="searchform">
        <input type="text" name="txtsearch" class="form" placeholder="Nhập mã sinh viên...">
        <!-- Giữ nguyên form tìm kiếm theo mã sinh viên -->
        <button class="sbutton" type="submit">Search</button>
      </form>
      </div>  
      <!-- Form mới để tìm kiếm theo khoa -->
      <div class="form-wrapper">
      <form action="" method="GET" class='searchform'>
        <select name="category_search" class='form' style="width: 190px;">
          <option value="" disabled selected>Chọn Khoa</option>
          <?php
          // Kết nối CSDL và truy vấn các danh mục
          $sql_categories = "SELECT * FROM categories";
          $result_categories = mysqli_query($conn, $sql_categories);
          // Tạo option cho select box từ kết quả truy vấn
          while ($row_category = mysqli_fetch_assoc($result_categories)) {
            $selected = ($row_category['name'] == $category) ? 'selected' : ''; // Chọn mục đã được chọn trước đó
            echo "<option value='" . $row_category['name'] . "' $selected>" . $row_category['name'] . "</option>";
          }
          ?>
        </select>
        <button class='sbutton' type="submit">Search</button>
      </form>
    </div>
  </br>

      <!-- Hiển thị dữ liệu sinh viên -->
      <div class="row">
        <div class="table-responsive">
          <table cellspacing="0" cellpadding="0" class="table" style="display: block !important; overflow-x: auto !important; width: 100% !important;">
            <!-- Header của bảng -->
            <thead>
              <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Mã Sinh Viên</th>
                <th>Tên Sinh Viên</th>
                <th>Mật khẩu</th>
                <th>Chức vụ</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Số Điện Thoại</th>
                <th>Địa chỉ</th>
                <th>Lớp</th>
                <th>Khoa</th>
                <th>Giáo Viên Chủ Nhiệm</th>
                <th colspan="2"><a href="them_sinhvien.php">Thêm</a></th>

              </tr>
            </thead>
            <tbody>
             <?php 
$stt = $offset + 1; // Tính toán STT bắt đầu từ vị trí của dòng hiển thị đầu tiên trên trang
while ($row = mysqli_fetch_array($query)) : ?>
  <tr>
    <td><?php echo $stt; ?></td>
    <td><?php echo '<img src="' . $row['img'] . '" style="width: 100px; height: auto;" />'; ?></td>
    <td><?php echo $row['masv']; ?></td>
    <td><?php echo $row['tensv']; ?></td>
    <td><?php echo $row['matkhau']; ?></td>
    <td><?php echo $row['chucvu']; ?></td>
    <td><?php echo $row['gioitinh']; ?></td>
    <td><?php echo date('d/m/Y', strtotime($row['ngaysinh'])); ?></td>
    <td><?php echo $row['sdt']; ?></td>
    <td><?php echo $row['diachi']; ?></td>
    <td><?php echo $row['lop']; ?></td>
    <td><?php echo $row['khoa']; ?></td>
    <td><?php echo $row['gvchunhiem']; ?></td>     
  </tr>
  <?php $stt++; // Tăng STT sau mỗi vòng lặp ?>
<?php endwhile; ?>

            </tbody>
          </table>

          <!-- Hiển thị phân trang -->
          <?php 
           for ($i=1; $i <= $totalPage; $i++)
           if($i == $page) {
            echo "<a href = 'ds_sinhvien.php?p=$i' style='font-size: 20px; color: red; margin: 0px 4px;'> $i </a>";
           } else{
            echo "<a href = 'ds_sinhvien.php?p=$i' style='margin: 0px 2px;'> $i </a>";
           }
          ?>
        </div>
      </div>
    </div>
  </section>
</div>

<?php require('layouts/footer.php'); ?>

<style>
h3 {
  padding-top: 25px;
  color:#1E90FF;
}

/* CSS cho ảnh */
.table img {
  max-width: 100px; /* Giới hạn chiều rộng tối đa của ảnh */
  height: 100px; /* Để chiều cao tự điều chỉnh theo tỷ lệ của ảnh */
}

.form {
  border: 2px solid black;
  border-radius: 5px;
}

.sbutton {
  color: #007bff;
  border-radius: 10px;
}
.form-wrapper {
    display: inline-block;
    margin-right: 20px;
    /* Khoảng cách giữa hai form */
  }
</style>
