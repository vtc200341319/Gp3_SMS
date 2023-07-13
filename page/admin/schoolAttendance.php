
<!DOCTYPE html>
<html>
    <head>
        <title>Student Attendance</title>

        <style>
            body {
                font-family: Arial, sans-serif;
            }

            h1 {
                text-align: center;
            }

            form {
                margin-bottom: 20px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            tr:hover {
                background-color: #f5f5f5;
            }

            button {
                margin-bottom: 10px;
            }

            .message {
                margin-top: 20px;
            }
        </style>

        <script>
            function selectAll() {
                var checkboxes = document.getElementsByName('attendance[]');
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = true;
                }
            }
        </script>
    </head>

    <body>
        <h1>Student Attendance</h1>

        <form method="post" action="">
            <label for="date">Select Date:</label>
            <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" required>

            <label for="classNumber">Select Class Number:</label>
            <select name="classNumber" id="classNumber" required>
                <option value="">-- Select Class Number --</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>

            <label for="className">Select Class Name:</label>
            <select name="className" id="className" required>
                <option value="">-- Select Class Name --</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <input type="submit" value="Submit">
        </form>

        <?php
        if (isset($_POST['date']) && isset($_POST['classNumber']) && isset($_POST['className'])) {
            $date = $_POST['date'];
            $classNumber = $_POST['classNumber'];
            $className = $_POST['className'];

            require_once '../../connectdb.php';

            $sql = "SELECT * FROM student_attendence_record_daily AS a INNER JOIN student AS s ON a.studentRegNumber = s.studentRegNumber WHERE a.date = :date AND s.classNumber = :classNumber AND s.className = :className";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':classNumber', $classNumber);
            $stmt->bindParam(':className', $className);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo '<h2>Selected Date: ' . $date . '</h2>';
                echo '<h2>Selected Class: ' . $classNumber . ' - ' . $className . '</h2>';

                echo '<table>';
                echo '<tr><th>#</th><th>English Name</th><th>Chinese Name</th><th>Attendance Time</th><th>Timeslot</th><th>Status</th></tr>';

                $rowNumber = 1;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $rowNumber++ . '</td>';
                    echo '<td>' . $row['studentEngName'] . '</td>';
                    echo '<td>' . $row['studentChiName'] . '</td>';
                    echo '<td>' . $row['attendTime'] . '</td>';
                    echo '<td>' . $row['timeslot'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                $studentSql = "SELECT * FROM student WHERE classNumber = :classNumber AND className = :className";
                $studentStmt = $pdo->prepare($studentSql);
                $studentStmt->bindParam(':classNumber', $classNumber);
                $studentStmt->bindParam(':className', $className);
                $studentStmt->execute();

                if ($studentStmt->rowCount() > 0) {
                    echo '<h2>Selected Date: ' . $date . '</h2>';
                    echo '<h2>Selected Class: ' . $classNumber . ' - ' . $className . '</h2>';

                    echo '<form method="post" action="">';
                    echo '<table id = "attendanceTable">';
                    echo '<tr><th>Student No.</th><th>English Name</th><th>Chinese Name</th><th>Attendance</th></tr>';

                    $rowNumber = 1;

                    while ($row = $studentStmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $row['studentRegNumber'] . '</td>';
                        echo '<td>' . $row['studentEngName'] . '</td>';
                        echo '<td>' . $row['studentChiName'] . '</td>';
                        echo '<td><input type="checkbox" name="attendance[]" value="' . $row['studentRegNumber'] . '"></td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                    echo '<input type="hidden" name="date" value="' . $date . '">';
                    echo '<input type="hidden" name="classNumber" value="' . $classNumber . '">';
                    echo '<input type="hidden" name="className" value="' . $className . '">';


                    if (!isset($_POST['attendance']) && isset($_POST['date']) && isset($_POST['classNumber']) && isset($_POST['className'])) {
                        echo '<button onclick="selectAll()">Select All</button>';
                    }

                    if ($studentStmt->rowCount() > 0) {
                        echo '<input id = "attsubmit" type="submit" value="Take Attendance">';
                    } else {
                        echo '<p>No students found for the selected class number and class name.</p>';
                    }

                    echo '</form>';
                } else {
                    echo '<p>No students found for the selected class number and class name.</p>';
                }
            }
        }

        if (isset($_POST['attendance'])) {
            $date = $_POST['date'];
            $classNumber = $_POST['classNumber'];
            $className = $_POST['className'];

            $attendance = $_POST['attendance'];

            require_once '../../connectdb.php';

            $insertSql = "INSERT INTO student_attendence_record_daily (date, studentRegNumber, status, attendTime, timeslot) VALUES (:date, :studentRegNumber, 'Present', '07:45:00', '07:45:00')";
            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->bindParam(':date', $date, PDO::PARAM_STR);

            foreach ($attendance as $studentRegNumber) {
                $insertStmt->bindParam(':studentRegNumber', $studentRegNumber);
                $insertStmt->execute();
            }

            echo '<script>document.getElementById("attendanceTable").style.display = "none";</script>';
            echo '<script>document.getElementById("attsubmit").style.display = "none";</script>';
            echo '<p>Attendance records have been successfully added.</p>';
        }
        ?>

    </body>
</html>
