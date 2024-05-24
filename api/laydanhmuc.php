<?php
$server = 'localhost';
$user = 'u395921506_thuvienviethan';
$pass = 'AnhquocQH@2002@';
$database = 'u395921506_thuvienviethan';

class khoa{
    public $id;
    public $tenkhoa;

    function __construct($id, $tenkhoa){
        $this->id = $id;
        $this->tenkhoa = $tenkhoa;
    }
}

$conn = mysqli_connect($server, $user, $pass, $database); // Fix variable names here
mysqli_set_charset($conn, 'utf8');

$sql = 'SELECT * FROM `khoa`';
$query = mysqli_query($conn, $sql);

$arr = array();

while($row = mysqli_fetch_assoc($query)){
    $id = $row['id'];
    $tenkhoa = $row['tenkhoa'];
    
    array_push($arr, new khoa ($id, $tenkhoa));
}

$json = json_encode($arr);
echo $json;
?>
