<?php

include('../../connectdb.php');

$loginName = $_POST["loginName"];
$loginEmail = $_POST["loginEmail"];
$loginPassword = md5($_POST["loginPassword"]);
$securityQ = $_POST["securityQ"];
$securityAns = md5($_POST["securityAns"]);

$stmt = $pdo->prepare("SELECT COUNT(*) FROM login WHERE loginName = ?");
$stmt->execute([$loginName]);
$count = $stmt->fetchColumn();
if ($count > 0) { 
    echo '<script>alert("Login Name already exists!"); window.location.href = "createAcc.php";</script>';
    exit();
}

$stmt = $pdo->prepare("SELECT loginID FROM login WHERE loginID LIKE :pattern ORDER BY loginID DESC LIMIT 1");
$pattern = date('Y') . '%';
$stmt->bindParam(':pattern', $pattern);
$stmt->execute();
$lastLoginID = $stmt->fetchColumn();
if ($lastLoginID) {
    $lastFourDigits = substr($lastLoginID, -4);
    $newID = date('Y') . sprintf('%04d', intval($lastFourDigits) + 1);
} else {
    $newID = date('Y') . '0001';
}

$stmt = $pdo->prepare("INSERT INTO login (loginID, type, loginName, loginEmail, loginPassword, securityQ, securityAns) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bindParam(1, $newID);
$stmt->bindParam(2, $type);
$stmt->bindParam(3, $loginName);
$stmt->bindParam(4, $loginEmail);
$stmt->bindParam(5, $loginPassword);
$stmt->bindParam(6, $securityQ);
$stmt->bindParam(7, $securityAns);

if ($_POST["type"] === "A") {
    $type = "A";
} elseif ($_POST["type"] === "F") {
    $type = "SF";
} elseif ($_POST["type"] === "T") {
    $type = "T";
} elseif ($_POST["type"] === "S") {
    $type = "S";
} elseif ($_POST["type"] === "P") {
    $type = "P";
}

$stmt->execute();
$stmt = null;
$pdo = null;

echo '<script>alert("Account created successfully!"); window.location.href = "createAcc.php";</script>';
exit();
?>
