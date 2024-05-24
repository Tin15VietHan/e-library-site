<?php
require('layouts/header.php');
require('./../connect.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    // Nếu không có id được truyền, chuyển hướng người dùng
    header('Location: ds_nguoi_muon_sach.php');
    exit(); // Dừng kịch bản để tránh tiếp tục thực thi mã
}

$query = mysqli_query($conn, "SELECT * FROM `muon_sach` WHERE id='$id'");
$row = mysqli_fetch_assoc($query);
$nguoitao = isset($_SESSION['hoten']) ? $_SESSION['hoten'] : '';

if (isset($_POST['update_user'])) {
    $madocgia = $_POST['madocgia'];
    $hoten = $_POST['hoten'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $sachmuon = $_POST['sach_muon'];
    $ngayhentra = $_POST['ngay_hen_tra'];
    $trangthai = $_POST['trang_thai'];

    $sql = "UPDATE `muon_sach` SET madocgia='$madocgia', hoten='$hoten', sdt='$sdt', diachi='$diachi', sach_muon='$sachmuon', ngay_hen_tra='$ngayhentra', trang_thai='$trangthai', ngaycapnhat = CURRENT_TIMESTAMP() , nguoitao = '$nguoitao' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công";
        header("location: ds_nguoi_muon_sach.php");
        exit(); // Dừng kịch bản sau khi chuyển hướng
    } else {
        echo "Cập nhật thất bại: " . $conn->error;
    }
}
?>

<div class="fix_form">
    <form method="POST" class="form2">
        <h2>Sửa Người Mượn Sách</h2>
        <label>Mã Độc Giả: <input type="text" value="<?php echo $row['madocgia']; ?>" name="madocgia"></label><br />
        <label>Tên Người Mượn: <input type="text" value="<?php echo $row['hoten']; ?>" name="hoten"></label><br />
        <label>Số Điện Thoại: <input type="number" value="<?php echo $row['sdt']; ?>" name="sdt"></label><br />
        <label>Địa Chỉ: <input type="text" value="<?php echo $row['diachi']; ?>" name="diachi"></label><br />
        <label>Sách Đang Mượn: </label><br />
        <textarea class="form-control" rows="3" name="sach_muon" style="width: 400px; color:black;"><?php echo $row['sach_muon']; ?></textarea>
        <label>Ngày Mượn: <input type="datetime-local" value="<?php echo $row['ngay_muon']; ?>" name="ngay_muon" readonly></label><br />
        <label>Ngày Hẹn Trả: <input type="datetime-local" value="<?php echo $row['ngay_hen_tra']; ?>" name="ngay_hen_tra"></label><br />
        <label for="trang_thai">Trạng thái:</label>
<select name="trang_thai" id="trang_thai" class="status">
    <option value="Đang Mượn" <?php if($row['trang_thai'] == 'Đang Mượn') echo 'selected'; ?>>Đang Mượn</option>
    <option value="Đã Trả" <?php if($row['trang_thai'] == 'Đã Trả') echo 'selected'; ?>>Đã Trả</option>
    <option value="Đã Quá Hạn Trả" <?php if($row['trang_thai'] == 'Đã Quá Hạn Trả') echo 'selected'; ?>>Đã Quá Hạn Trả</option>
</select>


        <input type="submit" value="Update" name="update_user" class="update_user">
    </form>
</div>
<style>
    .form2 h2 {
        background-color: white;
    }

    .fix_form {
        justify-content: center;
        padding-top: 15px;
        padding-bottom: 20px;
        margin-left: 250px;
    }

    .form2 {
        width: 450px;
        border: 1px solid #007bff;
        padding: 20px;
        margin: 0 auto;
        font-weight: 700px;
        background-color: white;
        margin-top: 0%;
    }

    .form2 label {
        background-color: white;
    }

    label input {
        width: 400px;
        height: 35px;
        padding: 10px 0;
        margin: 10px 0;
        border-radius: 5px;
        background-color: white;
    }

    .role option {
        background-color: white;
    }

    .status {
        margin: 7px 5px;
        width: 310px;
        height: 30px;
        border-radius: 5px;
        background-color: white;
    }

    .status option {
        background-color: white;
    }

    .update_user {
        height: 35px;
        padding: 5px;
        margin-top: 35px;
        border-radius: 5px;
        width: 150px;
        background-color: #007bff;
        color: #fff;
        border: 1px solid #fff;
        margin-left: 33%;
    }
</style>
<?php require('layouts/footer.php'); ?>
