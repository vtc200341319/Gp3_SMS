<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Borrowing & Returning Records</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table th, table td {
      padding: 10px;
      border: 1px solid #ccc;
    }

    table th {
      background-color: #f2f2f2;
      font-weight: bold;
      text-align: left;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>
  <h1>Borrowing & Returning Records</h1>

  <table>
    <thead>
      <tr>
        <th>Record ID</th>
        <th>Borrow Date</th>
        <th>Return Date</th>
        <th>Book ISBN</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once '../../connectdb.php';
        $sql = "SELECT `studentsBARRecordID`, `borrowDate`, `returnDate`, `bookISBN` FROM `student_borrow_and_return_books_record`";
        $stmt = $pdo->query($sql);
        $records = $stmt->fetchAll();

        foreach ($records as $record) {
          echo "<tr>";
          echo "<td>" . $record['studentsBARRecordID'] . "</td>";
          echo "<td>" . $record['borrowDate'] . "</td>";
          echo "<td>" . $record['returnDate'] . "</td>";
          echo "<td>" . $record['bookISBN'] . "</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</body>
</html>
