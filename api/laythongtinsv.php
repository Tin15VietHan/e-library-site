<?php
$server = 'localhost';
$user = 'u395921506_Vtvp7';
$pass = 'AnhquocQH@2002@';
$database = 'u395921506_PqhSG';

class SinhVien {
    public $id;
    public $masv;
    public $matkhau;
    public $lop;
    public $khoa;
    public $img;

    function __construct($id, $masv, $matkhau, $lop, $khoa, $img) {
        $this->id = $id;
        $this->masv = $masv;
        $this->matkhau = $matkhau;
        $this->lop = $lop;
        $this->khoa = $khoa;
        $this->img = $img;
    }
}

$conn = mysqli_connect($server, $user, $pass, $database); // Fixed variable names
mysqli_set_charset($conn, 'utf8');

$id = $_GET['id']; // Nhận ID từ yêu cầu GET

$sql = "SELECT * FROM `sinhvien` WHERE `id` = '$id'";
$query = mysqli_query($conn, $sql);

$arr = array();

while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['id'];
    $masv = $row['masv'];
    $matkhau = $row['matkhau'];
    $lop = $row['lop'];
    $khoa = $row['khoa'];
    $img = $row['img'];

    array_push($arr, new SinhVien($id, $masv, $matkhau, $lop, $khoa, $img));
}

$json = json_encode($arr);
echo $json;
?>
