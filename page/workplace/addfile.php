<?php
$currentDir = isset($_GET['dir']) ? $_GET['dir'] : 'exampaper';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadedFile = $_FILES['file'];
    $fileName = $uploadedFile['name'];
    $fileTmpPath = $uploadedFile['tmp_name'];

    if (move_uploaded_file($fileTmpPath, $currentDir . '/' . $fileName)) {
        echo 'File uploaded successfully.';
    } else {
        echo 'Error uploading file.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add File</title>
    <link href="../../css/exampaper.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <h1>Add File</h1>
    <form action="addfile.php?dir=<?php echo $currentDir; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>
    <br>
    <a href="exampaper.php?dir=<?php echo $currentDir; ?>">&larr; Back to Folder</a>
</body>
</html>
