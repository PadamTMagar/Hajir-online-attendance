<?php
include('aetsconn.php'); // Ensure you have a file to handle DB connection

// Get the user_id from the URL (example: viewclass.php?id=123)
$user_id = $_GET['id']; // Fetch the user_id from URL

// Fetch attendance data for the user (Present or Absent)
$query = "SELECT attendance_date, status FROM attendance WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

$attendance = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Ensure the format of the date is YYYY-MM-DD
    $attendance[$row['attendance_date']] = $row['status'];
}

// Pass the attendance data to JavaScript
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Calendar</title>
    <style>
        /* Your existing CSS for the calendar */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calendarbox {
            background-color: #fff;
            width: 800px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .calendarbox header {
            display: flex;
            align-items: center;
            padding: 25px 30px 10px;
            justify-content: space-between;
        }
        header .calandar-current-date {
            font-size: larger;
            font-weight: bold;
            color: #0056b3;
        }
        header .calandar-navbar {
            display: flex;
            gap: 20px;
        }
        header .calandar-navbar span {
            height: 40px;
            width: 40px;
            margin: 0 1px;
            cursor: pointer;
            text-align: center;
            border-radius: 50%;
            line-height: 40px;
            user-select: none;
            color: #aeabab;
            font-size: 25px;
        }
        .calandar-navbar span:hover {
            background: #0056b3;
            color: white;
        }
        .calander-body {
            padding: 20px;
        }
        .calander-body ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            text-align: center;
        }
        .calander-body li {
            width: calc(100% / 7);
            font-size: 18px;
            color: #414141;
        }
        .calander-body .days li {
            cursor: default;
            font-weight: 600;
        }
        .calander-body .dates li {
            margin-top: 30px;
            position: relative;
            z-index: 1;
            cursor: pointer;
            text-align: center;
        }
        .dates li.inactive {
            color: #aaa;
        }
        .dates li.active {
            color: #fff;
        }
        .dates li::before {
            position: absolute;
            content: "";
            z-index: -1;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
        .dates li.active::before {
            background: #0056b3;
        }
        .dates li:not(.active):hover::before {
            background: #e4e1e1;
        }

        /* Add new styles for the attendance colors */
        .present {
            background-color: blue;
            color: white;
        }

        .absent {
            background-color: red;
            color: white;
        }
    </style>
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
            "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
        ];

        // PHP to JS - Passing the attendance data
        const attendance = <?php echo json_encode($attendance); ?>;

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

                // Format the current date as YYYY-MM-DD with leading zeros
                let currentDateStr = `${year}-${(month + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;

                // Check if attendance is marked for the current day
                let statusClass = "";
                if (attendance[currentDateStr] === 'Present') {
                    statusClass = "present";
                } else if (attendance[currentDateStr] === 'Absent') {
                    statusClass = "absent";
                }

                liTags += `<li class="${isToday} ${statusClass}">${i}</li>`;
            }

            // upcoming month days
            for (let i = 1; i <= 6 - lastDay; i++) {
                liTags += `<li class="inactive">${i}</li>`;
            }

            currentDate.innerText = `${months[month]} ${year}`;
            daysContainer.innerHTML = liTags;
        };

        renderCalendar();

        // Handling the month navigation
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
