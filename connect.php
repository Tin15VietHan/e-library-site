<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'elibrary';

// $server = 'localhost';
// $user = 'id21773647_library';
// $pass = 'It15@123456';
// $database = 'id21773647_library';


$conn = mysqli_connect($server, $user, $pass, $database);
if ($conn) {
    mysqLi_query($conn, "SET NAMES 'utf8' ");
} else {
    exit('Lỗi kết nối: ' . mysqli_connect_error());
}
