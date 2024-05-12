<?php
$host = 'localhost';
$username = 'id21773647_library';
$password = 'Tt15@20092002';
$database = 'id21773647_library';

$id = $_GET["id"];
class posts{
    function __construct($id,$contens){
        $this->id = $id;
        $this->	contens = $contens;

      
    }
}
$conn = mysqli_connect("$host","$username","$password","$database");
mysqli_set_charset($conn, 'utf8');

$sql = "SELECT * FROM `posts` WHERE `id` = '$id'";
$query = mysqli_query($conn, $sql);

$arr = array();

while($row = mysqli_fetch_assoc($query)){
    $id = $row['id'];
    $contens = $row['contens'];

    
    array_push($arr, new posts($id, $contens));
}
$json = json_encode($arr);
echo $json;
?>

