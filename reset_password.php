<?php
session_start();
require_once('connectdb.php');

header('Content-Type: application/json');
$response = array();

if (!isset($_POST['username'])) {
    $response['success'] = false;
    $response['error'] = 'Username is required.';
} elseif (!isset($_POST['newPassword'])) {
    $response['success'] = false;
    $response['error'] = 'New password is required.';
} elseif (!isset($_POST['confirmPassword'])) {
    $response['success'] = false;
    $response['error'] = 'Confirm password is required.';
} else {
    $username = $_POST['username'];
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];

    if ($new_password === $confirm_password) {
        $stmt = $pdo->prepare("SELECT * FROM `login` WHERE (loginID = :username OR loginName = :username OR loginEmail = :username)");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $hashed_password = md5($new_password);
            $stmt2 = $pdo->prepare("UPDATE `login` SET `loginPassword` = :hashed_password, `state` = 'Active', `LastPwdChangeDate` = NOW() WHERE (loginID = :username OR loginName = :username OR loginEmail = :username)");
            $stmt2->execute([':hashed_password' => $hashed_password, ':username' => $username]);

            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = 'Username not found';
        }
    } else {
        $response['success'] = false;
        $response['error'] = 'Passwords do not match';
    }
}

echo json_encode($response);
?>
