<?php

$host = 'localhost';
$username = 'your-username';
$password = 'your-password';
$dbname = 'your-dbname';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = 'SELECT * FROM activity_records';
$result = $conn->query($sql);
$records = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Activity Records</title>
    <link href="css/ActivityRecord.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <h1>Activity Records</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Activity</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($records) > 0): ?>
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo $record['date']; ?></td>
                        <td><?php echo $record['activity']; ?></td>
                        <td><?php echo $record['name']; ?></td>
                        <td><?php echo $record['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No activity records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <script src="js/ActivityRecord.js" type="text/javascript"></script>
</body>
</html>
