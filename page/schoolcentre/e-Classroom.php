<!DOCTYPE html>
<html>
<head>
  <title>e-Classroom</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    h1 {
      margin: 0;
    }
    .container {
      margin: 20px;
    }
    .form-group {
      margin-bottom: 10px;
    }
    label {
      display: block;
      font-weight: bold;
    }
    input[type="text"], textarea {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    button {
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .message {
      margin-top: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .assignments-list {
      margin-top: 20px;
      list-style: none;
      padding: 0;
    }
    .assignments-list li {
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <header>
    <h1>e-Classroom</h1>
  </header>

  <div class="container">
    <h2>Submit Assignment</h2>
    <form action="submit.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="student_name">Student ID:</label>
        <input type="text" id="student_name" name="student_name"  value = "20230001" required>
      </div>
      <div class="form-group">
        <label for="assignment_file">Assignment:</label>
        <input type="file" id="assignment_file" name="assignment_file" required>
      </div>
      <button type="submit">Submit</button>
    </form>

    <h2>Assignments</h2>
    <ul class="assignments-list">
      <?php
        $assignment_directory = "assignments/";
        if (!is_dir($assignment_directory)) {
          mkdir($assignment_directory);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["assignment_file"])) {
          $student_name = $_POST["student_name"];
          $file_name = $_FILES["assignment_file"]["name"];
          $file_tmp = $_FILES["assignment_file"]["tmp_name"];

          move_uploaded_file($file_tmp, $assignment_directory . $file_name);

          echo "<li><strong>$student_name:</strong> <a href='$assignment_directory$file_name' target='_blank'>$file_name</a></li>";
        }

        $assignments = glob($assignment_directory . "*");
        foreach ($assignments as $assignment) {
          $file_name = basename($assignment);
          echo "<li><a href='$assignment' target='_blank'>$file_name</a></li>";
        }
      ?>
    </ul>
  </div>
</body>
</html>
