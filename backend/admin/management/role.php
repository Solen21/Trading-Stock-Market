<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';

require_once __DIR__ . '/../../../config/db_connect.php';

// Handle adding a new role
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_role'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (!empty($name)) {
        $stmt = $mysqli->prepare("INSERT INTO roles (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);
        if ($stmt->execute()) {
            $_SESSION['flash_message'] = "Role '{$name}' added successfully.";
            $_SESSION['flash_message_type'] = 'success';
        } else {
            $_SESSION['flash_message'] = "Error adding role: " . $stmt->error;
            $_SESSION['flash_message_type'] = 'danger';
        }
        $stmt->close();
    } else {
        $_SESSION['flash_message'] = "Role name cannot be empty.";
        $_SESSION['flash_message_type'] = 'danger';
    }
    header("Location: ../../../frontend/admin/management/role");
    exit();
}

// Handle deleting a role
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $role_id = $_GET['delete_id'];

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
    header("Location: ../../../frontend/admin/management/role");
    exit();
}

// Fetch all roles to display on the page
$roles = $mysqli->query("SELECT id, name, description FROM roles ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);

// Fetch general system settings for the header
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Role Management';
?>
