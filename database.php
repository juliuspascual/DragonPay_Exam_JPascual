<?php
require 'config.php';

function connect_db() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function store_transaction($txn_id, $amount, $currency, $description, $email, $status) {
    $conn = connect_db();
    $stmt = $conn->prepare("INSERT INTO transactions (txn_id, amount, currency, description, email, status) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        return false;
    }
    $stmt->bind_param("ssssss", $txn_id, $amount, $currency, $description, $email, $status);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        $stmt->close();
        $conn->close();
        return false;
    }
}

function update_transaction_status($txn_id, $status) {
    $conn = connect_db();
    $stmt = $conn->prepare("UPDATE transactions SET status = ? WHERE txn_id = ?");
    if ($stmt === false) {
        return false;
    }
    $stmt->bind_param("ss", $status, $txn_id);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        $stmt->close();
        $conn->close();
        return false;
    }
}

function get_transaction_details($txn_id) {
    $conn = connect_db();
    $stmt = $conn->prepare("SELECT * FROM transactions WHERE txn_id = ?");
    if ($stmt === false) {
        return false;
    }
    $stmt->bind_param("s", $txn_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $transaction = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $transaction;
}

function get_all_transactions() {
    $conn = connect_db();
    $stmt = $conn->prepare("SELECT * FROM transactions");
    if ($stmt === false) {
        return false;
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $transactions = [];
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
    $stmt->close();
    $conn->close();
    return $transactions;
}
?>
