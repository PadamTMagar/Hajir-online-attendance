<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
<?php require_once('aetsheader.php'); ?>
<?php require_once('aetssidebar.php'); ?>


    <div class="contact">
        <h1>Add a new Contact</h1>
        
        <div class="box">
            <label for="optionlist">Contact Type:</label>
            <select class  ="dropdown" id="cnttype">
                <option value="Teacher">Teacher</option>
                <option value="Student">Student</option>
            </select>
        </div>

        <div class="inputbox">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your full name">    
        </div>

        <div class="box">
            <label for="optionlist">Class:</label>
            <select class  ="dropdown" id="class">
                <option value="Teacher">BCA</option>
                <option value="Student">BBM</option>
                <option value="Student">BBM</option>
                <option value="Student">BBM</option>
                <option value="Student">BBM</option>
                <option value="Student">BBM</option>
                <option value="Student">BBM</option>
            </select>
        </div>

        <div class="inputbox">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email">    
        </div>
        
        
        <div class="inputbox">
            <span class="details">Gender</span>
            <input type="radio" name="Gender" value="M">
            <span>Male</span>   
            <input type="radio" name="Gender" value="F">
            <span>Female</span>
        </div>


        <div class="inputbox">
            <span class="details">Contact</span>
            <input type="text" placeholder="Enter your contact number">    
        </div>
        

        <div class="inputbox">
            <span class="details">Phone</span>
            <input type="text" placeholder="Enter your phone number">    
        </div>


        <div class="inputbox">
            <span class="details">Permanent Address</span>
            <input type="text" placeholder="Enter your Permanent Address ">    
        </div>

        <div class="inputbox">
            <span class="details">Temporary Address</span>
            <input type="text" placeholder="Enter your Temporary Address">    
        </div>
        <div class="inputbox">

            <span class="details">Father Name</span>
            <input type="text" placeholder="Enter your father name">    
        </div>
        <div class="inputbox">
            <span class="details">Father Occupation</span>
            <input type="text" placeholder="Enter your Father Occupation">    
        </div>
        <div class="inputbox">
            <span class="details">Number</span>
            <input type="text" placeholder="Enter your father number ">    
        </div>
        <div class="inputbox">
            <span class="details">Mother Name</span>
            <input type="text" placeholder="Enter your mother name">    
        </div>
        <div class="inputbox">
            <span class="details">Number</span>
            <input type="text" placeholder="Enter your mother number">    
        </div>
        <div class="inputbox">
            <span class="details">Gar</span>
            <input type="text" placeholder="Enter your ">    
        </div>
        <div class="inputbox">
            <span class="details"></span>
            <input type="text" placeholder="Enter your ">    
        </div>


       
        </div>
</body>
</html>