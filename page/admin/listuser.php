<?php
require_once('../../connectdb.php');

$stmt = $pdo->prepare("SELECT * FROM `login`");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SMS - List User</title>
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
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 30%;
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
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
                <th colspan="3">Actions</th>
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
                            <a href="closeAcc.php?loginID=<?php echo $user['loginID']; ?>" onclick="return confirm('Are you sure you want to close <?php echo $user['loginID']; ?> account?')">Close</a>
                        </td>
                        <td>
                            <a href="resumeAcc.php?loginID=<?php echo $user['loginID']; ?>" onclick="return confirm('Are you sure you want to resume <?php echo $user['loginID']; ?> account?')">Resume</a>
                        </td>
                        <td id="resetPassword-<?php echo $user['loginID']; ?>">Reset Password</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div id="passwordResetModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="resetPasswordForm">
                    <h2>Reset Password</h2>
                    <p id="resetPasswordLoginIdText">Login ID: </p>
                    <input type="hidden" id="resetPasswordLoginId" name="loginID" value="">
                    <p>New Password: <input type="password" name="newPassword" required></p>
                    <p>Confirm Password: <input type="password" name="confirmPassword" required></p>
                    <button type="submit">Reset Password</button>
                </form>


            </div>
        </div>

        <script>
            $(document).ready(function () {

                $("[id^='resetPassword-']").on("click", function () {
                    var loginId = $(this).attr('id').split('-')[1];
                    $("#resetPasswordLoginId").val(loginId);
                    $("#resetPasswordLoginIdText").text("Login ID: " + loginId);
                    $("#passwordResetModal").show();
                });

                $(".close").on("click", function () {
                    $("#passwordResetModal").hide();
                });

                $(window).on("click", function (event) {
                    if ($(event.target).is(".modal")) {
                        $(".modal").hide();
                    }
                });

                $('#resetPasswordForm').on('submit', function (e) {
                    e.preventDefault();

                    var data = $(this).serialize();

                    $.ajax({
                        url: 'reset_password.php',
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                alert('Password changed successfully!');
                            } else {
                                alert('Error: ' + response.error);
                            }
                            $("#passwordResetModal").hide();
                        },
                        error: function () {
                            alert('An error occurred. Please try again.');
                        }
                    });
                });
            });
        </script>


    </body>
</html>

