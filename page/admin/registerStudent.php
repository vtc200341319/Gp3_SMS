<?php
require_once('../../connectdb.php');

function getNewLoginId() {
    global $pdo;
    $currentYear = date('Y');

    $sql = "SELECT MAX(`loginID`) AS maxLoginId FROM `login` WHERE `loginID` LIKE '%$currentYear%'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['maxLoginId']) {
        $lastNumber = (int) substr($result['maxLoginId'], -4);
        $newNumber = $lastNumber + 1;
        $formattedNumber = str_pad($newNumber, 4, "0", STR_PAD_LEFT);
        return $currentYear . $formattedNumber;
    } else {
        return $currentYear . '0001';
    }
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentRegNumber = getNewStudentRegNumber();
        $studentEngName = $_POST["studentEngName"];
        $studentChiName = $_POST["studentChiName"];
        $studentSex = $_POST["studentSex"];
        $studentDateOfBirth = $_POST["studentDateOfBirth"];
        $studentPlaceOfBirth = $_POST["studentPlaceOfBirth"];
        $studentAddress = $_POST["studentAddress"];
        $classNumber = $_POST["classNumber"];
        $className = $_POST["className"];
        $parentsRegCode = $_POST["parentsRegCode"];

        if (empty($studentRegNumber) || empty($studentEngName) || empty($studentChiName) || empty($studentSex) || empty($studentDateOfBirth) || empty($studentPlaceOfBirth) || empty($studentAddress) || empty($classNumber) || empty($className) || empty($parentsRegCode)) {
            echo "<script>alert('Please fill in all fields'); window.location.href = 'registerStudent.php';</script>";
            exit;
        }

        $sql = "INSERT INTO `student`(`studentRegNumber`, `studentEngName`, `studentChiName`, `studentSex`, `studentDateOfBirth`, `studentPlaceOfBirth`, `studentAddress`, `classNumber`, `className`, `parentsRegCode`)
                VALUES (:studentRegNumber, :studentEngName, :studentChiName, :studentSex, :studentDateOfBirth, :studentPlaceOfBirth, :studentAddress, :classNumber, :className, :parentsRegCode)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':studentRegNumber', $studentRegNumber);
        $stmt->bindParam(':studentEngName', $studentEngName);
        $stmt->bindParam(':studentChiName', $studentChiName);
        $stmt->bindParam(':studentSex', $studentSex);
        $stmt->bindParam(':studentDateOfBirth', $studentDateOfBirth);
        $stmt->bindParam(':studentPlaceOfBirth', $studentPlaceOfBirth);
        $stmt->bindParam(':studentAddress', $studentAddress);
        $stmt->bindParam(':classNumber', $classNumber);
        $stmt->bindParam(':className', $className);
        $stmt->bindParam(':parentsRegCode', $parentsRegCode);

        $stmt->execute();

        $studentLoginName = $studentRegNumber;
        $studentLoginEmail = $studentRegNumber . '@sms.com';
        $studentLoginPassword = md5('S@' . $studentRegNumber);
        $studentSecurityQ = '';
        $studentSecurityAns = '';
        $studentType = 'S';
        $studentLoginId = getNewLoginId();

        $stmtStudentLogin = $pdo->prepare("SELECT COUNT(*) FROM login WHERE loginName = ?");
        $stmtStudentLogin->execute([$studentLoginName]);
        $countStudentLogin = $stmtStudentLogin->fetchColumn();
        if ($countStudentLogin > 0) {
            echo '<script>alert("Student Login Name already exists!"); window.location.href = "registerStudent.php";</script>';
            exit();
        }

        $stmtStudentAccount = $pdo->prepare("INSERT INTO login (loginID,type, loginName, loginEmail, loginPassword, securityQ, securityAns, state) VALUES (?,?, ?, ?, ?, ?, ?, ?)");
        $stmtStudentAccount->bindParam(1, $studentLoginId);
        $stmtStudentAccount->bindParam(2, $studentType);
        $stmtStudentAccount->bindParam(3, $studentLoginName);
        $stmtStudentAccount->bindParam(4, $studentLoginEmail);
        $stmtStudentAccount->bindParam(5, $studentLoginPassword);
        $stmtStudentAccount->bindParam(6, $studentSecurityQ);
        $stmtStudentAccount->bindParam(7, $studentSecurityAns);
        $stmtStudentAccount->bindValue(8, 'Active');

        $stmtStudentAccount->execute();

        $parentLoginId = getNewLoginId();
        $parentRegCode = $_POST["parentsRegCode"];
        $parentEngName = $_POST["parentEngName"];
        $parentChiName = $_POST["parentChiName"];
        $parentSex = $_POST["parentSex"];
        $parentDateOfBirth = $_POST["parentDateOfBirth"];
        $parentAddress = $_POST["parentAddress"];
        $relationWithStudent = $_POST["relationWithStudent"];

        $stmtParentLogin = $pdo->prepare("SELECT COUNT(*) FROM login WHERE loginName = ?");
        $stmtParentLogin->execute([$parentRegCode]);
        $countParentLogin = $stmtParentLogin->fetchColumn();
        if ($countParentLogin > 0) {
            echo '<script>alert("Parent Login Name already exists!"); window.location.href = "registerStudent.php";</script>';
            exit();
        }


        $stmtParentAccount = $pdo->prepare("INSERT INTO login (loginID,type, loginName, loginEmail, loginPassword, securityQ, securityAns, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmtParentAccount->bindParam(1, $parentLoginId);
        $stmtParentAccount->bindValue(2, 'P');
        $stmtParentAccount->bindParam(3, $parentRegCode);
        $stmtParentAccount->bindValue(4, $parentRegCode . '@sms.com');
        $stmtParentAccount->bindValue(5, md5('P@' . $parentRegCode));
        $stmtParentAccount->bindValue(6, '');
        $stmtParentAccount->bindValue(7, '');
        $stmtParentAccount->bindValue(8, 'Active');

        $stmtParentAccount->execute();

        $sql2 = "INSERT INTO `parents`(`parentRegCode`, `parentEngName`, `parentChiName`, `parentSex`, `parentDateOfBirth`, `parentAddress`, `relationWithStudent`, `studentRegNumber`) 
                VALUES (:parentRegCode, :parentEngName, :parentChiName, :parentSex, :parentDateOfBirth, :parentAddress, :relationWithStudent, :studentRegNumber)";

        $stmt = $pdo->prepare($sql2);
        $stmt->bindParam(':parentRegCode', $parentRegCode);
        $stmt->bindParam(':parentEngName', $parentEngName);
        $stmt->bindParam(':parentChiName', $parentChiName);
        $stmt->bindParam(':parentSex', $parentSex);
        $stmt->bindParam(':parentDateOfBirth', $parentDateOfBirth);
        $stmt->bindParam(':parentAddress', $parentAddress);
        $stmt->bindParam(':relationWithStudent', $relationWithStudent);
        $stmt->bindParam(':studentRegNumber', $studentRegNumber);

        echo '<script>alert("Successfully inserted data"); window.location.href = "registerStudent.php";</script>';      
    }
} catch (PDOException $e) {
    die("Failed to insert data: " . $e->getMessage());
}

