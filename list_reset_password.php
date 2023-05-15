<?php
require_once('connectdb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginID = $_POST['loginID'];
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];

    if ($new_password == $confirm_password) {
        $hashed_password = md5($new_password);
        $stmt2 = $pdo->prepare("UPDATE `login` SET `loginPassword` = :hashed_password, `state` = 'Active' WHERE `loginID` = :loginID");
        $stmt2->execute([':hashed_password' => $hashed_password, ':loginID' => $loginID]);

        header("Location: listuser.php?reset_password_success=1");
    } else {

        header("Location: listuser.php?reset_password_error=1");
    }
} else {

    header("Location: listuser.php");
}
