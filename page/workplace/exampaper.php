<!DOCTYPE html>
<html>
<head>
    <title>Exam Paper</title>
    <link href="../../css/exampaper.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <h1>Exam Paper</h1>
    <?php
        $currentDir = isset($_GET['dir']) ? $_GET['dir'] : 'exampaper';
        
        if (isset($_POST['new_dir_name'])) {
            $newDirName = $_POST['new_dir_name'];
            if (!file_exists($currentDir . '/' . $newDirName)) {
                mkdir($currentDir . '/' . $newDirName);
            }
        }
        
        if (isset($_GET['delete'])) {
            $deletePath = $_GET['delete'];
            if (is_dir($deletePath)) {
                deleteDirectory($deletePath);
            } else {
                unlink($deletePath);
            }
            
            header("Location: exampaper.php?dir=$currentDir");
            exit;
        }
        
        echo '<h2>Directory: ' . $currentDir . '</h2>';
        
        if ($currentDir !== 'exampaper') {
            $parentDir = dirname($currentDir);
            echo '<a href="exampaper.php?dir=' . $parentDir . '">&larr; Back to Main Folder</a>';
        }
        
        echo '<ul>';
        
        $folders = glob($currentDir . '/*', GLOB_ONLYDIR);
        foreach ($folders as $folder) {
            $folderName = basename($folder);
            echo '<li><span class="folder-icon"></span><span class="folder-name"><a href="exampaper.php?dir=' . $folder . '">' . $folderName . '</a></span> [<a href="exampaper.php?delete=' . $folder . '">Delete</a>] [<a href="addfile.php?dir=' . $folder . '">Add File</a>]</li>';
        }
        
        echo '</ul>';
        
        echo '<h3>Files:</h3>';
        echo '<ul>';
        
        $files = glob($currentDir . '/*');
        foreach ($files as $file) {
            if (!is_dir($file)) {
                $fileName = basename($file);
                $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                
                echo '<li>';
                if ($fileExtension === 'pdf') {
                    echo '<img src="../../img/icon/pdf.png" class="file-icon" alt="PDF Icon">';
                } elseif ($fileExtension === 'doc' || $fileExtension === 'docx') {
                    echo '<img src="../../img/icon/word.png" class="file-icon" alt="Word Icon">';
                } else {
                    echo '<img src="../../img/icon/note.png" class="file-icon" alt="Note Icon">';
                }
                echo '<a href="' . $file . '" target="_blank">' . $fileName . '</a> [<a href="exampaper.php?delete=' . $file . '">Delete</a>]</li>';
            }
        }
        
        echo '</ul>';
        
        function deleteDirectory($dir) {
            if (!file_exists($dir)) {
                return true;
            }
        
            if (!is_dir($dir)) {
                return unlink($dir);
            }
        
            foreach (scandir($dir) as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
        
                if (!deleteDirectory($dir . '/' . $item)) {
                    return false;
                }
            }
        
            return rmdir($dir);
        }
    ?>
    
    <h3>Add New Folder</h3>
    <form action="exampaper.php?dir=<?php echo $currentDir; ?>" method="post">
        <input type="text" name="new_dir_name" placeholder="Folder Name" required>
        <button type="submit">Add</button>
    </form>
</body>
</html>
