<!DOCTYPE html>
<html>
    <head>
        <title>Campus Voting System</title>
        <link href="../../css/campus_voting.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h1>Campus Voting System</h1>


        <form method="post">
            <h2>Vote for your favorite teacher:</h2>
            <input type="radio" name="teacher" value="John"> Mr. John<br>
            <input type="radio" name="teacher" value="Jane"> Ms. Jane<br>
            <input type="radio" name="teacher" value="Mike"> Mr. Mike<br>
            <p>
                <input type="submit" name="vote" value="Vote">
        </form>


        <?php
        if (isset($_POST['vote'])) {
            $teacher = $_POST['teacher'];

            echo "<center> <p>Your vote for $teacher has been recorded. Thank you for voting!</p></center> ";
        }
        ?>

    </body>
</html>