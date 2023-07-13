<?php
session_start();
require_once('connectdb.php');

header('Content-Type: application/json');
$response = array();

if (isset($_POST['username']) && isset($_POST['answer'])) {
    $username = $_POST['username'];
    $answer = $_POST['answer'];

    $stmt = $pdo->prepare("SELECT * FROM `login` WHERE (loginID = :username OR loginName = :username OR loginEmail = :username)");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $securityAns = $user['securityAns'];

        if (md5($answer) === $securityAns) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = 'Incorrect security answer';
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Username not found';
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Invalid request';
}

echo json_encode($response);
?>
