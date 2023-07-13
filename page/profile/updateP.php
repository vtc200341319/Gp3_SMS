<?php
    require_once '../../connectdb.php';

    $studentNo = 's'.$_POST['studentNo'];
    $studentEngName = $_POST['studentEngName'];
    $studBirth = DateTime::createFromFormat('d/m/Y', $_POST['studBirth'])->format('Y-m-d');
    $studGender = $_POST['studGender'];
    $studPlace = $_POST['studPlace'];
    $studAddress = $_POST['studAddress'];

    $sql = "UPDATE `student` SET studentEngName = :studentEngName, studentDateOfBirth = :studBirth, studentSex = :studGender, studentPlaceOfBirth = :studPlace, studentAddress = :studAddress WHERE studentRegNumber = :studentNo";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':studentNo', $studentNo);
    $stmt->bindParam(':studentEngName', $studentEngName);
    $stmt->bindParam(':studBirth', $studBirth);
    $stmt->bindParam(':studGender', $studGender);
    $stmt->bindParam(':studPlace', $studPlace);
    $stmt->bindParam(':studAddress', $studAddress);

    if ($stmt->execute()) {
        echo 'Profile updated successfully.';
    } else {
        echo 'Error occurred while updating profile.';
    }
?>
