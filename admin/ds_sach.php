<?php
require('layouts/header.php');
require('Classes/PHPExcel.php'); 
?>
<?php
require('./../connect.php'); ?>

<?php
$search = "";
$category = "";
$limit = 10;
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
$sql = "SELECT * FROM sach WHERE tensach LIKE '%$search%'";

// Nếu người dùng đã chọn khoa từ dropdown, thêm điều kiện vào câu truy vấn
if ($category !== "") {
  $sql .= " AND khoaID = '$category'";
}

$query = mysqli_query($conn, $sql . " LIMIT $offset, $limit");
$count = mysqli_num_rows(mysqli_query($conn, $sql));
$totalPage = ceil($count / $limit) ?? 0;
?>

<?php
// Kiểm tra nếu biến session đã được thiết lập, tức là biểu mẫu đã được gửi
if (isset($_SESSION['success_message'])) {
  echo "<div style='color: green;'>" . $_SESSION['success_message'] . "</div>";
  unset($_SESSION['success_message']); // Xóa biến session sau khi hiển thị thông điệp
}
$success_count = 0;
if (isset($_POST['btngui'])) {
  $file = $_FILES['files']['tmp_name'];
  $objReader = PHPExcel_IOFactory::createReaderForFile($file);
  $objExcel = $objReader->load($file);
  $sheetData = $objExcel->getActiveSheet()->toArray(true, true, true, true,);
  $highestRow = $objExcel->getActiveSheet()->getHighestRow();
  for ($row = 2; $row <= $highestRow; $row++) {
    $title = $sheetData[$row]['A'];
    $image = $sheetData[$row]['B'];
    $content = $sheetData[$row]['C'];
    $contens = $sheetData[$row]['D'];
    $sql = "INSERT INTO sach (tensach, anh, gioithieusach, noidungdientu,) VALUES ('$tensach', '$anh', '$gioithieusach', '$noidungdientu',)";

    if (mysqli_query($conn, $sql)) {
      $success_count++; // Tăng biến đếm nếu thêm thành công
    }
  }
  if ($success_count > 0) {
    $_SESSION['success_message'] = "Thêm thành công $success_count bản ghi.";
    header("Location: " . $_SERVER['PHP_SELF']); // Load lại trang để hiển thị thông báo
    exit();
  } else {
    echo "Không có bản ghi nào được thêm vào."  . $mysql->error;
  }
} else {
  echo "Vui lòng chọn một tệp để tải lên.";
}
?>
<div class="content-wrapper" style="min-height: 365px;">
  <section class="content">
    <div class="container-fluid">
      <h3><b>TẤT CẢ SÁCH</b></h3></br>
        <div class="form-wrapper">
          <form action="" method="GET">
            <input type="text" name="txtsearch" class="searchform" />
            <button class="sbutton" type="submit">Tìm Sách</button>
          </form>
        </div>
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
                echo "<option value='" . $row_category['id'] . "' $selected>" . $row_category['tenkhoa'] . "</option>";
              }
              ?>
            </select>
            <button class='sbutton' type="submit">Search</button>
          </form>
        </div>
        <div class="form-wrapper">
          <form class="form1" action="" method="POST" enctype="multipart/form-data">
            <div class="custom-file-upload" style="color: #2d3436; border-radius: 10px;">
              <input type="file" id="file-input" name="files">
              <button class="sbutton" type="submit" id="btngui" name="btngui" value="IMPORT">Up Excel</button>
            </div>
          </form>
        </div>
    </div></br>

    
    <div class="row">
      <div class="table-responsive">
        <table cellspacing="0" cellpadding="0" class="table" style="display: block !important; overflow-x: auto !important; width: 100% !important;">
          <thead>
            <tr>
              <td scope="row">ID</td>
              <td scope="row">Tittle</td>
              <td scope="row">Ảnh</td>
              <td scope="row">Nội dung</td>
              <td scope="row">Khoa</td>
              <td scope="row">Số Lượng</td>
              <td scope="row">Số Lượng Còn Lại</td>
              <td scope="row">Nhà Xuất Bản</td>
              <td scope="row">Tác Giả</td>
              <td scope="row">Ngôn Ngữ</td>
              <td scope="row">Năm Xuất Bản</td>
              <td scope="row" colspan="2"><a href="them_sach.php">Thêm</a></td>
            </tr>
            <thead>
              <?php while ($row = mysqli_fetch_array($query)) : ?>
                <tr>
                  <td><?php echo   $row['id']; ?></td>
                  <td><?php echo $row['tensach']; ?></td>
                  <td><?php echo '<img  src=' . $row['anh'] . ' width=170px;/>'; ?></td>
                  <td style="text-align: left;"><?php echo substr($row['gioithieusach'], 0, 500); ?></td>
                  <td>
                    <?php
                    $id = $row['khoaID'];
                    if ($id == 0 || $id == null) {
                      echo "Chưa có thể loại";
                    } else {
                      $querytheloai =  "SELECT `tenkhoa` FROM `khoa` WHERE `id` = $id";
                      // Thực thi truy vấn
                      $result = $conn->query($querytheloai);
                      if ($result->num_rows == 1) {
                        // Lấy mảng chứa dữ liệu
                        $rows = $result->fetch_row();

                        // Lấy giá trị từ mảng
                        $name = $rows[0];

                        // Sử dụng biến $name ở đây cho mục đích của bạn
                        echo "$name";
                      }
                    }

                    ?>
                  </td>
                  <td><?php echo $row['soluong']; ?></td>
                  <td><?php echo $row['soluong_conlai']; ?></td>
                  <td><?php echo $row['nhaxuatban']; ?></td>
                  <td><?php echo $row['tacgia']; ?></td>
                  <td><?php echo $row['ngonngu']; ?></td>
                  <td><?php echo $row['namxuatban']; ?></td>
                  <td><a href="sua_sach.php?id=<?php echo $row['id']; ?>">Sửa</a></td>
                  <td><a href="xoa_sach.php?id=<?php echo $row['id']; ?>">Xóa</a></td>
                </tr>
              <?php endwhile; ?>
        </table>

        <?php
        for ($i = 1; $i <= $totalPage; $i++)
          if ($i == $page) {
            echo "<a href = 'ds_sach.php?p=$i' style='font-size: 20px; color: red; margin: 0px 4px;'> $i </a>";
          } else {
            echo "<a href = 'ds_sach.php?p=$i' style='margin: 0px 2px;'> $i </a>";
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
    padding-top: 10px;
    color: #1E90FF;
  }

  .form {
    border: 2px solid black;
    border-radius: 5px;
  }

  /* Điều chỉnh khoảng cách giữa hai nút */
  .form1 {
    margin-bottom: 10px;
  }

  .form-wrapper {
    display: inline-block;
    margin-right: 20px;
    /* Khoảng cách giữa hai form */
  }

  .searchtheloai {
    width: 181px;
    height: 28px;
  }
</style>