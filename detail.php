<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details</title>
    <link rel="stylesheet" href="detail.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
<?php require_once('aetsheader.php'); ?>
<?php require_once('aetssidebar.php'); ?> 

    <div class="container">
        <div class="formbox">
        <h1>Contact Form</h1>
        <form action="#" method="post">
            <div class="formrow">
                <label for="contact-type">Contact Type:</label>
                <select id="contact-type" name="contact_type" required>
                    <option value="">Select</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>
            
            <div class="formrow">
                <label for="full-name">Full Name:</label>
                <input type="text" id="full-name" name="full_name" placeholder="Enter your full name" required>
                
                <label for="class-type">Class Type:</label>
                <select id="class-type" name="class_type" required>
                    <option value="">Select</option>
                    <option value="class1">Class 1</option>
                    <option value="class2">Class 2</option>
                    <option value="class3">Class 3</option>
                    <option value="class4">Class 4</option>
                </select>
            </div>
            
            <div class="formrow">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                
                
            </div>

            <label>Gender:</label>
            
            <div class="gender">
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female" required>
                <label for="female">Female</label>
            </div>
            
            <div class="formrow">
                <label for="contact">Contact:</label>
                <input type="tel" id="contact" name="contact" placeholder="Enter contact number" required>
                
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter phone number">
            </div>

            <div class="formrow">

                <label for="permanent-address">Permanent Address:</label>
                <input type="text" id="permanent-address" name="permanent_address" placeholder="Enter permanent address" required>
                
                <label for="temporary-address">Temporary Address:</label>
                <input type="text" id="temporary-address" name="temporary_address" placeholder="Enter temporary address">
            </div>

            <div class="formrow">
                <label for="father-name">Father's Name:</label>
                <input type="text" id="father-name" name="father_name" placeholder="Enter father's name" required>
                
                <label for="father-occupation">Father's Occupation:</label>
                <input type="text" id="father-occupation" name="father_occupation" placeholder="Enter father's occupation" required>
            </div>

            <div class="formrow">
                <label for="father-number">Father's Contact:</label>
                <input type="tel" id="father-number" name="father_number" placeholder="Enter father's contact number" required>
            </div>

            <div class="formrow">
                <label for="mother-name">Mother's Name:</label>
                <input type="text" id="mother-name" name="mother_name" placeholder="Enter mother's name" required>
                
                <label for="mother-phone">Mother's Contact:</label>
                <input type="tel" id="mother-phone" name="mother_phone" placeholder="Enter mother's contact number" required>
    
            </div>

            <div class="formrow">
                <label for="mother-phone">Gurgian's Name:</label>
                <input type="tel" id="gurgian-name" name="gurgian-name" placeholder="Enter gurgian's name" required>
                
                <label for="mother-phone">Gurgian's Contact:</label>
                <input type="tel" id="gurgian-phone" name="gurgian-phone" placeholder="Enter gurgian's contact number" required>
            </div>
            <div class="submit">
                <button type="submit">Submit</button>
            </div>
                   
        </form>
        </div>  
    </div>
</body>
</html>