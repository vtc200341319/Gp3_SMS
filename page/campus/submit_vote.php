<?php
session_start();
require_once('connectdb.php');

if (!isset($_POST['submit_vote'])) {
    header("Location: campus_voting.php");
    exit();
}

if (!isset($_POST['pid']) || !isset($_POST['choice'])) {
    die("Missing required fields");
}

$pollingID = $_POST['pid'];
$choice = $_POST['choice'];

$result_column = "result_" . $choice;

$query = "UPDATE `polling` SET `$result_column` = `$result_column` + 1 WHERE `PollingID` = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$pollingID]);

header("Location: campus_voting.php");
exit();
