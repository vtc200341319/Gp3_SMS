<!DOCTYPE html>
<html>
<head>
    <title>General Data Storage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="post" action="generate_pdf.php">
        <button type="submit" name="btn" value="student">Student Personal Information</button>
        <br>
        <br>
        <button type="submit" name="btn" value="staff">Staff Personal Information</button>
    </form>
</body>
</html>
