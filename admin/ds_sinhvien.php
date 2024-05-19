<?php
require('layouts/header.php');
require('./../connect.php');

$search = "";
$category = ""; // Thêm biến $category để lưu giá trị của select box
$limit = 15;
$page = 1;

if (isset($_REQUEST['p']) && (int)$_REQUEST['p'] >= 1) {
  $page = (int) $_REQUEST['p'];
}

if (isset($_GET['txtsearch'])) {
  $search = $_GET['txtsearch'];
}

if (isset($_GET['khoa_search'])) { // Kiểm tra xem người dùng đã chọn khoa nào từ dropdown chưa
  $category = $_GET['khoa_search'];
}

$offset = ($page - 1) * $limit;

// Sửa câu truy vấn để lọc theo cả mã sinh viên và khoa
$sql = "SELECT * FROM docgia WHERE madocgia LIKE '%$search%'";

// Nếu người dùng đã chọn khoa từ dropdown, thêm điều kiện vào câu truy vấn
if ($category !== "") {
  $sql .= " AND khoaID = '$category'";
}

$query = mysqli_query($conn, $sql . " LIMIT $offset, $limit");
$count = mysqli_num_rows(mysqli_query($conn, $sql));
$totalPage = ceil($count / $limit) ?? 0;
?>

<div class="content-wrapper" style="min-height: 365px;">
  <section class="content">
    <div class="container-fluid">
      <h3><b>DANH SÁCH ĐỘC GIẢ</b></h3></br>
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
        <select name="khoa_search" class='form' style="width: 190px;">
          <option value="" disabled selected>Chọn Khoa</option>
          <?php
          // Kết nối CSDL và truy vấn các danh mục
          $sql_categories = "SELECT * FROM khoa";
          $result_categories = mysqli_query($conn, $sql_categories);
          // Tạo option cho select box từ kết quả truy vấn
          while ($row_category = mysqli_fetch_assoc($result_categories)) {
            $selected = ($row_category['tenkhoa'] == $category) ? 'selected' : ''; // Chọn mục đã được chọn trước đó
            echo "<option value='" . $row_category['tenkhoa'] . "' $selected>" . $row_category['tenkhoa'] . "</option>";
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
                <th>Mã Độc Giả</th>
                <th>Tên Độc Giả</th>
                <th>Email</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Số Điện Thoại</th>
                <th>Địa chỉ</th>
                <th>Tên Đăng Nhập</th>
                <th>Mật Khẩu</th>
                <th>Trạng Thái</th>
                <th colspan="2"><a href="them_sinhvien.php">Thêm</a></th>

              </tr>
            </thead>
            <tbody>
             <?php 
$stt = $offset + 1; // Tính toán STT bắt đầu từ vị trí của dòng hiển thị đầu tiên trên trang
while ($row = mysqli_fetch_array($query)) : ?>
  <tr>
    <td><?php echo $stt; ?></td>
    <td><?php echo '<anh src="' . $row['anh'] . '" style="width: 100px; height: auto;" />'; ?></td>
    <td><?php echo $row['madocgia']; ?></td>
    <td><?php echo $row['hoten']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['gioitinh']; ?></td>
    <td><?php echo date('d/m/Y', strtotime($row['ngaysinh'])); ?></td>
    <td><?php echo $row['sdt']; ?></td>
    <td><?php echo $row['diachi']; ?></td>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['password']; ?></td>
    <td><?php echo $row['trangthai']; ?></td>     
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
