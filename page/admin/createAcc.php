<!DOCTYPE html>
<html>
    <head>
        <title>Create Account</title>
        <link href="../../css/createAcc.css" rel="stylesheet" type="text/css"/>
        <script>
            function validatePassword() {
                var password = document.getElementById("loginPassword").value;
                var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;
                if (passwordRegex.test(password)) {
                    document.getElementById("password-error").innerHTML = "";
                    return true;
                } else {
                    document.getElementById("password-error").innerHTML = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <h1>Create Account</h1>
        <form action="create_account.php" method="post">

            <?php
          
            include('../../connectdb.php');
            
            $stmt = $pdo->prepare("SELECT loginID FROM login WHERE loginID LIKE :prefix ORDER BY loginID DESC LIMIT 1");
            $stmt->bindValue(':prefix', date("Y") . '%');
            $stmt->execute();
            $latestLoginID = $stmt->fetchColumn();
            if ($latestLoginID) {
                $newLoginID = substr($latestLoginID, 4) + 1;
            } else {
                $newLoginID = 1;
            }
            $loginID = date("Y") . sprintf("%04d", $newLoginID);
          
            $stmt = null;
            $pdo = null;
            ?>

            <label for="loginID">Login ID:</label>
            <input type="text" name="loginID" value="<?php echo $loginID; ?>" readonly><br>

            <label for="loginName">Login Name:</label>
            <input type="text" name="loginName" required><br>
            <label for="loginEmail">Email:</label>
            <input type="email" name="loginEmail" required><br>

            <label for="loginPassword">Password:</label>
            <input type="password" name="loginPassword" id="loginPassword" required oninput="validatePassword()"><br>
            <div id="password-error" style="color:red"></div>

            <label for="type">Type:</label>
            <select name="type" required>
                <option value="">--Please Select Type--</option>
                <option value="A">Administrator</option>
                <option value="F">Staff</option>
                <option value="T">Teacher</option>
                <option value="S">Student</option>
                <option value="P">Parent</option>
            </select><br>


            <label for="securityQ">Security Question:</label>
            <select name="securityQ" required>
                <option value="">--Please Select Security Question--</option>
                <?php
                
                include('../../connectdb.php');

              
                $stmt = $pdo->prepare("SELECT * FROM SecurityQuestion");
                $stmt->execute();
                $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

                
                foreach ($questions as $question) {
                    echo '<option value="' . $question['questionID'] . '">' . $question['question'] . '</option>';
                }

               
                $stmt = null;
                $pdo = null;
                ?>
            </select><br>

            <label for="securityAns">Security Answer:</label>
            <input type="text" name="securityAns" required><br>

            <input type="submit" value="Create Account">
        </form>
    </body>
</html>