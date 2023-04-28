<!DOCTYPE html>
<html>
<head>
    <title>School Management System Login</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/index.js"></script>
    <style type="text/css">
        body {
            background-image: url("img/backg.jpg");
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>School Management System</h1>
        <form method="post" action="login.php">
            <label for="username">Username/Email:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
            <p class="forgot-password" onclick="showPopup()">Reset Password</p>
        </form>
    </div>
    <div class="popup-box" id="popup">
        <div class="popup-box-content">
            <span class="close" onclick="hidePopup()">&times;</span>
            <h2>Reset Password</h2>
            <p>Please enter your username (loginID/loginName/loginEmail) below and we'll help you reset your password.</p>
            <form id="forgot-password-form">
                <label for="forgot-username">Username:</label>
                <input type="text" id="forgot-username" name="forgot-username" required>
                <button type="button" id="submit-username">Enter</button>
            </form>
            <div id="security-question-container" style="display: none;">
                <h3>Security Question:</h3>
                <p id="security-question"></p>
                <label for="security-answer">Answer:</label>
                <input type="text" id="security-answer" name="security-answer" required>
                <button type="button" id="submit-security-answer">Submit</button>
            </div>
            <div id="reset-password-container" style="display: none;">
                <h3>Reset Password:</h3>
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password" required>
                <label for="confirm-new-password">Confirm New Password:</label>
                <input type="password" id="confirm-new-password" name="confirm-new-password" required>
                <p id="password-requirements">Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.</p>
                <button type="button" id="submit-new-password">Reset Password</button>
            </div>
        </div>
    </div>
   
</body>
</html>
