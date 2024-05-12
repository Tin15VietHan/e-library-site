<?php
ob_start();
session_start();
?>
<?php
require('./../connect.php'); ?>
<?php

function sanitize_input($data)
{
    // Tạo bảng ánh xạ các ký tự có dấu sang các ký tự không dấu
    $charMap = array(
        'à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a',
        'è' => 'e', 'é' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e',
        'ì' => 'i', 'í' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
        'ò' => 'o', 'ó' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o',
        'ù' => 'u', 'ú' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
        'ỳ' => 'y', 'ý' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
        'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a',
        'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
        'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
        'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',
        'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
        'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
        'đ' => 'd',
    );

    // Loại bỏ các ký tự đặc biệt và chuyển đổi thành chữ thường
    $data = mb_strtolower($data, 'UTF-8');

    // Thực hiện ánh xạ các ký tự có dấu sang các ký tự không dấu
    $data = strtr($data, $charMap);

    // Thay dấu cách bằng gạch ngang
    $data = str_replace(' ', '-', $data);
    return $data;
}

$Url_Anh_Bia = "";
$Url_Pdf = "";
// $sql = "SELECT *FROM posts inner join account on posts.user_id=account.id";
// $sql = "SELECT *FROM posts inner join categories on posts.category_id=categories.id";
$sql_category = "SELECT * FROM categories";
$sql_post = "SELECT * FROM posts";


$query_category = mysqli_query($conn, $sql_category);
if (isset($_POST['sbm'])) {
        if($_POST['title'] == Null){
        $title = "Sách chưa có tên";
    }else{
        $title = $_POST['title'];
    }

    // $image = $_FILES['image']['name'];
    // $image_tmp = $_FILES['image']['tmp_name'];
    if(isset($_FILES['image'])) {
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        
        // Đường dẫn đến thư mục chứa file PDF
        $upload_directory = "../Database/anh_bia/";
    
        // Di chuyển file vào thư mục pdf
        if(move_uploaded_file($file_tmp, $upload_directory . $file_name)) {
            $Url_Anh_Bia = "https://dulieuappdoctruyen.000webhostapp.com/Database/anh_bia/" . $file_name;
        } else {
            echo "Có lỗi xảy ra khi lưu ảnh.";
        }
    }

    $content = $_POST['content'];

    if(isset($_FILES['file'])) {
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];
        
        // Đường dẫn đến thư mục chứa file PDF
        $upload_directory = "../Database/pdf/";
    
        // Di chuyển file vào thư mục pdf
        if(move_uploaded_file($file_tmp, $upload_directory . $file_name)) {
            $Url_Pdf = "https://dulieuappdoctruyen.000webhostapp.com/Database/pdf/" . $file_name;
        } else {
            echo "Có lỗi xảy ra khi lưu file.";
        }
    }


    $category = $_POST['category_id'];
    $category_id = (int)$category;
    $soluong = $_POST['soluong'];
    $idaccount = $_SESSION['account_admin']['id'];  
    $accounts_id = (int)$idaccount;


    $status = $_POST['status'];

    $sql = "INSERT INTO posts (title,  image, content, contens, category_id, soluong, accounts_id, status, view) VALUES ('$title', '$Url_Anh_Bia', '$content', '$Url_Pdf', '$category_id', '$soluong','$accounts_id', '$status', '0')";
    if (mysqli_query($conn, $sql))
    //Thông báo nếu thành công
    {
        echo 'Thêm thành công';
        header("location: ds_sach.php");
    } else
        //Hiện thông báo khi không thành công
        echo 'Không thành công. Lỗi' . mysqli_error($conn);
    // move_uploaded_file($image_tmp, '../image/' . $image);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sách</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
</head>

<body>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Thêm Sách</h2>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="">Tên sách</label>
                        <input type="text" name="title" class="form-control" require>
                    </div>

                    <div class="form-group">
                        <label for="">Ảnh bìa</label>
                        <input type="file" name="image" id="image" class="form-control" onchange="checkFileImage()">
                        <div id="fileError" style="color: red;"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Nội dung giới thiệu</label>
                        <textarea type="file" name="content" class="form-control form-control-size" id="content" require></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Nội dung sách (File Pdf, không có thì để trống)</label>
                        <input type="file" name="file" id="file" onchange="checkFile()" class="form-control">
                        <div id="fileError2" style="color: red;"></div>
                    </div>

                    <div class="form-group">

                        <label for="">Thể loại</label>
                        <select name="category_id" id="category_id">
                            <?php while ($row = mysqli_fetch_assoc($query_category)) : ?>
                                <option value=<?php echo $row['id']; ?>> <?php echo $row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Số Lượng</label>
                        <input type="int" name="soluong" class="form-control" require>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="radio" name="status" value="PUBLIC" checked>Public
                        <input type="radio" name="status" value="PRIVATE"> Private
                    </div>

                    <button name="sbm" class="btn btn-success">Thêm</button>
                </form>
            </div>
        </div>

    </div>
</body>

</html>

<script>
    CKEDITOR.replace('content');
</script>



<script> // dùng kiểm tra file được up lên
    function checkFile() {
        var fileInput = document.getElementById('file');
        var file = fileInput.files[0];
        var fileName = file.name;
        var fileExt = fileName.split('.').pop().toLowerCase();

        var allowedExtensions = ['pdf'];

        if (!allowedExtensions.includes(fileExt)) {
            document.getElementById('fileError').innerHTML = "Chỉ được phép upload các file có định dạng PDF.";
            fileInput.value = ''; // Xóa giá trị đã chọn để người dùng có thể chọn lại
            return false;
        } else {
            document.getElementById('fileError').innerHTML = '';
            return true; // Cho phép form được submib
            
            // có thể thêm code lưu vào đoạn này được không
        }
    }
    function checkFileImage(){
        var fileInput = document.getElementById('image');
        var file = fileInput.files[0];
        var fileName = file.name;
        var fileExt = fileName.split('.').pop().toLowerCase();

        var allowedExtensions = ['jpg','png','jpeg','webp'];

        if (!allowedExtensions.includes(fileExt)) {
            document.getElementById('fileError2').innerHTML = "Chỉ được phép upload các file có định dạng IPG, PNG, JPEG, WEBP.";
            fileInput.value = ''; // Xóa giá trị đã chọn để người dùng có thể chọn lại
            return false;
        } else {
            document.getElementById('fileError2').innerHTML = '';
            return true; // Cho phép form được submib
            
            // có thể thêm code lưu vào đoạn này được không
        }
    }
</script>