<?php

require_once('aetsconn.php');

?>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $filename = $_FILES["image"]["name"];
    $temp_name = $_FILES["image"]["tmp_name"];
    $folder = "profilePic/". $filename;
    
    // echo $folder;

    if (move_uploaded_file($temp_name, $folder)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "No file uploaded.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="picture" id="pic">Photo</label>
        <input type="file" name="image" id="image" placeholder="image"> <br><br>
        <input type="submit" name="submit" value="Upload file">
    </form>
</body>
</html>

