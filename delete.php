<?php
// Get the ID of the exercise to delete
$id = $_GET["id"];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyp";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete the exercise from the database
$sql = "DELETE FROM exercise WHERE exerciseID = $id";
if ($conn->query($sql) === TRUE) {
    // Redirect back to the exercise upload page
    header("Location: ex_upload.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
