<?php
require_once('../../connectdb.php');

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studnetID = $_POST["studnetID"];
        $studentRegNumber = $_POST["studentRegNumber"];
        $studentEngName = $_POST["studentEngName"];
        $studentChiName = $_POST["studentChiName"];
        $studentSex = $_POST["studentSex"];
        $studentDateOfBirth = $_POST["studentDateOfBirth"];
        $studentPlaceOfBirth = $_POST["studentPlaceOfBirth"];
        $studentAddress = $_POST["studentAddress"];
        $classNumber = $_POST["classNumber"];
        $className = $_POST["className"];
        $parentsRegCode = $_POST["parentsRegCode"];

        if (empty($studentID) || empty($studentRegNumber) || empty($studentEngName) || empty($studentChiName) || empty($studentSex) || empty($studentDateOfBirth) || empty($studentPlaceOfBirth) || empty($studentAddress) || empty($classNumber) || empty($className) || empty($parentsRegCode)) {
            echo "<script>alert('Please fill in all fields'); window.location.href = 'registerStudent.php';</script>";
            exit;
        }


        $sql = "INSERT INTO `student`(`studnetID`, `studentRegNumber`, `studentEngName`, `studentChiName`, `studentSex`, `studentDateOfBirth`, `studentPlaceOfBirth`, `studentAddress`, `classNumber`, `className`, `parentsRegCode`)
                VALUES (:studnetID, :studentRegNumber, :studentEngName, :studentChiName, :studentSex, :studentDateOfBirth, :studentPlaceOfBirth, :studentAddress, :classNumber, :className, :parentsRegCode)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':studnetID', $studnetID);
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

        echo "Successfully inserted data";
    }
} catch (PDOException $e) {
    die("Failed to insert data: " . $e->getMessage());
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
            <label for="studnetID">Student ID:</label>
            <input type="text" name="studnetID" required><br>
            <label for="studentRegNumber">Student Registration Number:</label>
            <input type="text" name="studentRegNumber" required><br>

            <label for="studentEngName">Student English Name:</label>
            <input type="text" name="studentEngName" required><br>

            <label for="studentChiName">Student Chinese Name:</label>
            <input type="text" name="studentChiName" required><br>

            <label for="studentSex">Sex:</label>
            <input type="text" name="studentSex" required><br>

            <label for="studentDateOfBirth">Date of Birth:</label>
            <input type="text" name="studentDateOfBirth" required><br>

            <label for="studentPlaceOfBirth">Place of Birth:</label>
            <input type="text" name="studentPlaceOfBirth" required><br>

            <label for="studentAddress">Address:</label>
            <input type="text" name="studentAddress" required><br>

            <label for="classNumber">Class Number:</label>
            <input type="text" name="classNumber" required><br>

            <label for="className">Class Name:</label>
            <input type="text" name="className" required><br>

            <label for="parentsRegCode">Parent Registration Code:</label>
            <input type="text" name="parentsRegCode" required><br>

            <input type="submit" value="Submit">
        </form>
    </body>
</html>
