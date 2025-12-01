<?php
require '../../config/database.php';

// Periksa metode post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ambil data
    $transaction_id = $_POST['transaction_id'];
    $status = $_POST['status'];

    // Lakukan UPDATE status di database
    $stmt = $conn->prepare("UPDATE transactions SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $transaction_id);
    $stmt->execute();

    header('Location: ../transactions.php');
}
$conn->close();
?>