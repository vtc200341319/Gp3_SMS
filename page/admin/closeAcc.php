<?php
session_start();
require_once('../../connectdb.php');

if($_SESSION['type'] !== 'A'){
    header('Location: index.php');
    exit;
}

$loginID = $_GET['loginID'];

$stmt = $pdo->prepare("UPDATE `login` SET `state` = 'Close' WHERE `loginID` = :loginID");
$stmt->execute([':loginID' => $loginID]);

header("Location: listuser.php");
exit;
?>
