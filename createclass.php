<?php
include("aetsheader.php");
include("aetssidebar.php");
include("aetsconn.php");
?>
<?php
$error = '';
$succes_msg = '';

$error = '';
$succes_msg = '';

$sql = "SELECT * FROM role_db";
$result = mysqli_query($conn, $sql);
$roles = [];
while ($role = mysqli_fetch_assoc($result)) {
    $roles[] = $role;
}


if(isset($_POST['submit'])){
    $classname = $_POST['class_name'];
    $classteacher = $_POST['class_teacher'];
    $class_size = $_POST['class_size'];

    if (empty($classname) || empty($classteacher) || empty($class_size)) {
        $error = "All fields are required!";
    } else {
        $verify_query = mysqli_query($conn , "SELECT classroom_name FROM classroom WHERE classroom_name='$classname'");
        if(mysqli_num_rows($verify_query) != 0) {
            $error = "This classroom is already created";
        } else {
            $insert_data = "INSERT INTO classroom(classroom_name, class_teacher, class_size) VALUES ('$classname', '$classteacher', '$class_size')";
            if(mysqli_query($conn , $insert_data)) {
                $succes_msg = "Classroom Created";
            } else {
                $error = "Classroom is not created: " . mysqli_error($conn);
            }
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
                    <span>Class Details</span> 
            </div>
                        <form action="" method="POST">
                        <div class="class_details">
                            <div class="form_row">
                                <div class="form_group">
                                    <label for="class_name" id="class_name">Class Name:</label>
                                    <input type="text" name="class_name" id="class_name" placeholder="Class Name" >
                                </div>

                                <div class="form_group">
                                    <label for="class_teacher" id="class_teacher">Class Teacher:</label>
                                    <select name="class_teacher" id="class_teacher" >
                                        <option value="">Please Select</option>
                                        <?php 
                                        foreach($roles as $role) {
                                            echo "<option value='" . $role['rolename'] . "'>" . $role['rolename'] . "</option>";
                                        }
                                    ?>
                                    </select>
                                </div>

                                
                                <div class="form_group">
                                    <label for="class_size" id="class_size">Size of classroom:</label>
                                    <input type="number" name="class_size" id="class_size" placeholder="Size of classroom" >
                                </div>
                            </div>
                            </div>
                            <div class="update_button">
                                <button class="role_update" type="submit" name="submit">Create</button>
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