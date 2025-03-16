
<?php
include("aetsheader.php");
// include("aetssidebar.php");
require_once('aetsvalidside.php');
include("aetsconn.php");

$error = '';
$succes_msg = '';
$update_query = ''; // Initialize to avoid undefined variable issue

$id = $_GET['id'] ?? '';
$classname = '';
$class_size = '';

if (!empty($id)) {
    $query = "SELECT * FROM classroom WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $classname = $row['classroom_name']; // Fixed incorrect column name
        $class_size = $row['class_size'];
    } else {
        $error = "Classroom not found!";
    }
}

if (isset($_POST['submit'])) {
    $classname = $_POST['class_name'];
    $class_size = $_POST['class_size'];

    if (empty($classname) || empty($class_size)) {
        $error = "All fields are required!";
    } else {
        $update_query = "UPDATE classroom SET classroom_name='$classname', class_size='$class_size' WHERE id='$id'";

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
    <title>Edit Classroom</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="addclass">
            <div class="class_header">
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
                                <label for="class_name">Class Name:</label>
                                <input type="text" name="class_name" id="class_name" value="<?php echo $classname; ?>">
                            </div>

                            <div class="form_group">
                                <label for="class_size">Size of classroom:</label>
                                <input type="number" name="class_size" id="class_size" value="<?php echo $class_size; ?>">
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
</body>
</html>
