<?php
session_start();

require_once 'connectdb.php';

/*if (!isset($_SESSION['loginID'])) {
    header("Location: login.php");
    exit;
}*/

$studentno = $_SESSION['loginID'];

$sql = "SELECT * FROM payment WHERE studentRegNumber = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$studentno]);
$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Record</title>
    <style>
        .payment-record {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            font-family: Arial, sans-serif;
        }
        .payment-record h2 {
            text-align: center;
        }
        .payment-record table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .payment-record th,
        .payment-record td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="payment-record">
        <h2>Payment Record</h2>
        <table>
            <tr>
                <th>Payment ID</th>
                <th>Payment Method</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Payment Time</th>
                <th>Transaction ID</th>
            </tr>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?php echo $payment['PaymentID']; ?></td>
                    <td><?php echo $payment['paymentMethod']; ?></td>
                    <td><?php echo $payment['total']; ?></td>
                    <td><?php echo $payment['status']; ?></td>
                    <td><?php echo $payment['payDT']; ?></td>
                    <td><?php echo $payment['authorizedCode']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
