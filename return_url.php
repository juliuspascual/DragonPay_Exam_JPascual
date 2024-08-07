<?php
require 'config.php';
require 'database.php';

$txn_id = $_GET['txnid'];
$reference = $_GET['refno'];

$transaction_details = get_transaction_details($txn_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Summary</title>
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
    <h1>Payment Summary</h1>
    <p>Transaction ID: <?php echo htmlspecialchars($txn_id); ?></p>
    <p>Reference No: <?php echo htmlspecialchars($reference); ?></p>
    <p>Status: <?php echo htmlspecialchars($transaction_details['status']); ?></p>
    <p>Amount: <?php echo htmlspecialchars($transaction_details['amount']); ?></p>
    <a href="index.php">return</a>
</body>
</html>
