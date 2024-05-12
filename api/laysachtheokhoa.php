<?php
$host = 'localhost';
$username = 'id21773647_library';
$password = 'Tt15@20092002';
$database = 'id21773647_library';

// Establish database connection
$conn = mysqli_connect($host, $username, $password, $database);
mysqli_set_charset($conn, 'utf8');

// Check if category_id is provided
if (isset($_GET["category_id"])) {
    $category_id = mysqli_real_escape_string($conn, $_GET["category_id"]);

    // Define a Post class for better data structure
    class Post {
        public $id;
        public $title;
        public $image;
        
        function __construct($id, $title, $image) {
            $this->id = $id;
            $this->title = $title;
            $this->image = $image;
        }
    }

    $sql = "SELECT * FROM `posts` WHERE `category_id` = '$category_id'";
    $query = mysqli_query($conn, $sql);

    $posts = array();

    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $id = $row['id'];
            $title = $row['title'];
            $image = $row['image'];
            
            $post = new Post($id, $title, $image);
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
    // Handle case where category_id is not provided
    echo "Category ID not provided.";
}
?>
