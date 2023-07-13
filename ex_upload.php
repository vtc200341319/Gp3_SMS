<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload Exercise</title>
        <link href="css/ex_upload.css" rel="stylesheet" type="text/css"/>
        
        
    </head>
    <body>
        <h1>Upload Exercise</h1>
        <form name="uploadForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="grade">Grade:</label>
                <select name="grade" id="grade">
                    <option value="">Select a grade</option>
                    <option value="1">1st grade</option>
                    <option value="2">2nd grade</option>
                    <option value="3">3rd grade</option>
                    <option value="4">4th grade</option>
                    <option value="5">5th grade</option>
                    <option value="6">6th grade</option>
                </select>
            </div>

            <div class="form-group">
                <label for="class">Class:</label>
                <select name="class" id="class">
                    <option value="">Select a class</option>
                    <option value="A">Class A</option>
                    <option value="B">Class B</option>
                    <option value="C">Class C</option>
                    <option value="D">Class D</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <select name="subject" id="subject">
                    <option value="">Select a subject</option>
                    <option value="Math">Math</option>
                    <option value="Science">Science</option>
                    <option value="English">English</option>
                    <option value="History">History</option>
                    <option value="Art">Art</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" name="file" id="file">
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline">
            </div>

            <input type="submit" value="Upload" name="submit">
        </form>


        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fyp";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if (isset($_POST["submit"])) {
            $grade = $_POST["grade"];
            $class = $_POST["class"];
            $subject = $_POST["subject"];
            $deadline = $_POST["deadline"];
            $fileName = $_FILES["file"]["name"];
            $fileSize = $_FILES["file"]["size"];
            $fileType = $_FILES["file"]["type"];
            $fileTempName = $_FILES["file"]["tmp_name"];
            $uploadDate = date("Y-m-d H:i:s");
            $targetDir = "uploads/$grade/$class/$subject/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $targetFile = $targetDir . basename($fileName);

            if (move_uploaded_file($fileTempName, $targetFile)) {
                require_once 'connectdb.php';

                $sql = "INSERT INTO exercise (grade, class, subjectCode, file_name, file_size, file_type, file_path, deadline, upload_date)
    VALUES ('$grade', '$class', '$subject', '$fileName', '$fileSize', '$fileType', '$targetFile', '$deadline', '$uploadDate')";

                if ($conn->query($sql) === TRUE) {
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        ?>

        <table>
            <tr>
                <th>Name</th>
                <th>Size(mb)</th>
                <th>Upload Date</th>
                <th>Deadline</th>
                <th>Extension</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fyp";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM exercise";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $fileSizeMb = round(($row["file_size"] / 1048576), 2);
                    $extension = pathinfo($row["file_name"], PATHINFO_EXTENSION);
                    echo "<tr>";
                    echo "<td><a href='" . $row["file_path"] . "' target='_blank'>" . $row["file_name"] . "</a></td>";
                    echo "<td>" . $fileSizeMb . "</td>";
                    echo "<td>" . $row["upload_date"] . "</td>";
                    echo "<td>" . $row["deadline"] . "</td>";
                    echo "<td>" . $extension . "</td>";
                    echo "<td><a href='delete.php?id=" . $row["exerciseID"] . "' onclick='return confirm(\"Are you sure you want to delete this exercise?\")'>Delete</a></td>";
                    echo "<td><a href='javascript:void(0)' onclick='editExercise(" . $row["exerciseID"] . ")'>Edit</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No exercises found.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
        <script src="js/ex_upload.js" type="text/javascript"></script>
    </body>
</html>