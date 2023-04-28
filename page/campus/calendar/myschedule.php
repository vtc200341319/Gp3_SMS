<!DOCTYPE html>
<html>
<head>
  <title>My Schedule</title>
 <link rel="stylesheet" type="text/css" href="../../../css/myschedule.css">
</head>
<body>
  <h1>My Schedule</h1>

  <?php
    // Define an array of schedule items
    $scheduleItems = array(
      array("Day 1", "9:00 AM - 10:30 AM", "Mathematics"),
      array("Day 1", "11:00 AM - 12:30 PM", "English"),
      array("Day 2", "9:00 AM - 10:30 AM", "Science"),
      array("Day 2", "11:00 AM - 12:30 PM", "History")
    );

    // Loop through the schedule items and display them in a table
    echo "<table>";
    echo "<tr><th>Day</th><th>Time</th><th>Subject</th></tr>";
    foreach ($scheduleItems as $item) {
      echo "<tr>";
      foreach ($item as $value) {
        echo "<td>$value</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  ?>

</body>
</html>