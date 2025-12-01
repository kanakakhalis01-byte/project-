<?php
require '../config/database.php';
include 'templates/header.php';

$update_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $admin_id = $_SESSION['admin_id'];

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admins SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $admin_id);
        if ($stmt->execute()) {
            $update_message = "Password updated successfully.";
        } else {
            $error_message = "Failed to update password.";
        }
        $stmt->close();
    } else {
        $error_message = "Passwords do not match.";
    }
}
?>

<h1>Admin Settings</h1>
<div class="form-container">
    <h2>Change Password</h2>
    <?php if ($update_message): ?><p class="message success"><?php echo $update_message; ?></p><?php endif; ?>
    <?php if ($error_message): ?><p class="message error"><?php echo $error_message; ?></p><?php endif; ?>
    <form action="settings.php" method="POST">
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn">Update Password</button>
    </form>
</div>

