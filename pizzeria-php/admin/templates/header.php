<?php
// Gerbang keamanan admin
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Dapatkan nama file saat ini untuk menandai link aktif
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link rel="stylesheet" href="../public/css_admin/admin.css">

</head>
<body>
    <div class="sidebar">
        <h2>Pizzeria Admin</h2>
        <ul>
            <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Dashboard</a></li>
            <li><a href="products.php" class="<?php echo ($current_page == 'products.php') ? 'active' : ''; ?>">Products</a></li>
            <li><a href="transactions.php" class="<?php echo ($current_page == 'transactions.php') ? 'active' : ''; ?>">Transactions</a></li>
            <li><a href="settings.php" class="<?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">Settings</a></li>
            
            <li style="margin-top: 20px; border-top: 1px solid #34495e; padding-top: 10px;">
                <a href="../index.php" target="_blank">View Homepage</a>
            </li>
            
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">