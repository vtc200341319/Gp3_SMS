<?php
session_start();
require_once('connectdb.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['loginID'];
    $securityQuestion = $_POST['securityQ'];
    $securityAnswer = md5($_POST['securityAns']); 

    $stmt = $pdo->prepare("UPDATE `login` SET `securityQ` = :securityQuestion, `securityAns` = :securityAnswer WHERE `loginID` = :username");
    $stmt->execute([':securityQuestion' => $securityQuestion, ':securityAnswer' => $securityAnswer, ':username' => $username]);

    if ($stmt->rowCount() > 0) {
        $response = ['success' => true];
        echo json_encode($response);
        exit;
    } else {
        $response = ['success' => false, 'error' => 'Failed to set security question. Please try again.'];
        echo json_encode($response);
        exit;
    }
} else {
    $response = ['success' => false, 'error' => 'Invalid request.'];
    echo json_encode($response);
    exit;
}
?>
