<!DOCTYPE html>
<html>
<head>
  <title>iMail</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
    }

    h1 {
      color: #333;
    }

    form {
      max-width: 500px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    textarea {
      height: 150px;
    }

    input[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h1>iMail</h1>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST["to"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $smtpServer = 'smtp.school-fyp-gp3.tech';
    $smtpPort = 25;
    $username = 's20230001@school-fyp-gp3.tech';  
    $password = 'OhCMiFE2';  

    $headers = "From: $username\r\n";
    $headers .= "Reply-To: $username\r\n";
    $headers .= "Content-Type: text/html\r\n";

    if (mail($to, $subject, $message, $headers, "-f$username")) {
      echo "Email sent successfully!";
    } else {
      echo "Failed to send email!";
    }
  }
  ?>

  <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="to">Recipient:</label>
    <input type="text" id="to" name="to" required><br>

    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject" required><br>

    <label for="message">Message:</label><br>
    <textarea id="message" name="message" rows="5" required></textarea><br>

    <input type="submit" value="Send">
  </form>
</body>
</html>
