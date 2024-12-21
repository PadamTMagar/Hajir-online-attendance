<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Styling for the clickable div */
        #openPopup {
            width: 150px;
            height: 50px;
            background-color: #4CAF50;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Styling for the popup */
        #popup {
            display: none; /* Hidden by default */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 5px;
            z-index: 1000;
        }

        /* Background overlay */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        /* Close button styling */
        .close-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>
<body>


    <div class="openpopup" id="openpopup">Click Me</div>

    <div class="background" id="background"></div>

    <div class="popup" id="popup">
        <p>tomorrow is holiday</p>
        <button class="close_btn" onclick="close_btn()">Close</button>
    </div>




    <script src="aetspopup.js"></script>
</body> 
</html>