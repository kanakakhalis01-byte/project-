<?php
session_start();
require 'config/database.php';

$error = '';
$success = '';

// periksa method post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    //validasi
    if ($password !== $password_confirm) {
        $error = "Passwords do not match.";
    } else {
        // duplikasi username
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already taken.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $insert_stmt->bind_param("ss", $username, $hashed_password);
            if ($insert_stmt->execute()) {
                $success = "Registration successful! You can now <a href='login.php'>login</a>.";
            } else {
                $error = "Error: " . $insert_stmt->error;
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
}
$conn->close();
?>
<?php include 'src/templates/header.php'; ?>

<section style="padding: 120px 15%;">
    <div class="main-text">
        <h2>Register</h2>
    </div>
    <form action="register.php" method="POST">
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php endif; ?>
        <div style="margin-bottom: 15px;">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="password_confirm">Confirm Password</label>
            <input type="password" id="password_confirm" name="password_confirm" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <button type="submit" class="btn">Register</button>
    </form>
</section>

<?php include 'src/templates/sidebar.php'; ?>