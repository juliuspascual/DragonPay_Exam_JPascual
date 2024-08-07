<?php
require 'config.php';
require 'database.php';

$amount = $_POST['amount'];
$currency = $_POST['currency'];
$description = $_POST['description'];
$email = $_POST['email'];
$txn_id = 'txn_' . time();

// Check if amount is a number and it's greater than 0
$errors = [];
if (!is_numeric($amount)) {
    $errors[] = 'Amount should be a number.';
} elseif ($amount <= 0) {
    $errors[] = 'Amount should be greater than 0.';
}

if (empty($errors)) {
    // Amount formatter
    $amount = number_format($amount, 2, '.', '');

    $parameters = [
        'merchantid' => MERCHANT_ID,
        'txnid' => $txn_id,
        'amount' => $amount,
        'ccy' => $currency,
        'description' => $description,
        'email' => $email
    ];

    $parameters['key'] = MERCHANT_PASSWORD;

    $digest_string = implode(':', $parameters);
    unset($parameters['key']);

    $parameters['digest'] = sha1($digest_string);

    // Save the Payment details in the database
    store_transaction($txn_id, $amount, $currency, $description, $email, 'P');

    // Redirect to DragonPay URL
    $url = 'https://gw.dragonpay.ph/Pay.aspx?';
    if ($environment == ENV_TEST) {
        $url = 'http://test.dragonpay.ph/Pay.aspx?';
    }

    $url .= http_build_query($parameters, '', '&');

    header("Location: $url");
    exit;
} else {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
}
?>
