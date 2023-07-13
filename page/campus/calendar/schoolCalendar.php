<?php
require_once 'connectdb.php';
require_once '../../../js/fpdf/fpdf.php';

if (isset($_GET['month']) && isset($_GET['action']) && $_GET['action'] === 'download') {

    $month = $_GET['month'];

    if ($month === 'all') {
        $stmt = $pdo->query("SELECT month, day, status, holidayName, eventName FROM school_calendar");
    } else {
        $stmt = $pdo->prepare("SELECT month, day, status, holidayName, eventName FROM school_calendar WHERE month = ?");
        $stmt->execute([$month]);
    }

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Month', 1);
    $pdf->Cell(25, 10, 'Day', 1);
    $pdf->Cell(30, 10, 'Status', 1);
    $pdf->Cell(95, 10, 'Holiday/Event Name', 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 10);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(40, 10, $row['month'], 1);
        $pdf->Cell(25, 10, $row['day'], 1);
        $pdf->Cell(30, 10, $row['status'], 1);
        $pdf->Cell(95, 10, $row['holidayName'] . ' ' . $row['eventName'], 1);
        $pdf->Ln();
    }

    $pdf->Output('school_calendar.pdf', 'D');
    exit();
}
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
                    <option value="all" <?php if (isset($_GET['month']) && $_GET['month'] === 'all') echo 'selected'; ?>>All Months</option>
                    <option value="Jan" <?php if (isset($_GET['month']) && $_GET['month'] === 'Jan') echo 'selected'; ?>>January</option>
                    <option value="Feb" <?php if (isset($_GET['month']) && $_GET['month'] === 'Feb') echo 'selected'; ?>>February</option>
                    <option value="Mar" <?php if (isset($_GET['month']) && $_GET['month'] === 'Mar') echo 'selected'; ?>>March</option>
                    <option value="Apr" <?php if (isset($_GET['month']) && $_GET['month'] === 'Apr') echo 'selected'; ?>>April</option>
                    <option value="May" <?php if (isset($_GET['month']) && $_GET['month'] === 'May') echo 'selected'; ?>>May</option>
                    <option value="Jun" <?php if (isset($_GET['month']) && $_GET['month'] === 'Jun') echo 'selected'; ?>>June</option>
                    <option value="Jul" <?php if (isset($_GET['month']) && $_GET['month'] === 'Jul') echo 'selected'; ?>>July</option>
                    <option value="Aug" <?php if (isset($_GET['month']) && $_GET['month'] === 'Aug') echo 'selected'; ?>>August</option>
                    <option value="Sep" <?php if (isset($_GET['month']) && $_GET['month'] === 'Sep') echo 'selected'; ?>>September</option>
                    <option value="Oct" <?php if (isset($_GET['month']) && $_GET['month'] === 'Oct') echo 'selected'; ?>>October</option>
                    <option value="Nov" <?php if (isset($_GET['month']) && $_GET['month'] === 'Nov') echo 'selected'; ?>>November</option>
                    <option value="Dec" <?php if (isset($_GET['month']) && $_GET['month'] === 'Dec') echo 'selected'; ?>>December</option>
                </select>
            </select>
            <button type="submit">Go</button>
            <button type="submit" name="action" value="download">Download PDF</button>
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
