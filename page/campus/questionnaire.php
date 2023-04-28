<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $color = $_POST['color'];
    $comment = $_POST['comment'];
    $email = $_POST['email'];


    echo "<p>Thank you for submitting the questionnaire, $name!</p>";
}
?>
<link href="../../css/questionnaire.css" rel="stylesheet" type="text/css"/>

<form method="post">
    <h2>Please fill out the following questions:</h2>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required><br>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="">--Select--</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select><br>

    <label for="color">Favorite color:</label>
    <input type="text" id="color" name="color" required ><br>

    <label for="comment">Comments:</label>
    <textarea id="comment" name="comment"></textarea><br>

    <label for="email">Email address:</label>
    <input type="email" id="email" name="email"><br>

    <input type="submit" name="submit" value="Submit">
</form>