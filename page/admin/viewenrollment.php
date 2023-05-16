<!DOCTYPE html>
<html>
    <head>
        <title>View Enrollment</title>
        <link href="../../css/viewenrollment.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
          <P>
        <form method="GET" action="">
            <input type="text" name="filter" placeholder="Name" value="<?php echo isset($_GET['filter']) ? $_GET['filter'] : ''; ?>">
            <input type="text" name="filterSex" placeholder="Sex" value="<?php echo isset($_GET['filterSex']) ? $_GET['filterSex'] : ''; ?>">
            <input type="text" name="filterDOB" placeholder="Date of birth" value="<?php echo isset($_GET['filterDOB']) ? $_GET['filterDOB'] : ''; ?>">
            <input type="text" name="filterPOB" placeholder="Place of birth" value="<?php echo isset($_GET['filterPOB']) ? $_GET['filterPOB'] : ''; ?>">
            <input type="text" name="filterAddress" placeholder="Address" value="<?php echo isset($_GET['filterAddress']) ? $_GET['filterAddress'] : ''; ?>">
            <input type="text" name="filterClassNumber" placeholder="Class number" value="<?php echo isset($_GET['filterClassNumber']) ? $_GET['filterClassNumber'] : ''; ?>">
            <input type="text" name="filterClassName" placeholder="Class name" value="<?php echo isset($_GET['filterClassName']) ? $_GET['filterClassName'] : ''; ?>">
            <input type="text" name="filterParentsRegCode" placeholder="Parents reg code" value="<?php echo isset($_GET['filterParentsRegCode']) ? $_GET['filterParentsRegCode'] : ''; ?>">
            <button type="submit">Search</button>
            <button type="button" onclick="clearFilter()">Clear</button>
        </form>
        <P>
        <?php
        require_once '../../connectdb.php';

        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
        $filterSex = isset($_GET['filterSex']) ? $_GET['filterSex'] : '';
        $filterDOB = isset($_GET['filterDOB']) ? $_GET['filterDOB'] : '';
        $filterPOB = isset($_GET['filterPOB']) ? $_GET['filterPOB'] : '';
        $filterAddress = isset($_GET['filterAddress']) ? $_GET['filterAddress'] : '';
        $filterClassNumber = isset($_GET['filterClassNumber']) ? $_GET['filterClassNumber'] : '';
        $filterClassName = isset($_GET['filterClassName']) ? $_GET['filterClassName'] : '';
        $filterParentsRegCode = isset($_GET['filterParentsRegCode']) ? $_GET['filterParentsRegCode'] : '';

        $query = "SELECT * FROM `student`
    WHERE (`studentEngName` LIKE :filter OR `studentChiName` LIKE :filter)
    AND (`studentSex` LIKE :filterSex)
    AND (`studentDateOfBirth` LIKE :filterDOB)
    AND (`studentPlaceOfBirth` LIKE :filterPOB)
    AND (`studentAddress` LIKE :filterAddress)
    AND (`classNumber` LIKE :filterClassNumber)
    AND (`className` LIKE :filterClassName)
    AND (`parentsRegCode` LIKE :filterParentsRegCode)";

        $stmt = $pdo->prepare($query);

        $stmt->bindValue(':filter', '%' . $filter . '%', PDO::PARAM_STR);
        $stmt->bindValue(':filterSex', '%' . $filterSex . '%', PDO::PARAM_STR);
        $stmt->bindValue(':filterDOB', '%' . $filterDOB . '%', PDO::PARAM_STR);
        $stmt->bindValue(':filterPOB', '%' . $filterPOB . '%', PDO::PARAM_STR);
        $stmt->bindValue(':filterAddress', '%' . $filterAddress . '%', PDO::PARAM_STR);
        $stmt->bindValue(':filterClassNumber', '%' . $filterClassNumber . '%', PDO::PARAM_STR);
        $stmt->bindValue(':filterClassName', '%' . $filterClassName . '%', PDO::PARAM_STR);
        $stmt->bindValue(':filterParentsRegCode', '%' . $filterParentsRegCode . '%', PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt) {
            echo "<table>";
            echo "<tr><th>Eng Name</th><th>Chi Name</th><th>Sex</th><th>Date Of Birth</th><th>Place Of Birth</th>
      <th>Address</th><th>Class Number</th><th>Class Name</th><th>Parents Reg Code</th></tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr class='record-row'>";
                echo "<td>" . $row['studentEngName'] . "</td>";
                echo "<td>" . $row['studentChiName'] . "</td>";
                echo "<td>" . $row['studentSex'] . "</td>";
                echo "<td>" . $row['studentDateOfBirth'] . "</td>";
                echo "<td>" . $row['studentPlaceOfBirth'] . "</td>";
                echo "<td>" . $row['studentAddress'] . "</td>";
                echo "<td>" . $row['classNumber'] . "</td>";
                echo "<td>" . $row['className'] . "</td>";
                echo "<td>" . $row['parentsRegCode'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
            $count = $stmt->rowCount();
            echo "<p>Total records: $count</p>";
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Error: " . $errorInfo[2];
        }
        ?>

        <script>
            function clearFilter() {
                window.location.href = 'viewenrollment.php';
            }

            document.addEventListener('DOMContentLoaded', function () {
                var rows = document.querySelectorAll('.record-row');
                rows.forEach(function (row) {
                    row.addEventListener('mouseover', function () {
                        this.style.backgroundColor = 'lightgray';
                    });

                    row.addEventListener('mouseout', function () {
                        this.style.backgroundColor = '';
                    });
                });
            });
        </script>
    </body>
</html>