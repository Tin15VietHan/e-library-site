<?php
$host = 'localhost';
$username = 'id21773647_library';
$password = 'Tt15@20092002';
$database = 'id21773647_library';


class posts{
    function __construct($id, $title,$image){
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
    }
}


$conn = mysqli_connect("$host","$username","$password","$database");
mysqli_set_charset($conn, 'utf8');

$sql = 'SELECT * FROM `posts`';
$query = mysqli_query($conn, $sql);

$arr = array();

while($row = mysqli_fetch_assoc($query)){
    $id = $row['id'];
    $title = $row['title'];
    $image = $row['image'];
    
    array_push($arr, new posts ($id, $title,$image));
}
$json = json_encode($arr);
echo $json;
?>

