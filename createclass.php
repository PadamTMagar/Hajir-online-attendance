<?php
include("aetsheader.php");
include("aetssidebar.php");
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
                <span class="class_msg">Manage Classes</span>
            </div>

        <div class="class_content">
            <div class="role_title">
                    <span>Class Details</span> 
            </div>
            <div class="class_details">
                <div class="form_row">
                    <div class="form_group">
                        <label for="guardian_name" id="guardian_name">Class Name:</label>
                        <input type="text" name="guardian_name" id="guardian_name" placeholder="Class Name" required>
                    </div>
                    <div class="form_group">
                        <label for="guardian_contact" id="guardian_contact">Class Teacher:</label>
                        <input type="text" name="guardian_contact" id="guardian_contact" placeholder="Class Teacher" required>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>