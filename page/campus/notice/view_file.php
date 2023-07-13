<!DOCTYPE html>
<html>
<head>
    <title>View File</title>
</head>
<body>
    <?php
    if (isset($_GET['file'])) {
        $file = $_GET['file'];

        if (file_exists($file)) {
            if (mime_content_type($file) == 'application/pdf') {
                echo '<embed src="' . $file . '" type="application/pdf" width="100%" height="800px" />';
            } else {
                echo '<h2>Invalid file type. Only PDF files are supported.</h2>';
            }
        } else {
            echo '<h2>File not found.</h2>';
        }
    } else {
        echo '<h2>Invalid file path.</h2>';
    }
    ?>
</body>
</html>
