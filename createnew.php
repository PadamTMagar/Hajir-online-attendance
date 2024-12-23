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

                <div class="form_row">
                    <div class="from_group">
                        <label for="fname" id="fname">First Name:*</label>
                        <input type="text" name="firstname" id="fistname" placeholder="First Name">
                    </div>

                    <div class="from_group">
                        <label for="mname" id="mname">Mid Name:</label>
                        <input type="text" name="midname" id="midname" placeholder="Mid Name">
                    </div>

                    <div class="from_group">
                        <label for="lname" id="lname">Last Name:</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                    </div>
                </div>


                <div class="form_row">
                    <div class="from_group">
                        <label for="email" id="email">Email:*</label>
                        <input type="email" name="emailid" id="emailid" placeholder="Email">
                    </div>
                    
                    <div class="from_group">
                        <label for="number" id="num">Phone Number:*</label>
                        <input type="" name="number" id="number" placeholder="Phone Number">
                    </div>
                </div>
            </form>
                    
        </div>
    </div>
</div>

</body>
</html>