<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';
$message = '';
$message_type = '';
$user = null;

require_once __DIR__ . '/../../../config/db_connect.php';

// Check for user ID in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: User ID is required.");
}
$user_id = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];

    // Basic validation
    if (empty($password)) {
        $message = "Password cannot be empty.";
        $message_type = 'danger';
    } else {
        // Hash the new password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the update statement
        $stmt = $mysqli->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $stmt->bind_param("si", $password_hash, $user_id);

        if ($stmt->execute()) {
            $message = "Password has been reset successfully!";
            $message_type = 'success';
        } else {
            $message = "Error resetting password: " . $stmt->error;
            $message_type = 'danger';
        }
        $stmt->close();
    }
}

// Fetch user data to display who we are editing
$stmt = $mysqli->prepare("SELECT username, full_name FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    die("Error: User not found.");
}
$stmt->close();

// Fetch general system settings for the header
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Reset Password';
?>
