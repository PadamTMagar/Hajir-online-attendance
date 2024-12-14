<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <!-- <a href="notice" onclick="display()"></a> -->
    <div id="popup" class="popup">
        <div class="popupcontent">
            <h1>Notice!</h1>
            <p>Good Morning every one today is holiday</p>
        </div>
        <button class="close" onclick="close()"><i class="fa-solid fa-x"></i></button>
    </div>

    <script>
        function display{
            document.getElementById('popup').style.display = 'flex';
        }
        
        function close{
            document.getElementById('popup');
        }
    </script>
</body>
</html>