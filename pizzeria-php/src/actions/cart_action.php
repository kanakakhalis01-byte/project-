<?php
session_start();
require '../../config/database.php'; // Path yang benar 

// Memeriksa apakah file ini diakses via metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $product_id = $_POST['product_id'] ?? 0;

    // Inisialisasi keranjang jika belum ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Ambil data produk dari database
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();   // $product akan berisi data produk, atau 'null' jika ID tidak ditemukan
    $stmt->close();

    switch ($action) {
        case 'add':
            if ($product) { // cek item di keranjang
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity']++;
                } else { 
                    $_SESSION['cart'][$product_id] = [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'img' => $product['img'],
                        'quantity' => 1
                    ];
                }
            }
            header('Location: ../../index.php#menu');
            exit();

        case 'buy_now':
             if ($product) {
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity']++;
                } else {
                     $_SESSION['cart'][$product_id] = [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'img' => $product['img'],
                        'quantity' => 1
                    ];
                }
             }
             goto checkout_process;

        case 'update':
            $quantity = $_POST['quantity'] ?? 1;
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] = $quantity > 0 ? $quantity : 1;
            }
            header('Location: ../../index.php#menu');
            exit();

        case 'remove':
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }
            header('Location: ../../index.php#menu');
            exit();

        case 'checkout':
            checkout_process:
            // Pastikan pengguna sudah login sebelum checkout
            if (!isset($_SESSION['user_logged_in'])) {
                // Jika belum login, arahkan ke halaman login
                header('Location: ../../login.php');
                exit();
            }   

            //Pastikan keranjang ada isi
            if (!empty($_SESSION['cart'])) {
                $total = 0;
                // hitung total
                foreach($_SESSION['cart'] as $item) {
                    $total += $item['price'] * $item['quantity'];
                }

                $user_id = $_SESSION['user_id']; // Ambil ID pengguna dari session

                // Masukkan ke tabel transactions bersama user_id
                $stmt = $conn->prepare("INSERT INTO transactions (user_id, transaction_time, total, status) VALUES (?, NOW(), ?, 'Pending')");
                $stmt->bind_param("id", $user_id, $total);
                $stmt->execute();
                $transaction_id = $stmt->insert_id;
                $stmt->close();

                // Masukkan setiap item ke tabel transaction_items
                $stmt_items = $conn->prepare("INSERT INTO transaction_items (transaction_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                foreach($_SESSION['cart'] as $item) {
                    $stmt_items->bind_param("iiid", $transaction_id, $item['id'], $item['quantity'], $item['price']);
                    $stmt_items->execute();
                }
                $stmt_items->close();
                
                // Kosongkan keranjang
                $_SESSION['cart'] = [];
                
                header('Location: ../../transactions.php');
                exit();
            }
            header('Location: ../../index.php');
            exit();
    }
}
$conn->close();
?>