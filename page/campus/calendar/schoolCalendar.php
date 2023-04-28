<?php
require_once 'connectdb.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>School Calendar</title>
    <link href="../../../css/SchoolCalendar.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <form method="GET">
        <label for="month">Select Month:</label>
        <select name="month" id="month">
            <option value="all">All Months</option>
            <option value="Jan">January</option>
            <option value="Feb">February</option>
            <option value="Mar">March</option>
            <option value="Apr">April</option>
            <option value="May">May</option>
            <option value="Jun">June</option>
            <option value="Jul">July</option>
            <option value="Aug">August</option>
            <option value="Sep">September</option>
            <option value="Oct">October</option>
            <option value="Nov">November</option>
            <option value="Dec">December</option>
        </select>
        <button type="submit">Go</button>
    </form>

    <table>
        <tr>
            <th>Month</th>
            <th>Day</th>
            <th>Status</th>
            <th>Holiday/Event Name</th>
        </tr>
        <?php
            if (isset($_GET['month'])) {
                $month = $_GET['month'];
                if ($month === 'all') {
                    $stmt = $pdo->query("SELECT month, day, status, holidayName, eventName FROM school_calendar");
                } else {
                    $stmt = $pdo->prepare("SELECT month, day, status, holidayName, eventName FROM school_calendar WHERE month = ?");
                    $stmt->execute([$month]);
                }
            } else {
                $stmt = $pdo->query("SELECT month, day, status, holidayName, eventName FROM school_calendar");
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['month'] . "</td>";
                echo "<td>" . $row['day'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>" . $row['holidayName'] . " " . $row['eventName'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
