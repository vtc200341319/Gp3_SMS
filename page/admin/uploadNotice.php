<!DOCTYPE html>
<html>
<head>
    <title>Upload Online Notice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        
        h1 {
            color: #333;
        }
        
        form {
            margin-top: 20px;
        }
        
        input[type="file"] {
            margin-bottom: 10px;
        }
        
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
        }
        
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
   <h1>Upload Online Notice</h1>

    <?php
    $uploadDir = '../campus/notice/2223/';

    function isFileNameDuplicate($uploadDir, $fileName) {
        $existingFiles = glob($uploadDir . '*');
        
        foreach ($existingFiles as $existingFile) {
            if (is_file($existingFile) && basename($existingFile) === $fileName) {
                return true;
            }
        }
        
        return false;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdfFile'])) {
        $file = $_FILES['pdfFile'];
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileError = $file['error'];

        if ($fileError === 0) {
            if (isFileNameDuplicate($uploadDir, $fileName)) {
                echo '<p>File with the same name already exists. Please choose a different file.</p>';
            } else {
                $destination = $uploadDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $destination)) {
                    echo '<p>File uploaded successfully.</p>';
                } else {
                    echo '<p>Failed to upload file.</p>';
                }
            }
        } else {
            echo '<p>Error occurred during file upload.</p>';
        }
    }
    ?>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="pdfFile" accept="application/pdf" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