function getNewStudentRegNumber() {
    global $pdo;
    $currentYear = date('Y');

    $sql = "SELECT MAX(`studentRegNumber`) AS maxRegNumber FROM `student` WHERE `studentRegNumber` LIKE '%$currentYear%'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['maxRegNumber']) {
        $lastNumber = (int) substr($result['maxRegNumber'], -4);
        $newNumber = $lastNumber + 1;
        $formattedNumber = ($newNumber < 10) ? '000' . $newNumber : (($newNumber < 100) ? '00' . $newNumber : $newNumber);
        return 's' . $currentYear . $formattedNumber;
    } else {
        return 's' . $currentYear . '0001';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="../../css/registerStudent.css" rel="stylesheet" type="text/css"/>
        <title>Registration Form</title>
    </head>
    <body>
        <h2>Registration Form</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Student Part:</label>
            <p>
                <label for="studentRegNumber">Student Registration Number:</label>
                <input type="text" name="studentRegNumber" value="<?php echo getNewStudentRegNumber(); ?>" readonly><br>               

                <label for="studentEngName">Student English Name:</label>
                <input type="text" name="studentEngName" required><br>

                <label for="studentChiName">Student Chinese Name:</label>
                <input type="text" name="studentChiName" required><br>

                <label for="studentSex">Gender:</label>
                <select name="studentSex" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br>

                <label for="studentDateOfBirth">Date of Birth:</label>
                <input type="date" name="studentDateOfBirth" required><br>

                <label for="studentPlaceOfBirth">Place of Birth:</label>
                <input type="text" name="studentPlaceOfBirth" value="Hong Kong" required><br>

                <label for="studentAddress">Address:</label>
                <input type="text" name="studentAddress" required><br>

                <label for="classNumber">Class Number:</label>
                <input type="text" name="classNumber" required><br>

                <label for="className">Class Name:</label>
                <input type="text" name="className" required><br>


                <label>Parent Part:</label>
            <p>
                <label for="parentsRegCode">Parent Registration Code:</label>
                <input type="text" name="parentsRegCode" value="<?php echo 'p' . substr(getNewStudentRegNumber(), -8); ?>" readonly><br>


                <label for="parentEngName">Parent English Name:</label>
                <input type="text" name="parentEngName" required><br>

                <label for="parentChiName">Parent Chinese Name:</label>
                <input type="text" name="parentChiName" required><br>

                <label for="parentSex">Parent Gender:</label>
                <select name="parentSex" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br>

                <label for="parentDateOfBirth">Parent Date of Birth:</label>
                <input type="date" name="parentDateOfBirth" required><br>

                <label for="parentAddress">Parent Address:</label>
                <input type="text" name="parentAddress" required><br>

                <label for="relationWithStudent">Relation with Student:</label>
                <select name="relationWithStudent" required>
                    <option value="father">Father</option>
                    <option value="mother">Mother</option>
                    <option value="guardian">Guardian</option>
                </select><br>


                <input type="submit" value="Submit">
        </form>
    </body>
</html>
