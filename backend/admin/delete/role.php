<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';

require_once __DIR__ . '/../../../config/db_connect.php';

// Handle deleting a role
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $role_id = $_GET['id'];

    // Critical security check: Prevent deletion of the main Admin role (assuming ID 1)
    if ($role_id == 1) {
        $_SESSION['flash_message'] = "Error: The primary 'Admin' role cannot be deleted.";
        $_SESSION['flash_message_type'] = 'danger';
    } else {
        $stmt = $mysqli->prepare("DELETE FROM roles WHERE id = ?");
        $stmt->bind_param("i", $role_id);
        if ($stmt->execute()) {
            $_SESSION['flash_message'] = "Role deleted successfully.";
            $_SESSION['flash_message_type'] = 'success';
        } else {
            $_SESSION['flash_message'] = "Error deleting role. It might be in use by some users.";
            $_SESSION['flash_message_type'] = 'danger';
        }
        $stmt->close();
    }
}

// Redirect back to the role management page
header("Location: ../../../frontend/admin/management/role");
exit();
?>
