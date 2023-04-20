<!-- Trong bài này các files tải lên sẽ được lưu trong thư mục uploads -->

<?php
    $has_file = false;
    if(isset($_POST['create'])) {        
        foreach($_FILES['upload']['name'] as $i => $file_name) {
            if (!empty($file_name)) {
                $has_file = true;
                $generated_file_name = time() . '-' . $file_name;
                $file_tmp_name = $_FILES['upload']['tmp_name'][$i];
                $destination_path = "uploads/$generated_file_name";
                move_uploaded_file($file_tmp_name, $destination_path);        
            }
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
                <input type="file" name="upload[]" multiple>
            </div>                                   
            <?php
                    if (isset($_POST['create'])) {
                        if ($has_file) {
                            echo '<span id="success" style="color: green; font-size: 12px;display: block;">Upload successful</span>';                            
                        } else {                                                                                        
                            echo '<span id="extension-error" style="color: red; font-size: 12px;display: block;">There are no files</span>';                                
                        }
                    }
                ?>
            <div class="wrapper">
                <input type="submit" name="create" value="Upload" id="create"> 
            </div>           
        </form>
    </div> 
    
    <script src="./createScript.js"></script>    
</body>

</html>