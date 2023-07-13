<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filename'])) {
    $directory = '2223';
    $filename = $_POST['filename'];
    $filePath = $directory . '/' . $filename;

    if (is_file($filePath)) {
        if (unlink($filePath)) {
            echo 'File deleted successfully.';
        } else {
            echo 'Failed to delete file.';
        }
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
