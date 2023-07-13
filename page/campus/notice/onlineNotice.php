<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Notice</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            text-align: left;
            padding: 8px;
        }
        
        th {
            background-color: #4CAF50;
            color: white;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 4px 8px;
            border: none;
            cursor: pointer;
        }
        
        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h1>Online Notice</h1>

    <table>
        <tr>
            <th>Number</th>
            <th>Subject</th>
            <th>Upload Date</th>
            <?php
            if ($_SESSION['type'] == 'A') {
                echo "<th>Action</th>";
            }
            ?>
        </tr>

        <?php
        $directory = '2223';

        $files = glob($directory . '/*');

        $noticeData = array();

        foreach ($files as $file) {
            if (is_file($file)) {
                $filename = basename($file);
                $lastModified = filemtime($file);

                $noticeData[] = array(
                    'filename' => $filename,
                    'lastModified' => $lastModified
                );
            }
        }

        usort($noticeData, function($a, $b) {
            return $b['lastModified'] - $a['lastModified'];
        });

        $counter = 1;

        foreach ($noticeData as $notice) {
            $filename = $notice['filename'];
            $lastModified = date('Y-m-d', $notice['lastModified']);
            
            echo "<tr>";
            echo "<td>{$counter}</td>";
            echo "<td><a href=\"view_file.php?file={$directory}/{$filename}\">{$filename}</a></td>";
            echo "<td>{$lastModified}</td>";

            if ($_SESSION['type'] == 'A') {
                echo "<td><button class=\"delete-btn\" onclick=\"deleteFile('{$filename}')\">Delete</button></td>";
            }

            echo "</tr>";

            $counter++;
        }
        ?>
    </table>

    <script>
        function deleteFile(filename) {
            if (confirm("Are you sure you want to delete this file?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_file.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        location.reload();
                    }
                };
                xhr.send("filename=" + filename);
            }
        }
    </script>
</body>
</html>
