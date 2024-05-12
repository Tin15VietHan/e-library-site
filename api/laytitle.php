<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'webtintuc';


class posts{
    function __construct($id, $title){
        $this->id = $id;
        $this->title = $title;
    }
}

$conn = mysqli_connect("$server","$user","$pass","$database");
mysqli_set_charset($conn, 'utf8');

$sql = 'SELECT * FROM `posts`';
$query = mysqli_query($conn, $sql);

$arr = array();

while($row = mysqli_fetch_assoc($query)){
    $id = $row['id'];
    $title = $row['title'];
    
    array_push($arr, new posts($id, $title));
}
$json = json_encode($arr);
echo $json;
?>

