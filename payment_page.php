<!DOCTYPE html>
<html>
    <head>
        <title>Payment Form</title>
        <script src="https://js.braintreegateway.com/web/dropin/1.32.0/js/dropin.min.js"></script>
        <style>
            .hidden {
                display: none;
            }
        </style>
    </head>
    <body>
        <h1>Payment Form</h1>

        <input type="text" id="amount-input" placeholder="Enter amount" /><br><br>

        <input type="radio" name="payment-option" value="credit-card" id="credit-card-option" >
        <label for="credit-card-option">Credit Card</label>

        <input type="radio" name="payment-option" value="other-option" id="other-option">
        <label for="other-option">Other Option</label>
        <br><br>

        <div id="dropin-container" class="hidden"></div>
        <button id="submit-button" class="hidden">Pay Now</button>

        <?php
        require_once 'braintree_php/lib/Braintree.php';

        $gateway = new Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'x676yr9pjhvq7wbf',
            'publicKey' => 'nbq5sjyh6v6yy7bv',
            'privateKey' => '7f44517a7c9aac4f45fc87cd4f1ec543'
        ]);

        $clientToken = $gateway->clientToken()->generate();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nonce = $_POST['payment_method_nonce'];
            $amount = $_POST['amount'];
            $paymentOption = $_POST['payment_option'];

            $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

            if ($result->success) {
                echo '<p>Payment successful. Transaction ID: ' . $result->transaction->id . '</p>';
                echo '<p>Amount: $' . $result->transaction->amount . '</p>';
                echo '<p>Payment Option: ' . $paymentOption . '</p>';
            } else {
                echo '<p>Payment failed. Error message: ' . $result->message . '</p>';
            }
        }
        ?>

        <script>
            var creditCardOption = document.querySelector('#credit-card-option');
            var otherOption = document.querySelector('#other-option');
            var amountInput = document.querySelector('#amount-input');
            var dropinContainer = document.querySelector('#dropin-container');
            var submitButton = document.querySelector('#submit-button');

            creditCardOption.addEventListener('change', function () {
                if (creditCardOption.checked) {
                    dropinContainer.classList.remove('hidden');
                    submitButton.classList.remove('hidden');
                } else {
                    dropinContainer.classList.add('hidden');
                    submitButton.classList.add('hidden');
                }
            });

            otherOption.addEventListener('change', function () {
                if (otherOption.checked) {
                    dropinContainer.classList.add('hidden');
                    submitButton.classList.add('hidden');
                } else {
                    dropinContainer.classList.remove('hidden');
                    submitButton.classList.remove('hidden');
                }
            });

            var button = document.querySelector('#submit-button');

            braintree.dropin.create({
                authorization: '<?php echo $clientToken; ?>',
                container: '#dropin-container'
            }, function (err, dropinInstance) {
                if (err) {
                    console.error(err);
                    return;
                }

                button.addEventListener('click', function () {
                    if (amountInput.value.trim() === '') {
                        alert('Please enter an amount.');
                        return;
                    }

                    dropinInstance.requestPaymentMethod(function (err, payload) {
                        if (err) {
                            console.error(err);
                            return;
                        }

                        var form = document.createElement('form');
                        form.action = 'payment.php';
                        form.method = 'post';

                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'payment_method_nonce');
                        hiddenInput.setAttribute('value', payload.nonce);

                        var amountInputHidden = document.createElement('input');
                        amountInputHidden.setAttribute('type', 'hidden');
                        amountInputHidden.setAttribute('name', 'amount');
                        amountInputHidden.setAttribute('value', amountInput.value);

                        var paymentOptionInput = document.createElement('input'); 
                        paymentOptionInput.setAttribute('type', 'hidden');
                        paymentOptionInput.setAttribute('name', 'payment_option');
                        paymentOptionInput.setAttribute('value', creditCardOption.checked ? 'credit-card' : 'other-option');

                        form.appendChild(hiddenInput);
                        form.appendChild(amountInputHidden);
                        form.appendChild(paymentOptionInput);
                        document.body.appendChild(form);
                        form.submit();
                    });
                });
            });
        </script>
    </body>
</html>
