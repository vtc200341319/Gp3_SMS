<!DOCTYPE html>
<html>
    <head>
        <title>Homework</title>
        <link href="../../css/homework.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        session_start();

        $month = isset($_GET['month']) ? intval($_GET['month']) : date('m');
        $year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

        $currentYear = date('Y');
        $currentMonth = date('m');

        $prevMonth = $month - 1;
        $prevYear = $year;
        if ($prevMonth <= 0) {
            $prevMonth = 12;
            $prevYear--;
        }

        $nextMonth = $month + 1;
        $nextYear = $year;
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $firstDay = date('N', strtotime("$year-$month-01"));

        $dates = array();
        $currentDay = 1;

        for ($row = 0; $row < 6; $row++) {
            for ($col = 0; $col < 7; $col++) {
                if ($row === 0 && $col < $firstDay) {
                    $dates[$row][$col] = '';
                } else {
                    if ($currentDay <= $daysInMonth) {
                        $class = ($currentDay == date('j') && $month == $currentMonth && $year == $currentYear) ? 'current-day' : '';
                        $dates[$row][$col] = '<span class="' . $class . '" onclick="selectDate(' . $currentDay . ')">' . $currentDay . '</span>';
                        $currentDay++;
                    } else {
                        $dates[$row][$col] = '';
                    }
                }
            }
        }
        ?>

        <div class="calendar">          
            <div class="title">
                <h1>Homework</h1>
            </div>
            <h2>
                <span class="prev-month" onclick="prevMonth()">&lt;</span>
                <?php echo date('M Y', strtotime("$year-$month-01")); ?>
                <span class="next-month" onclick="nextMonth()">&gt;</span>
            </h2>
            <table>
                <thead>
                    <tr>
                        <th>Sun</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dates as $row) { ?>
                        <tr>
                            <?php foreach ($row as $date) { ?>
                                <td><?php echo $date; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="blackboard">

            <p id="selected-date" style="font-size: 30px; font-weight: bold; top: 10px;position: absolute;">
                Today:  <?php echo date('F j, Y'); ?>
            </p>
            <br>
            <br>
            <br>
            <?php if ($_SESSION['type'] == "T" || $_SESSION['type'] == "A") : ?>
                <label for="grade">Grade:</label>
                <select id="grade" onchange="updateClass()">
                    <option value="">---</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>

                <label for="class">Class:</label>
                <select id="class" onchange="updateClass()">
                    <option value="" >---</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            <?php endif; ?> 

            <p id="nameOFclass" style="font-size: 30px; font-weight: bold;">
                Class: 
            </p>

            <table>
                <tbody>
                    <tr>
                        <td>Chinese</td>
                        <?php if ($_SESSION['type'] == "T" || $_SESSION['type'] == "A") : ?>
                            <td><button onclick="addHomework('Chinese')">Add Homework</button></td>
                        <?php endif; ?> 
                    </tr>
                    <tr>
                        <td>English</td>
                        <?php if ($_SESSION['type'] == "T" || $_SESSION['type'] == "A") : ?>
                            <td><button onclick="addHomework('English')">Add Homework</button></td>
                        <?php endif; ?> 
                    </tr>
                    <tr>
                        <td>Mathematics</td>
                        <?php if ($_SESSION['type'] == "T" || $_SESSION['type'] == "A") : ?>
                            <td><button onclick="addHomework('Mathematics')">Add Homework</button></td>
                        <?php endif; ?> 
                    </tr>
                    <tr>
                        <td>Science</td>
                        <?php if ($_SESSION['type'] == "T" || $_SESSION['type'] == "A") : ?>
                            <td><button onclick="addHomework('Science')">Add Homework</button></td>
                        <?php endif; ?> 
                    </tr>
                    <tr>
                        <td>Technology</td>
                       <?php if ($_SESSION['type'] == "T" || $_SESSION['type'] == "A") : ?>
                            <td><button onclick="addHomework('Technology')">Add Homework</button></td>
                        <?php endif; ?> 
                    </tr>
                    <tr>
                        <td>Humanities</td>
                        <?php if ($_SESSION['type'] == "T" || $_SESSION['type'] == "A") : ?>
                            <td><button onclick="addHomework('Humanities')">Add Homework</button></td>
                        <?php endif; ?> 
                    </tr>
                </tbody>
            </table>
        </div>

        <script>
            function prevMonth() {
                var prevMonth = <?php echo $prevMonth; ?>;
                var prevYear = <?php echo $prevYear; ?>;
                window.location.href = "homework.php?month=" + prevMonth + "&year=" + prevYear;
            }

            function nextMonth() {
                var nextMonth = <?php echo $nextMonth; ?>;
                var nextYear = <?php echo $nextYear; ?>;
                window.location.href = "homework.php?month=" + nextMonth + "&year=" + nextYear;
            }

            function selectDate(date) {
                var today = new Date();
                var selectedDate = new Date(<?php echo $year; ?>, <?php echo $month - 1; ?>, date);

                if (selectedDate.toDateString() === today.toDateString()) {
                    document.getElementById('selected-date').textContent = "Today: " + selectedDate.toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'});
                } else {
                    document.getElementById('selected-date').textContent = "Date: " + selectedDate.toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'});
                }
            }

            function updateClass() {
                var grade = document.getElementById('grade').value;
                var classname = document.getElementById('class').value;
                document.getElementById('nameOFclass').textContent = "Class: " + grade + classname;
            }

            function addHomework(subject) {
                var homework = prompt("Enter homework for " + subject + ":");
                if (homework !== null && homework !== "") {
                    //SQL
                    alert("Homework added for " + subject + ": " + homework);
                }
            }
        </script>
    </body>
</html>
