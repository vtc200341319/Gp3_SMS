<?php
if(isset($_POST['submit'])){
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;

  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
}

// Handle file deletion
if (isset($_GET['delete'])) {
    $file = $_GET['delete'];
    if (file_exists($file)) {
        if (unlink($file)) {
            echo "The file $file has been deleted.";
        } else {
            echo "Sorry, there was an error deleting the file.";
        }
    } else {
        echo "Sorry, the file does not exist.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<style>
		table {
		  border-collapse: collapse;
		  width: 100%;
		}

		th, td {
		  text-align: left;
		  padding: 8px;
		  border-bottom: 1px solid #ddd;
		}

		th {
		  background-color: #f2f2f2;
		}
	</style>
	<script>
		function confirmDelete(file) {
			if (confirm("Are you sure you want to delete this file?")) {
				window.location.href = "upload.php?delete=" + file;
			}
		}
	</script>
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
  Select file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload" name="submit">
</form>
    
    <p>

<?php
// Display table of uploaded files
echo "<table>";
echo "<tr><th>Name</th><th>Size</th><th>Upload Date</th><th>Extension</th><th>Delete</th></tr>";

if ($handle = opendir('uploads/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
        	$file = "uploads/" . $entry;
        	$size = filesize($file) / 1048576; // Convert bytes to MB
        	echo "<tr><td><a href='$file'>$entry</a></td><td>" . number_format($size, 2) . " MB</td><td>" . date("Y-m-d H:i:s", filemtime($file)) . "</td><td>" . pathinfo($file, PATHINFO_EXTENSION) . "</td><td><button onclick='confirmDelete(\"$file\")'>Delete</button></td></tr>";
        }
    }
    closedir($handle);
}
echo "</table>";
?>

</body>
</html>
