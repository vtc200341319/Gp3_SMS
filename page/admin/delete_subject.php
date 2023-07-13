<?php
require_once '../../connectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM subject WHERE subjectID = ?");
    $stmt->execute([$id]);

    header("Location: subject.php");
    exit();
}
?>
