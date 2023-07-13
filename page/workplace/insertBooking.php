<?php
require_once '../../connectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    $reason = $_POST['reason'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $schoolFacilitiesCode = $_POST['schoolFacilitiesCode'];
    $approval = $_POST['approval'];
    $staffCode = $_POST['staffCode'];

    $query = "INSERT INTO `booking_facility_application` (`reason`, `startDate`, `endDate`, `startTime`, `endTime`, `schoolFacilitiesCode`, `approval`, `staffCode`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$reason, $startDate, $endDate, $startTime, $endTime, $schoolFacilitiesCode, $approval, $staffCode]);

    header('Location: facilityReservation.php');
    exit();
}
?>
