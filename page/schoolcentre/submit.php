<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["assignment_file"])) {
  $student_name = $_POST["student_name"];
  $file_name = $_FILES["assignment_file"]["name"];
  $file_tmp = $_FILES["assignment_file"]["tmp_name"];
  
  $assignment_directory = "assignments/";

  if (!is_dir($assignment_directory)) {
    mkdir($assignment_directory);
  }

  if (move_uploaded_file($file_tmp, $assignment_directory . $file_name)) {
    echo "Assignment submitted successfully!";
  } else {
    echo "Error uploading the assignment.";
  }
} else {
  echo "Invalid request.";
}
?>
