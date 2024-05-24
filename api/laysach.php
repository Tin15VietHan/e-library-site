<?php
$server = 'localhost';
$user = 'u395921506_thuvienviethan';
$pass = 'AnhquocQH@2002@';
$database = 'u395921506_thuvienviethan';

class sach{
    public $id;
    public $tensach;
    public $anh;

    function __construct($id, $tensach,$anh){
        $this->id = $id;
        $this->tensach = $tensach;
        $this->anh = $anh;
    }
}

$conn = mysqli_connect($server, $user, $pass, $database); // Fix variable names here
mysqli_set_charset($conn, 'utf8');

$sql = 'SELECT * FROM `sach`';
$query = mysqli_query($conn, $sql);

$arr = array();

while($row = mysqli_fetch_assoc($query)){
    $id = $row['id'];
    $tensach = $row['tensach'];
    $anh = $row['anh'];    
    array_push($arr, new sach ($id, $tensach,$anh));
}

$json = json_encode($arr);
echo $json;
?>
