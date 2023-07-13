<?php

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    if ($fileError === 0) {
        $targetDir = 'uploads/medicalCer/';
        $targetPath = $targetDir . $fileName;

        $date = date('YmdHis');
        $fileNameWithDate = $date . '_' . $fileName;
        $targetPathWithDate = $targetDir . $fileNameWithDate;

        if (move_uploaded_file($fileTmpName, $targetPathWithDate)) {
            echo "<script>alert('File uploaded successfully!');</script>";
            header("Location: uploadMC.php");
            exit;
        } else {
            echo "<script>alert('File upload failed!');</script>";
            header("Location: uploadMC.php");
            exit;
        }
    } else {
        echo "Error code: " . $fileError;
    }
}
?>
