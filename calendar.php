<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>

    

    <div class="calendarbox">
        <header class="calandar-header">
            <p class="calandar-current-date"></p>
            <div class="calandar-navbar">
                <span id="calander-prev"><i class="fa-solid fa-chevron-left"></i></span>
                <span id="calander-next"><i class="fa-solid fa-chevron-right"></i></span>
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
                <li>Sat</li>
            </ul>
            <ul class="dates"></ul>
        </div>
    </div>

    <script>
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();

        const daysContainer = document.querySelector(".dates");
        const currentDate = document.querySelector(".calandar-current-date");
        const arrowIcons = document.querySelectorAll(".calandar-navbar span");

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

        const renderCalendar = () => {
            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();
            const prevLastDate = new Date(year, month, 0).getDate();
            const lastDay = new Date(year, month + 1, 0).getDay();

            let liTags = "";

            // last month some days
            for (let i = firstDay; i > 0; i--) {
                liTags += `<li class="inactive">${prevLastDate - i + 1}</li>`;
            }

            // running month days
            for (let i = 1; i <= lastDate; i++) {
                let isToday =
                    i === date.getDate() &&
                    month === new Date().getMonth() &&
                    year === new Date().getFullYear()
                        ? "active"
                        : "";
                liTags += `<li class="${isToday}">${i}</li>`;
            }

            // upcomming month days
            for (let i = 1; i <= 6 - lastDay; i++) {
                liTags += `<li class="inactive">${i}</li>`;
            }

            currentDate.innerText = `${months[month]} ${year}`;
            daysContainer.innerHTML = liTags;
        };

        renderCalendar();

        arrowIcons.forEach((icon) => {
            icon.addEventListener("click", () => {
                month = icon.id === "calander-prev" ? month - 1 : month + 1;

                if (month < 0 || month > 11) {
                    date = new Date(year, month, new Date().getDate());
                    year = date.getFullYear();
                    month = date.getMonth();
                } else {
                    date = new Date();
                }

                renderCalendar();
            });
        });
    </script>
</body>
</html>