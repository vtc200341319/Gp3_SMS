<?php
require_once '../../js/fpdf/fpdf.php';;

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Student Transcript', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Student Information', 0, 1);
$pdf->Cell(0, 10, 'Name: Chan Tai Man', 0, 1);
$pdf->Cell(0, 10, 'Student ID: 200099987', 0, 1);
$pdf->Cell(0, 10, 'Year: 2022-2023', 0, 1);
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Transcript', 0, 1);
$pdf->SetFont('Arial', 'B', 11);

$pdf->Cell(40, 10, 'Course Code', 1, 0, 'C');
$pdf->Cell(70, 10, 'Course Title', 1, 0, 'C');
$pdf->Cell(40, 10, 'Credit Hours', 1, 0, 'C');
$pdf->Cell(30, 10, 'Grade', 1, 1, 'C');

$pdf->SetFont('Arial', '', 11);
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

    $pdf->Cell(40, 10, $course, 1, 0, 'C');
    $pdf->Cell(70, 10, get_course_title($course), 1, 0, 'C');
    $pdf->Cell(40, 10, $credits, 1, 0, 'C');
    $pdf->Cell(30, 10, $grade, 1, 1, 'C');
}

$gpa = $total_grade_points / $total_credits;

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(150, 10, 'GPA:', 1, 0, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 10, number_format($gpa, 2), 1, 1, 'C');

$filename = 'student_transcript.pdf';
$pdf->Output('D', $filename);

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
?>
