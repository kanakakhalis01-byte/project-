<?php
session_start();
require 'config/database.php';

$error = '';

// periksa method post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // periksa data yang ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            //login sukses
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit();
        } else {
            $error = 'Invalid password.';
        }
    } else {
        $error = 'No user found with that username.';
    }
    $stmt->close();
}
$conn->close();
?>
<?php include 'src/templates/header.php'; ?>

<section style="padding: 120px 15%;">
    <div class="main-text">
        <h2>Login</h2>
    </div>
    <form action="login.php" method="POST">
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <div style="margin-bottom: 15px;">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</section>

<?php include 'src/templates/sidebar.php'; ?>