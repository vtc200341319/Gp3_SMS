<!DOCTYPE html>
<html>
<head>
    <title>Personal information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            max-width: 50px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>Personal Information</h1>
    <?php
    session_start();
    require_once('../../connectdb.php');

    if ($_SESSION['type'] == 'T' || $_SESSION['type'] == 'A') {
        $sql = "SELECT `staffCode`, `staffEngName`, `staffSex`, `staffJobTitle`, `staffDateOfBirth`, `staffDateOfEmployment`, `staffPlaceOfBirth`, `staffAddress`, `staffPhoneNumber` FROM staff WHERE loginID = :loginID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':loginID', $_SESSION['loginID'], PDO::PARAM_INT);
    } elseif ($_SESSION['type'] == 'S') {
        $sql = "SELECT `studentRegNumber`, `studentEngName`, `studentSex`, `studentDateOfBirth`, `studentPlaceOfBirth`, `studentAddress`, `classNumber`, `className` FROM student WHERE studentRegNumber = :studentRegNumber";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':studentRegNumber', $_SESSION['loginName'], PDO::PARAM_STR);
    } elseif ($_SESSION['type'] == 'P') {
        $sql = "SELECT `parentRegCode`, `parentEngName`, `parentSex`, `parentDateOfBirth`, `parentAddress`, `relationWithStudent`, `studentRegNumber` FROM parents WHERE parentRegCode = :parentRegCode";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':parentRegCode', $_SESSION['loginName'], PDO::PARAM_STR);
    }

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo '<table>';
        foreach ($result as $key => $value) {
            echo '<tr>';
            echo '<th>';
            if ($key == 'studentRegNumber') {
                echo 'Student No.';
            } elseif ($key == 'studentEngName') {
                echo 'English Name';
            } elseif ($key == 'studentSex') {
                echo 'Gender';
            } elseif ($key == 'studentDateOfBirth') {
                echo 'Date of Birth';
            } elseif ($key == 'studentPlaceOfBirth') {
                echo 'Place of Birth';
            } elseif ($key == 'studentAddress') {
                echo 'Address';
            } elseif ($key == 'classNumber') {
                echo 'Class Number';
            } elseif ($key == 'className') {
                echo 'Class Name';
            } elseif ($key == 'staffCode') {
                echo 'Staff Code';
            } elseif ($key == 'staffEngName') {
                echo 'English Name';
            } elseif ($key == 'staffChiName') {
                echo 'Chinese Name';
            } elseif ($key == 'staffSex') {
                echo 'Gender';
            } elseif ($key == 'staffJobTitle') {
                echo 'Job Title';
            } elseif ($key == 'staffDateOfBirth') {
                echo 'Date of Birth';
            } elseif ($key == 'staffDateOfEmployment') {
                echo 'Date of Employment';
            } elseif ($key == 'staffPlaceOfBirth') {
                echo 'Place of Birth';
            } elseif ($key == 'staffAddress') {
                echo 'Address';
            } elseif ($key == 'staffPhoneNumber') {
                echo 'Phone Number';
            } elseif ($key == 'parentRegCode') {
                echo 'Parent Code';
            } elseif ($key == 'parentEngName') {
                echo 'English Name';
            } elseif ($key == 'parentChiName') {
                echo 'Chinese Name';
            } elseif ($key == 'parentSex') {
                echo 'Gender';
            } elseif ($key == 'parentDateOfBirth') {
                echo 'Date of Birth';
            } elseif ($key == 'parentAddress') {
                echo 'Address';
            } elseif ($key == 'relationWithStudent') {
                echo 'Relation with Student';
            }
        
            echo '</th>';
            echo '<td><input type="text" value="' . $value . '" readonly></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No corresponding profile found.';
    }
    ?>
</body>
</html>
