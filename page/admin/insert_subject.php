<?php
require_once '../../connectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subjectCode = $_POST['subjectCode'];
    $subjectName = $_POST['subjectName'];

    $stmt = $pdo->prepare("INSERT INTO subject (subjectCode, subjectName) VALUES (?, ?)");
    $stmt->execute([$subjectCode, $subjectName]);

    header("Location: subject.php");
    exit();
}
?>
