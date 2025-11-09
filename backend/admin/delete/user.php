<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';

require_once __DIR__ . '/../../../config/db_connect.php';

// Check for required parameters
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id_to_delete = $_GET['id'];

    // Prevent an admin from deleting their own account
    if ($user_id_to_delete == $_SESSION['user_id']) {
        $_SESSION['flash_message'] = "Error: You cannot delete your own account.";
        $_SESSION['flash_message_type'] = 'danger';
        header("Location: ../../../frontend/admin/management/user");
        exit();
    }

    // Prepare and execute the DELETE statement
    $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id_to_delete);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = "User has been deleted successfully.";
        $_SESSION['flash_message_type'] = 'success';
    } else {
        $_SESSION['flash_message'] = "Error deleting user: " . $stmt->error;
        $_SESSION['flash_message_type'] = 'danger';
    }
    $stmt->close();
}

// Redirect back to the user management page
header("Location: ../../../frontend/admin/management/user");
exit();
