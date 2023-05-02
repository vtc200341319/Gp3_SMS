<?php
session_start();
require_once('connectdb.php');

$currentDateTime = date("Y-m-d H:i:s");

$query = "SELECT `PollingID`, `startTime`, `endTime`, `question`, `firstChoice`, `secondChoice`, `thirdChoice`, `fourthChoice`, `targetClass`, `targetPerson`, `result_1`, `result_2`, `result_3`, `result_4` FROM `polling` WHERE `endTime` > ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$currentDateTime]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../../css/campus_voting.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Voting</title>
</head>
<body>
    <h1>Campus Voting</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>View Result</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter = 1; ?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><a href="vote.php?pid=<?php echo $row['PollingID']; ?>"><?php echo $row['question']; ?></a></td>
                    <td><?php echo $row['startTime']; ?></td>
                    <td><?php echo $row['endTime']; ?></td>
                    <td>
                       <button onclick="viewResults('<?php echo $row['PollingID']; ?>', '<?php echo $row['question']; ?>', '<?php echo $row['result_1']; ?>', '<?php echo $row['result_2']; ?>', '<?php echo $row['result_3']; ?>', '<?php echo $row['result_4']; ?>', '<?php echo $row['firstChoice']; ?>', '<?php echo $row['secondChoice']; ?>', '<?php echo $row['thirdChoice']; ?>', '<?php echo $row['fourthChoice']; ?>')">View Result</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-question"></h2>
            <canvas id="resultChart"></canvas>
        </div>
    </div>
    
    <script src="../../js/campus_voting.js" type="text/javascript"></script>
</body>
</html>
