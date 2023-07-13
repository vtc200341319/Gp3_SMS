<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Reservation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    form {
      max-width: 400px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="date"] {
      width: 95%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .success {
      color: green;
      font-weight: bold;
      text-align: center;
    }

    .error {
      color: red;
      font-weight: bold;
      text-align: center;
    }
  </style>
</head>
<body>
  <h1>Book Reservation</h1>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="name">Student ID:</label>
    <input type="text" id="name" name="name" required value ="20000001">

    <label for="book">Book ISBN:</label>
    <input type="text" id="book" name="book" required>

    <label for="reservation_date">Reservation Date:</label>
    <input type="date" id="reservation_date" name="reservation_date" required>

    <input type="submit" value="Create Reservation">
  </form>

  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $book = $_POST['book'];
      $reservation_date = $_POST['reservation_date'];

      $records = [
        ['Name 1', 'Book 1', '2023-07-10'],
        ['Name 2', 'Book 2', '2023-07-11'],
        ['Name 3', 'Book 3', '2023-07-12']
      ];

      $isCreated = false;
      foreach ($records as $record) {
        if ($name === $record[0] && $book === $record[1] && $reservation_date === $record[2]) {
          $isCreated = true;
          break;
        }
      }

      if ($isCreated) {
        echo '<p class="success">Reservation record created successfully!</p>';
      } else {
        echo '<p class="error">Failed to create reservation record. Please try again.</p>';
      }
    }
  ?>
</body>
</html>
