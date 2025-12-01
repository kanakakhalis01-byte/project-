<?php include 'templates/header.php'; ?>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h1>
<p>This is the admin dashboard. You can manage products and transactions from the sidebar.</p>
<?php include 'templates/footer.php'; ?>