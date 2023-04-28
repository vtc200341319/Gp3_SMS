 <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fyp";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the ID of the exercise to be edited from the query string
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            // Retrieve the exercise details from the database
            $sql = "SELECT * FROM exercise WHERE exerciseID = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $grade = $row["grade"];
                $class = $row["class"];
                $subject = $row["subjectCode"];
                $fileName = $row["file_name"];
                $deadline = $row["deadline"];

                if (isset($_POST["submit"])) {
                    $newDeadline = $_POST["deadline"];

                    // Update the deadline in the database
                    $sql = "UPDATE exercise SET deadline = '$newDeadline' WHERE exerciseID = $id";

                    if ($conn->query($sql) === TRUE) {
                        echo "Deadline updated successfully.";
                    } else {
                        echo "Error updating deadline: " . $conn->error;
                    }

                    $conn->close();
                }
            } else {
                echo "Exercise not found.";
                $conn->close();
                exit;
            }
        } else {
            echo "Invalid request.";
            $conn->close();
            exit;
        }
        ?>