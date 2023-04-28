<?php

session_start();
require_once('connectdb.php');

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM `login` WHERE (loginID = :username OR loginName = :username OR loginEmail = :username)");
$stmt->execute([':username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    if ($user['state'] === 'Active') {
        if (md5($password) === $user['loginPassword']) {
            $_SESSION['loginID'] = $user['loginID'];
            $_SESSION['type'] = $user['type'];

            $stmt2 = $pdo->prepare("INSERT INTO `loginlog` (`loginID`, `type`, `loginName`, `state`, `loginDateTime`, `remark`) VALUES (:loginID, :type, :loginName, 'success', NOW(), '')");
            $stmt2->execute([':loginID' => $user['loginID'], ':type' => $user['type'], ':loginName' => $user['loginName']]);

            header("Location: main.php");
            exit;
        } else {
            $stmt3 = $pdo->prepare("INSERT INTO `loginlog` (`loginID`, `type`, `loginName`, `state`, `loginDateTime`, `remark`) VALUES (:loginID, :type, :loginName, 'fail', NOW(), 'wrong password')");
            $stmt3->execute([':loginID' => $user['loginID'], ':type' => $user['type'], ':loginName' => $user['loginName']]);

            $stmt4 = $pdo->prepare("SELECT COUNT(*) AS fail_count FROM `loginlog` WHERE `loginID` = :loginID AND `state` = 'fail' AND `loginDateTime` >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
            $stmt4->execute([':loginID' => $user['loginID']]);
            $result = $stmt4->fetch(PDO::FETCH_ASSOC);

            if ($result['fail_count'] >= 5) {
                $stmt5 = $pdo->prepare("UPDATE `login` SET `state` = 'Invalid' WHERE `loginID` = :loginID");
                $stmt5->execute([':loginID' => $user['loginID']]);

                $stmt6 = $pdo->prepare("INSERT INTO `loginlog` (`loginID`, `type`, `loginName`, `state`, `loginDateTime`, `remark`) VALUES (:loginID, :type, :loginName, 'fail', NOW(), 'fail 5 times account lock')");
                $stmt6->execute([':loginID' => $user['loginID'], ':type' => $user['type'], ':loginName' => $user['loginName']]);

                echo "<script>alert('You have logged in incorrectly 5 times, please reset your password.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Incorrect password, please try again.'); window.location.href='index.php';</script>";
            }
        }
    } elseif ($user['state'] === 'Invalid') {
        $stmt7 = $pdo->prepare("SELECT MAX(loginDateTime) as last_login FROM `loginlog` WHERE `loginID` = :loginID");
        $stmt7->execute([':loginID' => $user['loginID']]);
        $last_login = $stmt7->fetch(PDO::FETCH_ASSOC);

        if (strtotime("now") - strtotime($last_login['last_login']) >= 3600) {
            $stmt8 = $pdo->prepare("UPDATE `login` SET `state` = 'Active' WHERE `loginID` = :loginID");
            $stmt8->execute([':loginID' => $user['loginID']]);
            $user['state'] = 'Active';

            if (md5($password) === $user['loginPassword']) {
                $_SESSION['loginID'] = $user['loginID'];
                $_SESSION['type'] = $user['type'];
                $stmt9 = $pdo->prepare("INSERT INTO `loginlog` (`loginID`, `type`, `loginName`, `state`, `loginDateTime`, `remark`) VALUES (:loginID, :type, :loginName, 'success', NOW(), '')");
                $stmt9->execute([':loginID' => $user['loginID'], ':type' => $user['type'], ':loginName' => $user['loginName']]);

                header("Location: main.php");
                exit;
            } else {
                $stmt10 = $pdo->prepare("INSERT INTO `loginlog` (`loginID`, `type`, `loginName`, `state`, `loginDateTime`, `remark`) VALUES (:loginID, :type, :loginName, 'fail', NOW(), 'wrong password')");
                $stmt10->execute([':loginID' => $user['loginID'], ':type' => $user['type'], ':loginName' => $user['loginName']]);
                echo "<script>alert('Incorrect password, please try again.'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('Account Invalid.'); window.location.href='index.php';</script>";
        }
    } else {
       echo "<script>alert('Account state " . $user['state'] . ".'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Username does not exist.'); window.location.href='index.php';</script>";
}
?>
                