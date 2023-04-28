<?php
require_once('connectdb.php');

$stmt = $pdo->prepare("SELECT * FROM `login`");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SMS - List User</title>        
        <link rel="stylesheet" href="css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }               
            #searchInput {
                width:290px;
            }
        </style>
        <script>
            $(document).ready(function () {
                $("#searchInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#userTable tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                $("#typeFilter, #stateFilter").on("change", function () {
                    var typeValue = $("#typeFilter").val();
                    var stateValue = $("#stateFilter").val();
                    $("#userTable tr").filter(function () {
                        var typeMatch = typeValue === "" || $(this).find(".type").text() === typeValue;
                        var stateMatch = stateValue === "" || $(this).find(".state").text() === stateValue;
                        $(this).toggle(typeMatch && stateMatch);
                    });
                });
            });
        </script>
    </head>

    <body>
        <h1>List User</h1>
        <div>
            <input type="text" id="searchInput" placeholder="Search for Login ID, Login Name or Login Email">
            Type:
            <select id="typeFilter">
                <option value="">All</option>
                <option value="A">Administrator</option>
                <option value="F">Staff</option>
                <option value="T">Teacher</option>
                <option value="S">Student</option>
                <option value="P">Parent</option>
            </select>
            State:
            <select id="stateFilter">
                <option value="">All</option>
                <option value="Active">Active</option>
                <option value="Invalid">Invalid</option>
                <option value="Close">Close</option>
            </select>
        </div>
        <p>
        <table>
            <tr>
                <th>Login ID</th>
                <th>Login Name</th>
                <th>Login Email</th>
                <th>Type</th>
                <th>State</th>               
                <th colspan="2">Actions</th>
            </tr>
            <tbody id="userTable">
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['loginID']; ?></td>
                        <td><?php echo $user['loginName']; ?></td>
                        <td><?php echo $user['loginEmail']; ?></td>
                        <td class="type"><?php echo $user['type']; ?></td>
                        <td class="state"><?php echo $user['state']; ?></td>
                        <td>
                            <a href="closeAcc.php?loginID=<?php echo $user['loginID']; ?>" onclick="return confirm('Are you sure you want to close this account?')">Close</a>
                        </td>
                        <td>
                            <a href="resumeAcc.php?loginID=<?php echo $user['loginID']; ?>" onclick="return confirm('Are you sure you want to resume this account?')">Resume</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>

