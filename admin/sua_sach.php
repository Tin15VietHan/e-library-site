<?php
require('./../connect.php'); 
function sanitize_input($data) {
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
 ?>
<?php
    $id = $_GET['id'];


    // $sql_post = "SELECT * FROM posts";
    $sql_category= "SELECT * FROM categories";
    $sql_post = "SELECT * FROM posts";

    $sql_up = "SELECT * FROM posts WHERE id = $id";
    $query_up = mysqli_query($conn, $sql_up);
    $row_up = mysqli_fetch_assoc($query_up);
    if(!$row_up){
        header("Location: ../ds_sach.php");
    }

    $query_category = mysqli_query($conn, $sql_category);
    if(isset($_POST['sbm'])){

        $title = $_POST['title'];
        
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        if(!empty($image_tmp)){
            move_uploaded_file($image_tmp, '../../image/'.$image);
        }

        
        $content = $_POST['content'];
        
        $category_id = $_POST['category_id'];

        $status = $_POST['status'];

        $account = $_POST['taikhoanadmin_id'];
        $taikhoanadmin_id = (int)$account;

        $sql = "UPDATE posts SET title ='$title', image = '$image', content = '$content', category_id= $category_id,status= '$status',  taikhoanadmin_id= $taikhoanadmin_id, updated_at = CURRENT_TIMESTAMP() where id = $id";
        
        $query = mysqli_query($conn, $sql);
       
        header("Location: ../admin/ds_sach.php");
       
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document2</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

</head>
<body>
    
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2>Sửa bài viết</h2>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input type="text" name="title" class="form-control" require value="<?php echo $row_up['title'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Ảnh bài viết</label>
                        <input type="file" name="image" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea name="content" class="form-control form-control-size" id="content" value="" require><?php echo $row_up['content'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Thể loại</label>
                        <select name="category_id" id="category_id">
                            <?php while ($row = mysqli_fetch_assoc($query_category)):?>
                                <option value=<?php echo $row['id'];?> <?php if($row['id'] == $row_up['category_id']) echo 'checked';?>> <?php echo $row['name'];?></option>
                            <?php endwhile;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="radio" name="status" value="PUBLIC" <?php if($row_up['status'] == 'PUBLIC') echo 'checked';?>>Public
                        <input type="radio" name="status" value="PRIVATE" <?php if($row_up['status'] == 'PRIVATE') echo 'checked';?>> Private
                    </div>
    
                    <div class="form-group">
                        <label for="">Người viết</label>
                        <input type="text" name="taikhoanadmin_id" class="form-control" require value="<?php echo $row_up['taikhoanadmin_id'] ?>">
                    </div>
                    
                    <button name= "sbm" class="btn btn-success">Sửa</button>
                </form>
            </div>
        </div>
    
    </div>
    <script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>