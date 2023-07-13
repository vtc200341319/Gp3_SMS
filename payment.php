<?php

session_start();

require_once 'connectdb.php';
require_once 'braintree_php/lib/Braintree.php';

$gateway = new Braintree\Gateway([
    'environment' => 'sandbox',
    'merchantId' => 'x676yr9pjhvq7wbf',
    'publicKey' => 'nbq5sjyh6v6yy7bv',
    'privateKey' => '7f44517a7c9aac4f45fc87cd4f1ec543'
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nonce = $_POST['payment_method_nonce'];
    $amount = $_POST['amount'];
    $paymentOption = $_POST['payment_option'];
    $paymentTime = date('Y-m-d H:i:s');

    if ($paymentOption === 'credit-card') {
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            echo '<!DOCTYPE html>
            <html>
            <head>
                <title>Payment Receipt</title>
                <style>
                    .receipt {
                        width: 400px;
                        margin: 50px auto;
                        padding: 20px;
                        border: 1px solid #ccc;
                        font-family: Arial, sans-serif;
                    }
                    .receipt h2 {
                        text-align: center;
                    }
                    .receipt p {
                        margin-bottom: 10px;
                    }
                    .receipt .label {
                        font-weight: bold;
                    }
                    .receipt .transaction-id {
                        color: #007bff;
                    }
                </style>
            </head>
            <body>
                <div class="receipt">
                    <h2>Payment Receipt</h2>
                    <br>
                    <p class="label">Payment Status:</p>
                    <p>Payment successful</p>
                    <p class="label">Transaction ID:</p>
                    <p class="transaction-id">' . $result->transaction->id . '</p>
                    <p class="label">Payment Option:</p>
                    <p>' . $paymentOption . '</p>
                    <p class="label">Amount:</p>
                    <p>$' . $result->transaction->amount . '</p>
                    <p class="label">Date:</p>
                    <p>' . $paymentTime . '</p>
                </div>
            </body>
            </html>';

            $studentno = $_SESSION['loginID'];
            $authorizedCode = $result->transaction->id;

            $sql = "INSERT INTO payment (paymentMethod, total, status, payDT, authorizedCode, studentRegNumber) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$paymentOption, $amount, 'success', $paymentTime, $authorizedCode, $studentno]);

        } else if ($result->transaction) {
            echo '<p>Payment failed. Error message: ' . $result->transaction->processorResponseText . '</p>';
        } else {
            echo '<p>Payment failed. Error message: ' . $result->message . '</p>';
        }
    } else {

    }
}

/* Braintree Test Card：
  Visa：4111 1111 1111 1111
  Mastercard：5555 5555 5555 4444
  American Express：3782 822463 10005
  Discover：6011 1111 1111 1117
  JCB：3530 1113 3330 0000 */
?>
