<?php
require 'config.php';
require 'database.php';

if (isset($_POST['txnid']) && isset($_POST['status'])) {
    $txn_id = $_POST['txnid'];
    $status = $_POST['status'];

    // Update transaction status in database
    if (update_transaction_status($txn_id, $status)) {
        echo "OK";
    } else {
        echo "ERROR";
    }
} else {
    echo "ERROR";
}
?>
