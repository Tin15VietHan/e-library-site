<?php
$server = 'localhost';
$user = 'u395921506_thuvienviethan';
$pass = 'AnhquocQH@2002@';
$database = 'u395921506_thuvienviethan';

// Establish database connection
$conn = mysqli_connect($server, $user, $pass, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8');

// Check if khoaID is provided
if (isset($_GET["khoaID"])) {
    $khoaID = mysqli_real_escape_string($conn, $_GET["khoaID"]);

    // Define a sach class for better data structure
    class Sach {
        public $id;
        public $tensach;
        public $anh;
        
        function __construct($id, $tensach, $anh) {
            $this->id = $id;
            $this->tensach = $tensach;
            $this->anh = $anh;
        }
    }

    $sql = "SELECT * FROM `sach` WHERE `khoaID` = '$khoaID'";
    $query = mysqli_query($conn, $sql);

    $posts = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $id = $row['id'];
            $tensach = $row['tensach'];
            $anh = $row['anh'];
            
            $post = new Sach($id, $tensach, $anh);
            $posts[] = $post;
        }
        // Convert posts array to JSON and echo it
        echo json_encode($posts);
    } else {
        // Handle query error gracefully
        die("Query failed: " . mysqli_error($conn));
    }

    mysqli_close($conn);
} else {
    // Handle case where khoaID is not provided
    echo "Category ID not provided.";
}
?>
