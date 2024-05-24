<?php
$server = 'localhost';
$user = 'u395921506_thuvienviethan';
$pass = 'AnhquocQH@2002@';
$database = 'u395921506_thuvienviethan';

$id = $_GET["id"];

class Sach {
    public $id;
    public $noidungdientu;

    function __construct($id, $noidungdientu) {
        $this->id = $id;
        $this->noidungdientu = $noidungdientu;
    }
}

$conn = mysqli_connect($server, $user, $pass, $database);
mysqli_set_charset($conn, 'utf8');

$sql = "SELECT * FROM `sach` WHERE `id` = '$id'";
$query = mysqli_query($conn, $sql);

$arr = array();

while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['id'];
    $noidungdientu = $row['noidungdientu']; // Corrected variable name
    
    array_push($arr, new Sach($id, $noidungdientu)); // Corrected variable name
}

$json = json_encode($arr);
echo $json;
?>
