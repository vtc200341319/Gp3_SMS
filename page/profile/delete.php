<?php

if (isset($_GET['file'])) {
    $filePath = $_GET['file'];

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "<script>alert('File deleted successfully!');</script>";
            header("Location: uploadMC.php");
            exit;
        } else {
            echo "<script>alert('Unable to delete the file.');</script>";
            header("Location: uploadMC.php");
            exit;
        }
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>
