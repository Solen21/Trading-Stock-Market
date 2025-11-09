<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';

require_once __DIR__ . '/../../../config/db_connect.php';

// Check for required parameters
if (isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['status'])) {
    $user_id = $_GET['id'];
    $new_status = $_GET['status'];

    // Prevent an admin from deactivating their own account
    if ($user_id == $_SESSION['user_id']) {
        $_SESSION['flash_message'] = "Error: You cannot change your own status.";
        $_SESSION['flash_message_type'] = 'danger';
        header("Location: ../../../frontend/admin/management/user");
        exit();
    }

    // Validate that the status is one of the allowed values
    if ($new_status === 'Active' || $new_status === 'Inactive') {
        $stmt = $mysqli->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $user_id);

        if ($stmt->execute()) {
            $_SESSION['flash_message'] = "User status has been updated successfully.";
            $_SESSION['flash_message_type'] = 'success';
        } else {
            $_SESSION['flash_message'] = "Error updating user status: " . $stmt->error;
            $_SESSION['flash_message_type'] = 'danger';
        }
        $stmt->close();
    }
}

// Redirect back to the user management page
header("Location: /project/Abiel/frontend/admin/management/user");
exit();
