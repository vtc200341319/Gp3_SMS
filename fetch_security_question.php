<?php
session_start();
require_once('connectdb.php');

header('Content-Type: application/json');
$response = array();

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $stmt = $pdo->prepare("SELECT * FROM `login` WHERE (loginID = :username OR loginName = :username OR loginEmail = :username)");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $securityQ = $user['securityQ'];
        $stmt2 = $pdo->prepare("SELECT `questionID`, `question` FROM `securityquestion` WHERE `questionID` = :securityQ");
        $stmt2->execute([':securityQ' => $securityQ]);
        $question = $stmt2->fetch(PDO::FETCH_ASSOC);

        if ($question) {
            $response['question'] = $question['question'];
        } else {
            $response['error'] = 'Error fetching security question';
        }
    } else {
        $response['error'] = 'Username not found';
    }
} else {
    $response['error'] = 'Invalid request';
}

echo json_encode($response);
?>
