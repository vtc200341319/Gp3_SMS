<?php
session_start();
require_once '../../connectdb.php';

if (isset($_SESSION['loginName'])) {
    $studentRegNumber = $_SESSION['loginName'];

    $sql = "SELECT DISTINCT MONTH(`date`) AS month FROM student_attendence_record_daily WHERE studentRegNumber = :studentRegNumber";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':studentRegNumber', $studentRegNumber);
    $stmt->execute();

    $months = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $selectedMonth = null;

    if (isset($_GET['month'])) {
        $selectedMonth = $_GET['month'];
        $sql = "SELECT `date`, `attendTime`, `timeslot`, `status`, `reason` FROM student_attendence_record_daily WHERE studentRegNumber = :studentRegNumber AND MONTH(`date`) = :selectedMonth";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':studentRegNumber', $studentRegNumber);
        $stmt->bindParam(':selectedMonth', $selectedMonth);
        $stmt->execute();

        $attendanceRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $sql = "SELECT `date`, `attendTime`, `timeslot`, `status`, `reason` FROM student_attendence_record_daily WHERE studentRegNumber = :studentRegNumber AND MONTH(`date`) = MONTH(CURRENT_DATE())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':studentRegNumber', $studentRegNumber);
        $stmt->execute();

        $attendanceRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $selectedMonth = date('n');
    }
} else {
    header("Location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Attendance Records</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            tr:hover {
                background-color: #f5f5f5;
            }

            h1, p {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <h1>Attendance Records</h1>

        <form action="" method="GET">
            <label for="month">Select Month:</label>
            <select name="month" id="month" onchange="this.form.submit()">
                <option value=""> --- </option>
<?php for ($month = 1; $month <= 12; $month++): ?>
                    <option value="<?php echo $month; ?>" <?php echo ($selectedMonth == $month) ? 'selected' : ''; ?>>
                    <?php echo date('F', mktime(0, 0, 0, $month, 1)); ?>
                    </option>
                    <?php endfor; ?>
            </select>
            <noscript><input type="submit" value="Submit"></noscript>
        </form>

<?php if (isset($attendanceRecords)): ?>
            <?php if (count($attendanceRecords) > 0): ?>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Attendance Time</th>
                        <th>Timeslot</th>
                        <th>Status</th>
                        <th>Reason</th>
                    </tr>
        <?php foreach ($attendanceRecords as $record): ?>
                        <tr>
                            <td><?php echo $record['date']; ?></td>
                            <td><?php echo $record['attendTime']; ?></td>
                            <td><?php echo $record['timeslot']; ?></td>
                            <td><?php echo $record['status']; ?></td>
                            <td><?php echo $record['reason']; ?></td>
                        </tr>
        <?php endforeach; ?>
                </table>
                <?php else: ?>
                <p>No attendance records found for the selected month.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Please select a month to view attendance records.</p>
        <?php endif; ?>
    </body>
</html>
