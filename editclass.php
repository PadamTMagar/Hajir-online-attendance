<?php
include("aetsheader.php");
include("aetssidebar.php");
include("aetsconn.php");
?>

<?php
$error = '';
$succes_msg = '';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM Classroom WHERE id = $id";
    $result = mysqli_query($conn , $query);
    $row = mysqli_fetch_assoc($result);

    $classname = $row['class_name'];
    $classteacher = $row['class_teacher'];
    $class_size = $row['class_size'];
}

if (isset($_POST['submit'])) {
    $classname = $_POST['class_name'];
    $classteacher = $_POST['class_teacher'];
    $class_size = $_POST['class_size'];

    if (empty($classname) || empty($classteacher) || empty($class_size)) {
        $error = "All fields are required!";
    } else {    
        $update_query = "UPDATE classroom SET classroom_name='$classname', class_teacher='$classteacher', class_size='$class_size' WHERE id='$id'";

        if (mysqli_query($conn, $update_query)) {
            $succes_msg = "Classroom updated successfully!";
        } else {
            $error = "Error updating classroom: " . mysqli_error($conn);
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add classroom</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <div class="container">


        <div class="addclass">
            <div class="class_header" >
                <span class="class">Classes</span>
            </div>

        <div class="class_content">
            <div class="role_title">
                    <span>Edit Class </span> 
            </div>
                        <form action="" method="POST">
                        <div class="class_details">
                            <div class="form_row">
                                <div class="form_group">
                                    <label for="class_name" id="class_name">Class Name:</label>
                                    <input type="text" name="class_name" id="class_name"  value="<?php echo isset($classname) ? $classname : ''; ?>">
                                </div>

                                <div class="form_group">
                                    <label for="class_teacher" id="class_teacher">Class Teacher:</label>
                                    <select name="class_teacher" id="class_teacher" value="<?php echo isset($classteacher) ? $classteacher : ''; ?>">
                                        <option value="">Please Select</option>
                                        <option value="hari">hari</option>
                                        <option value="shyam">shyam</option>
                                    </select>
                                </div>

                                
                                <div class="form_group">
                                    <label for="class_size" id="class_size">Size of classroom:</label>
                                    <input type="text" name="class_size" id="class_size" value="<?php echo isset($class_size) ? $class_size : ''; ?>">
                                </div>
                            </div>
                            </div>
                            <div class="update_button">
                                <button class="role_update" type="submit" name="submit">Update</button>
                            </div>
                        </form>

                        <div class="error_msg"><?php echo $error;?></div>
                        <div class="succes_msg"><?php echo $succes_msg;?></div>
                        </div>
        </div>

      
    </div>
</div>
</body>
</html>