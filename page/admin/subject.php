<!DOCTYPE html>
<html>
<head>
    <title>Subject Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 5px;
        }

        input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <h2>Subject Management</h2>

    <form action="insert_subject.php" method="POST">
        <input type="text" name="subjectCode" placeholder="Subject Code" required>
        <input type="text" name="subjectName" placeholder="Subject Name" required>
        <input type="submit" value="Add Subject">
    </form>

    <table>
        <tr>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th>Action</th>
        </tr>
        <?php
        require_once '../../connectdb.php';
        $stmt = $pdo->query("SELECT * FROM subject");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['subjectCode']."</td>";
            echo "<td>".$row['subjectName']."</td>";
            echo "<td><a class='delete-btn' href='delete_subject.php?id=".$row['subjectID']."'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
