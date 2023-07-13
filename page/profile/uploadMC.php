<!DOCTYPE html>
<html>
<head>
  <title>Upload Medical Certificate</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }
    
    h1 {
      text-align: center;
    }
    
    form {
      max-width: 400px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      background-color: #f5f5f5;
      border-radius: 5px;
    }
    
    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }
    
    input[type="file"] {
      margin-bottom: 10px;
    }
    
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    
    .file-list {
      margin-top: 20px;
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 5px;
      background-color: #f5f5f5;
    }
    
    .file-item {
      margin-bottom: 10px;
    }
    
    .file-item span {
      display: inline-block;
      width: 300px;
    }
    
    .file-item .delete-btn {
      color: red;
      cursor: pointer;
      margin-left: 10px;
    }
  </style>
</head>
<body>
  <h1>Upload Medical Certificate</h1>

  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="file">Choose File:</label>
    <input type="file" name="file" id="file" required>
    <br><br>
    <input type="submit" value="Upload File">
  </form>

  <div class="file-list">
    <h2>Uploaded Medical Certificates</h2>
    <?php
    $targetDir = 'uploads/medicalCer/';
    $files = glob($targetDir . '*');
    
    if(count($files) > 0) {
      foreach($files as $file) {
        $fileName = basename($file);
        echo '<div class="file-item">';
        echo '<span>' . $fileName . '</span>';
        echo '<span class="delete-btn" onclick="deleteFile(\'' . $file . '\')">Delete</span>';
        echo '</div>';
      }
    } else {
      echo '<p>No files uploaded yet.</p>';
    }
    ?>
  </div>

  <script>
    function deleteFile(filePath) {
      if (confirm("Are you sure you want to delete this file?")) {
        window.location.href = "delete.php?file=" + encodeURIComponent(filePath);
      }
    }
  </script>
</body>
</html>
