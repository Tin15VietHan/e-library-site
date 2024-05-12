<?php
$host = 'localhost';
$username = 'id21773647_library';
$password = 'Tt15@20092002';
$database = 'id21773647_library';


class categories{
    function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
}


$conn = mysqli_connect("$host","$username","$password","$database");
mysqli_set_charset($conn, 'utf8');

$sql = 'SELECT * FROM `categories`';
$query = mysqli_query($conn, $sql);

$arr = array();

while($row = mysqli_fetch_assoc($query)){
    $id = $row['id'];
    $name = $row['name'];
  
    
    array_push($arr, new categories ($id, $name));
}
$json = json_encode($arr);
echo $json;
?>

