<!DOCTYPE html>
<html>
<head>
    <title>Teaching Plan Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        h2 {
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        textarea, input[type="text"] {
            width: 100%;
            padding: 6px;
            font-size: 14px;
        }

        input[type="submit"] {
            padding: 6px 12px;
            font-size: 14px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    require_once '../../connectdb.php';

    $teachingPlanID = "";
    $details = "";
    $uploadedFile = "";
    $subjectCode = "";
    $staffCode = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'Add') {
                $details = $_POST['details'];
                $uploadedFile = $_POST['uploadedFile'];
                $subjectCode = $_POST['subjectCode'];
                $staffCode = $_POST['staffCode'];

                $query = "INSERT INTO teaching_plan (details, uploadedFile, subjectCode, staffCode) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$details, $uploadedFile, $subjectCode, $staffCode]);
            } elseif ($action === 'Edit') {
                $teachingPlanID = $_POST['teachingPlanID'];
                $details = $_POST['details'];
                $uploadedFile = $_POST['uploadedFile'];
                $subjectCode = $_POST['subjectCode'];
                $staffCode = $_POST['staffCode'];

                $query = "UPDATE teaching_plan SET details = ?, uploadedFile = ?, subjectCode = ?, staffCode = ? WHERE teachingPlanID = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$details, $uploadedFile, $subjectCode, $staffCode, $teachingPlanID]);
            }
        }
    }

    $query = "SELECT * FROM teaching_plan";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2>Teaching Plan List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Details</th>
            <th>Uploaded File</th>
            <th>Subject Code</th>
            <th>Staff Code</th>
            <th>Action</th>
        </tr>
        <?php foreach ($plans as $plan) : ?>
            <tr>
                <td><?php echo $plan['teachingPlanID']; ?></td>
                <td><?php echo $plan['details']; ?></td>
                <td><?php echo $plan['uploadedFile']; ?></td>
                <td><?php echo $plan['subjectCode']; ?></td>
                <td><?php echo $plan['staffCode']; ?></td>
                <td>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="teachingPlanID" value="<?php echo $plan['teachingPlanID']; ?>">
                        <input type="submit" name="action" value="Edit">
                        <input type="submit" name="action" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add/Edit Teaching Plan</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="teachingPlanID" value="<?php echo $teachingPlanID; ?>">
        <label for="details">Details:</label>
        <textarea name="details"><?php echo $details; ?></textarea><br>
        <label for="uploadedFile">Uploaded File:</label>
        <input type="text" name="uploadedFile" value="<?php echo $uploadedFile; ?>"><br>
        <label for="subjectCode">Subject Code:</label>
        <input type="text" name="subjectCode" value="<?php echo $subjectCode; ?>"><br>
        <label for="staffCode">Staff Code:</label>
        <input type="text" name="staffCode" value="<?php echo $staffCode; ?>"><br>
        <?php if ($teachingPlanID) : ?>
            <input type="submit" name="action" value="Edit">
        <?php else : ?>
            <input type="submit" name="action" value="Add">
        <?php endif; ?>
    </form>
</body>
</html>
