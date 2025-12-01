<?php
session_start();
require 'config/database.php';

// Periksa apakah pengguna sudah login. Jika tidak, redirect ke halaman login.
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Ambil user_id dari session untuk mengambil data yang benar
$user_id = $_SESSION['user_id'];

// Inisialisasi keranjang jika belum ada (diperlukan untuk header)
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<?php include 'src/templates/header.php'; ?>

<section class="transaction-container" style="padding: 120px 15%;">
    <div class="main-text">
        <h2>Transaction History</h2>
    </div>
    <div id="transaction-list">
        <?php
        // Ambil data transaksi HANYA untuk pengguna yang sedang login
        $stmt = $conn->prepare("SELECT * FROM transactions WHERE user_id = ? ORDER BY transaction_time DESC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $transactions_result = $stmt->get_result();

        if ($transactions_result->num_rows > 0):
            foreach ($transactions_result as $transaction):
        ?>
                <div class="transaction" style="background-color: #fff; padding: 20px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                    <h3>Transaction ID: <?php echo $transaction['id']; ?></h3>
                    <p>Date: <?php echo $transaction['transaction_time']; ?></p>
                    <p>Total: $<?php echo number_format($transaction['total'], 2); ?></p>
                    <p>Status: <?php echo htmlspecialchars($transaction['status']); ?></p>
                    <h4>Items:</h4>
                    <ul>
                        <?php
                        // Ambil item untuk setiap transaksi
                        $item_sql = "SELECT p.name, ti.quantity FROM transaction_items ti JOIN products p ON ti.product_id = p.id WHERE ti.transaction_id = " . $transaction['id'];
                        $items_result = $conn->query($item_sql);
                        foreach ($items_result as $item):
                        ?>
                            <li><?php echo htmlspecialchars($item['name']); ?> x<?php echo $item['quantity']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php
            endforeach;
        else:
        ?>
            <p>You have no transaction history yet.</p>
        <?php endif; $stmt->close(); ?>
    </div>
</section>

<?php 
include 'src/templates/sidebar.php'; 
$conn->close();
?>  