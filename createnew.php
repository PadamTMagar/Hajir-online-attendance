<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>

<?php require_once('aetsheader.php'); ?>
<?php require_once('aetssidebar.php'); ?>  

<div class="container">
    <div class="add_user">
        <div class="add_header">
            <span class="user">Add user</span>
        </div>


        <div class="user_details">
            <form action="" name="adduser" method="POST">


                <div class="user_name">
                    <label for="fname" id="fname">First Name</label>
                    <input type="text" name="firstname" id="fistname">
                    <label for="mname" id="mname">Mid Name</label>
                    <input type="text" name="midname" id="midname">
                    <label for="lname" id="lname">Last Name</label>
                    <input type="text" name="lastname" id="lastname">
                </div>


                <div class="user_socialmed">
                    <label for="" id=""></label>
                    <input type="text" name="" id="">
                    <label for="" id=""></label>
                    <input type="text" name="" id="">
                </div>
            </form>
                    
        </div>
    </div>
</div>

</body>
</html>