<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
    <div class="calendarbox">
        <header class="calandar-header">
            <p class="calandar-current-date">

            </p>
            <div class="calandar-navbar">
                <span id="calander-prev" ><i class="fa-solid fa-chevron-left"></i></span>
                <span id="calander-next" ><i class="fa-solid fa-chevron-right"></i></span>
            </div>
        </header>

        <div class="calander-body">
            <ul class="days">
                <li>Sun</li>
                <li>Mon</li>
                <li>Tue</li>
                <li>Wed</li>
                <li>Thu</li>
                <li>Fri</li>
                <li1>Sat</li1>
            </ul>
            <ul class="dates"></ul>
        </div>
    </div>



    <script>
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();

        const day = document.querySelector("dates");

        const currentdate =document.querySelector("calandar-current-date");

        const arrowicons = document.querySelectorAll(".calandar-navbar span");

        const months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ];
    
        const main
    </script>
</body>
</html>