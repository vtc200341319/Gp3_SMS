<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Transcript</title>
    <link href="../../css/academicPerformance.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
    <script src="../../js/StudentTranscript.js" type="text/javascript"></script>
    
</head>
<body>
 <form action="generate_pdf.php" method="post">
    <h1>Student Transcript</h1>
    <div class="student-info">
        <h2>Student Information</h2>
        <p>Name: Chan Tai Man</p>
        <p>Student ID: 200099987</p>
        <p>Year: 2022-2023</p>
    </div>
    <div class="transcript-table">
        <h2>Transcript</h2>
        <table>
            <tr>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Credit Hours</th>
                <th>Grade</th>
            </tr>
            <?php
                $grades = array(
                    "Math" => 90,
                    "English" => 85,
                    "Science" => 95,
                    "History" => 80,
                    "Art" => 92
                );

                $total_credits = 0;
                $total_grade_points = 0;

                foreach ($grades as $course => $grade) {
                    $credits = 3; 
                    $total_credits += $credits;
                    $grade_points = calculate_grade_points($grade);
                    $total_grade_points += $grade_points;
                    echo "<tr><td>" . $course . "</td><td>" . get_course_title($course) . "</td><td>" . $credits . "</td><td>" . $grade . "</td></tr>";
                }

                function calculate_grade_points($grade) {
                    if ($grade >= 90) {
                        return 4.0;
                    } elseif ($grade >= 80) {
                        return 3.0;
                    } elseif ($grade >= 70) {
                        return 2.0;
                    } elseif ($grade >= 60) {
                        return 1.0;
                    } else {
                        return 0.0;
                    }
                }

                function get_course_title($course_code) {
                    switch ($course_code) {
                        case "Math":
                            return "Mathematics";
                        case "English":
                            return "English Language";
                        case "Science":
                            return "Science";
                        case "History":
                            return "History";
                        case "Art":
                            return "Art";
                        default:
                            return "";
                    }
                }

                $gpa = $total_grade_points / $total_credits;
                echo "<tr><td></td><td><b>GPA:</b></td><td><b>" . number_format($gpa, 2) . "</b></td><td></td></tr>";
            ?>
        </table>
    </div>

    <button class="generate-btn" >Download PDF</button>
</body>
</html>