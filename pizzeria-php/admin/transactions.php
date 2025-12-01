<?php 
require '../config/database.php';
include 'templates/header.php';

// Menggunakan JOIN untuk mengambil nama pengguna dari tabel users
$query = "
    SELECT t.id, t.transaction_time, t.total, t.status, u.username 
    FROM transactions t 
    JOIN users u ON t.user_id = u.id 
    ORDER BY t.transaction_time DESC
";
$transactions = $conn->query($query);
?>

<h1>Manage Transactions</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Username</th>
            <th>Total</th>
            <th>Status</th>
            <th>Update Status</th> </tr>
    </thead>
    <tbody>
        <?php while($transaction = $transactions->fetch_assoc()): ?>
        <tr>
            <td><?php echo $transaction['id']; ?></td>
            <td><?php echo $transaction['transaction_time']; ?></td>
            <td><?php echo htmlspecialchars($transaction['username']); ?></td>
            <td>$<?php echo number_format($transaction['total'], 2); ?></td>
            <td><?php echo htmlspecialchars($transaction['status']); ?></td>
            <td>
                <form action="actions/transaction_actions.php" method="POST" style="margin: 0;">
                    <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
                    <select name="status" onchange="this.form.submit()">
                        <option value="Pending" <?php echo ($transaction['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Processing" <?php echo ($transaction['status'] == 'Processing') ? 'selected' : ''; ?>>Processing</option>
                        <option value="Completed" <?php echo ($transaction['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                        <option value="Cancelled" <?php echo ($transaction['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'templates/footer.php'; ?>

