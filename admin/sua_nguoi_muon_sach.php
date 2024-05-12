<?php
require('layouts/header.php'); ?>
<?php
require('./../connect.php'); ?>

<?php
$id=$_GET['id'];
$query=mysqli_query($conn,"select * from `muon_sach` where id='$id'");
$row=mysqli_fetch_assoc($query);
$fullname =  $_SESSION['fullname'];
?>
<div class="fix_form">
<form method="POST" class="form2">
<h2>Sửa Người Mượn Sách</h2>
<label>Mã Sinh Viên: <input type="text" value="<?php echo $row['masv']; ?>" name="masv"></label><br/>
<label>Tên Người Mượn: <input type="text" value="<?php echo $row['ten_nguoi_muon']; ?>" name="ten_nguoi_muon"></label><br/>
<label>Số Điện Thoại: <input type="number" value="<?php echo $row['sdt']; ?>" name="sdt"></label><br/>
<label>Địa Chỉ: <input type="text" value="<?php echo $row['dia_chi']; ?>" name="dia_chi"></label><br/>
<label>Sách Đang Mượn: </label><br/>
<textarea class="form-control" rows="3" name="sach_muon"  style="width: 400px; color:black;"><?php echo $row['sach_muon']; ?></textarea>
<label>Ngày Mượn: <input type="datetime-local" value="<?php echo $row['ngay_muon']; ?>" name="ngay_muon" readonly></label><br/>
<label>Ngày Hẹn Trả: <input type="datetime-local" value="<?php echo $row['ngay_hen_tra']; ?>" name="ngay_hen_tra"></label><br/>
<label>Trạng thái:<select name="trang_thai" class="status" value="<?php echo $row['trang_thai']; ?>" name="trang_thai">
            <option value="Đang Mượn">Đang Mượn</option>
            <option value="Đã Trả">Đã Trả</option>
            <option value="Đã Quá Hạn Trả">Đã Quá Hạn Trả</option>
         </select></label></br>           
<input type="submit" value="Update" name="update_user" class="update_user">
<?php
if (isset($_POST['update_user'])){
$id=$_GET['id'];
$masv=$_GET['masv'];
$tennguoimuon=$_POST['ten_nguoi_muon'];
$sdt=$_POST['sdt'];
$diachi=$_POST['dia_chi'];
$sachmuon=$_POST['sach_muon'];
$ngayhentra=$_POST['ngay_hen_tra'];
$trangthai=$_POST['trang_thai'];


// Create connection
$conn = new mysqli("localhost", "id21773647_library", "", "id21773647_library");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE `muon_sach` SET masv='$masv', ten_nguoi_muon='$tennguoimuon', sdt='$sdt', dia_chi='$diachi', sach_muon='$sachmuon', ngay_hen_tra='$ngayhentra', trang_thai='$trangthai', updated_at = CURRENT_TIMESTAMP() , data_creator = '$fullname'WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
echo "Cập nhật thành công";
header("location: ds_nguoi_muon_sach.php");
} else {
echo "Cập nhật thất bại: " . $conn->error;
}

$conn->close();
}
?>
</form>
</div>
</body>
</html>

<?php require('layouts/footer.php'); ?>

<style>


.form2 h2{
    background-color: white;
 }

.fix_form{
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

.form2 label{
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


.role option{
background-color: white;    
}

.status{
margin: 7px 5px;
width: 310px;
height: 30px;
border-radius: 5px;
background-color: white; 
}

.status option{
    background-color: white;
}

.update_user{
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
