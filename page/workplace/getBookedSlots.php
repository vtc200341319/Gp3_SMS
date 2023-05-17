<?php
require_once '../../connectdb.php';

if (isset($_GET['facility'])) {
    $facility = $_GET['facility'];

    $query = "SELECT `bookFacilityID`, `reason`, `startDate`, `endDate`, `startTime`, `endTime`, `schoolFacilitiesCode`, `approval`, `staffCode` FROM `booking_facility_application` WHERE `schoolFacilitiesCode` = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$facility]);

    $bookedSlots = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $bookedSlot = [
            'title' => 'Booked',
            'start' => $row['startDate'] . 'T' . $row['startTime'],
            'end' => $row['endDate'] . 'T' . $row['endTime']
        ];

        $bookedSlots[] = $bookedSlot;
    }

    echo json_encode($bookedSlots);
}
?>
