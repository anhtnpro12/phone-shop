<!-- Trong bài này các files tải lên sẽ được lưu trong thư mục uploads -->

<?php
    $extension_ok = false;
    $has_file = true;
    if(isset($_POST['create'])) {
        $permitted_extension = ['png', 'gif', 'jpg', 'jpeg'];
        $file_name = $_FILES['upload']['name'];
        if (!empty($file_name)) {
            $generated_file_name = time() . '-' . $file_name;
            $file_tmp_name = $_FILES['upload']['tmp_name'];
            $destination_path = "uploads/$generated_file_name";
            $file_extension = explode('.', $file_name);
            $file_extension = strtolower(end($file_extension));
            if(in_array($file_extension, $permitted_extension)) {
                move_uploaded_file($file_tmp_name, $destination_path);
                $extension_ok = true;                        
            }
        } else {
            $has_file = false;
        }        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <h2>Upload</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" id="createForm" method="post" enctype="multipart/form-data">            
            <div class="form-control">
                <input type="file" name="upload" accept="image/png, image/gif, image/jpeg">
                <?php
                    if (isset($_POST['create'])) {
                        if ($extension_ok && $has_file) {
                            echo '<span id="success" style="color: green; font-size: 12px;display: block;">Upload successful</span>';                            
                        } else {                                                            
                            if (!$has_file)
                                echo '<span id="extension-error" style="color: red; font-size: 12px;display: block;">There are no files</span>';    
                            else 
                                echo '<span id="extension-error" style="color: red; font-size: 12px;display: block;">File extension invalid</span>';
                        }
                    }
                ?>                                
            </div>                                   
            
            <div class="wrapper">
                <input type="submit" name="create" value="Upload" id="create"> 
            </div>           
        </form>
    </div> 
    
    <script src="./createScript.js"></script>        
</body>

</html>