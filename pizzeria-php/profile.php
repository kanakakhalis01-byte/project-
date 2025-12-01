<?php
session_start();
require 'config/database.php';

// Jika pengguna belum login, redirect ke halaman login
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit();
}

// ambil id pengguna dari session
$user_id = $_SESSION['user_id'];
$update_message = '';
$error_message = '';

// periksa method post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update username
    if (!empty($_POST['new_username'])) {
        $new_username = $_POST['new_username'];
        // Pastikan username baru belum digunakan
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
        $stmt->bind_param("si", $new_username, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error_message .= "Username already taken.<br>";
        } else {
            //usname tersedia, update
            $update_stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
            $update_stmt->bind_param("si", $new_username, $user_id);
            if ($update_stmt->execute()) {
                $_SESSION['username'] = $new_username; // Update session
                $update_message .= "Username updated successfully.<br>";
            }
        }
        $stmt->close();
    }

    // Update password
    if (!empty($_POST['new_password'])) {
        if ($_POST['new_password'] === $_POST['confirm_password']) {
            $new_password_hashed = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            //simpan password baru
            $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update_stmt->bind_param("si", $new_password_hashed, $user_id);
            if ($update_stmt->execute()) {
                $update_message .= "Password updated successfully.<br>";
            }
        } else {
            $error_message .= "New passwords do not match.<br>";
        }
    }
}

$conn->close();
?>
<?php include 'src/templates/header.php'; ?>

<section style="padding: 120px 15%;">
    <div class="main-text">
        <h2>My Profile</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    </div>

    <?php if ($update_message): ?>
        <p style="color: green;"><?php echo $update_message; ?></p>
    <?php endif; ?>
    <?php if ($error_message): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form action="profile.php" method="POST">
        <h4>Change Username</h4>
        <div style="margin-bottom: 15px;">
            <label for="new_username">New Username</label>
            <input type="text" id="new_username" name="new_username" style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>

        <h4>Change Password</h4>
        <div style="margin-bottom: 15px;">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>
        <button type="submit" class="btn">Update Profile</button>
    </form>
</section>

<?php include 'src/templates/sidebar.php'; ?>