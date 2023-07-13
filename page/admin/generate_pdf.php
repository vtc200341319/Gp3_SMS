<?php
require_once '../../connectdb.php';

if (isset($_POST['btn'])) {
    $selectedBtn = $_POST['btn'];

    if ($selectedBtn == 'student') {
        $query = "SELECT `studnetID`, `studentRegNumber`, `studentEngName`, `studentSex`, `studentDateOfBirth`, `studentPlaceOfBirth`, `studentAddress`, `classNumber`, `className`, `parentsRegCode` FROM `student`";

        $stmt = $pdo->query($query);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require('../../js/fpdf/fpdf.php');

        $pdf = new FPDF('L');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(0, 10, 'Student PDF', 0, 1, 'C');

        $headers = array(
            array('field' => 'studnetID', 'label' => 'ID'),
            array('field' => 'studentRegNumber', 'label' => 'Reg Number'),
            array('field' => 'studentEngName', 'label' => 'English Name'),
            array('field' => 'studentSex', 'label' => 'Sex'),
            array('field' => 'studentDateOfBirth', 'label' => 'DateOfBirth'),
            array('field' => 'studentPlaceOfBirth', 'label' => 'PlaceOfBirth'),
            array('field' => 'studentAddress', 'label' => 'Address'),
            array('field' => 'classNumber', 'label' => 'classNumber'),
            array('field' => 'className', 'label' => 'className'),
            array('field' => 'parentsRegCode', 'label' => 'parentsRegCode'),
        );

        $columnWidths = array(15, 30, 40, 15, 30, 35, 40, 20, 25, 25); 

        foreach ($headers as $index => $header) {
            $pdf->Cell($columnWidths[$index], 10, $header['label'], 1, 0, 'C');
        }
        $pdf->Ln();

        foreach ($students as $student) {
            foreach ($headers as $index => $header) {
                $field = $header['field'];
                $pdf->Cell($columnWidths[$index], 10, $student[$field], 1, 0, 'C');
            }
            $pdf->Ln();
        }

        $pdf->Output('student.pdf', 'D');
    } elseif ($selectedBtn == 'staff') {
        $query = "SELECT `staffID`, `loginID`, `staffCode`, `staffEngName`, `staffChiName`, `staffSex`, `staffJobTitle`, `staffDateOfBirth`, `staffDateOfEmployment`, `staffPlaceOfBirth`, `staffAddress`, `staffPhoneNumber` FROM `staff`";

        $stmt = $pdo->query($query);
        $staff = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require('../../js/fpdf/fpdf.php');

        $pdf = new FPDF('L');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(0, 10, 'Staff PDF', 0, 1, 'C');

        $headers = array(
            array('field' => 'staffID', 'label' => 'ID'),
            array('field' => 'loginID', 'label' => 'Login ID'),
            array('field' => 'staffCode', 'label' => 'Staff Code'),
            array('field' => 'staffEngName', 'label' => 'English Name'),
        );

        $columnWidths = array(15, 25, 30, 35); 

        foreach ($headers as $index => $header) {
            $pdf->Cell($columnWidths[$index], 10, $header['label'], 1, 0, 'C');
        }
        $pdf->Ln();

        foreach ($staff as $member) {
            foreach ($headers as $index => $header) {
                $field = $header['field'];
                $pdf->Cell($columnWidths[$index], 10, $member[$field], 1, 0, 'C');
            }
            $pdf->Ln();
        }

        $pdf->Output('staff.pdf', 'D');
    }
}
?>
