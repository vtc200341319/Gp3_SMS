<?php
session_start();
require_once('connectdb.php');

if (!isset($_GET['pid'])) {
    die("PollingID is missing");
}

$pollingID = $_GET['pid'];

$query = "SELECT * FROM `polling` WHERE `PollingID` = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$pollingID]);

$poll = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../../css/vote.css" rel="stylesheet" type="text/css"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - <?php echo $poll['question']; ?></title>
</head>
<body>
    <h1><?php echo $poll['question']; ?></h1>
    <form action="submit_vote.php" method="POST">
        <input type="hidden" name="pid" value="<?php echo $pollingID; ?>">
        <p>
            <input type="radio" name="choice" value="1" required>
            <?php echo $poll['firstChoice']; ?>
        </p>
        <p>
            <input type="radio" name="choice" value="2">
            <?php echo $poll['secondChoice']; ?>
        </p>
        <p>
            <input type="radio" name="choice" value="3">
            <?php echo $poll['thirdChoice']; ?>
        </p>
        <p>
            <input type="radio" name="choice" value="4">
            <?php echo $poll['fourthChoice']; ?>
        </p>
        <button type="submit" name="submit_vote">Vote</button>
    </form>
    <p><a href="campus_voting.php">Back to vote list</a></p>
</body>
</html>
