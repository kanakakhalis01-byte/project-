<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizza Website</title>
    <link rel="stylesheet" href="public/css/Pizza website.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="index.php" class="logo"><img src="public/img/logoutama.png" alt="logo"></a>
        <ul class="navbar">
            <li><a href="index.php#home">Home</a></li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="index.php#menu">Menu</a></li>
            <li><a href="index.php#contact">Contact</a></li>
            <li><a href="transactions.php">Transaction History</a></li>
        </ul>
<div class="h-icons">
    <div class="user-info">
        <?php if (isset($_SESSION['user_logged_in'])): ?>
            <span class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </div>
    
    <a href="#" id="cart-icon">
        <i class='bx bx-cart'></i>
        <span id="cart-count"><?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?></span>
    </a>
    <div class="bx bx-menu" id="menu-icon"></div>
</div>
    </header>