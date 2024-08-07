<?php
require 'config.php';
require 'database.php';
$transactions = get_all_transactions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DragonPay Integration</title>
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
    <h1>Send Payment Request</h1>
    <form action="process_payment.php" method="POST">
        <label for="amount">Amount:</label>
        <input type="text" id="amount" name="amount" required>
        <br>
        <label for="currency">Currency:</label>
        <input type="text" id="currency" name="currency" required>
        <br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <button type="submit">Pay with DragonPay</button>
    </form>
    
    <h1>Transaction History</h1>
    <table border="2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Description</th>
                <th>Email</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?php echo htmlspecialchars($transaction['txn_id']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['amount']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['currency']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['email']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['status']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script src="scripts/main.js"></script>
</body>
</html>
