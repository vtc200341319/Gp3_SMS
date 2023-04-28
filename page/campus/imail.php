<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all required fields.";
    } else {
        $recipient = "youremail@example.com";
        $email_subject = "New message from: $name";
        $email_body = "Name: $name\n";
        $email_body .= "Email: $email\n";
        $email_body .= "Subject: $subject\n";
        $email_body .= "Message:\n$message\n";

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain;charset=utf-8\r\n";

        if (mail($recipient, $email_subject, $email_body, $headers)) {
            echo "Thank you for your message. It has been sent.";
        } else {
            echo "There was an issue sending your message. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iMail</title>
    <link href="../../css/imail.css" rel="stylesheet" type="text/css"/>
</head>
<body>
   
    <h1>iMail</h1>
    <form action="imail.php" method="post">
        <label for="name">Name: *</label>
        <input type="text" name="name" id="name" required>
        <label for="email">Email: *</label>
        <input type="email" name="email" id="email" required>
        <label for="subject">Subject: *</label>
        <input type="text" name="subject" id="subject" required>
        <label for="message">Message: *</label>
        <textarea name="message" id="message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
    <script src="../../js/imail.js" type="text/javascript"></script>
</body>
</html>
