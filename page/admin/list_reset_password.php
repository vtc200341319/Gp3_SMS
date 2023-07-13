<?php
require_once('../../connectdb.php');

$response = array('success' => false, 'error' => null);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginID = $_POST['loginID'];
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];

    if ($new_password == $confirm_password) {
        $hashed_password = md5($new_password);
        $stmt2 = $pdo->prepare("UPDATE `login` SET `loginPassword` = :hashed_password, `state` = 'Active', `LastPwdChangeDate` = NOW() WHERE `loginID` = :loginID");
        $stmt2->execute([':hashed_password' => $hashed_password, ':loginID' => $loginID]);

        $response['success'] = true;
    } else {
        $response['error'] = 'Passwords do not match.';
    }
} else {
    $response['error'] = 'Invalid request method.';
}

header('Content-type: application/json');
echo json_encode($response);
