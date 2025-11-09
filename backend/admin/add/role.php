<?php
session_start();
$message = '';
$message_type = '';

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: /project/Abiel/public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

// Handle adding a new role
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (!empty($name)) {
        $stmt = $mysqli->prepare("INSERT INTO roles (name, description) VALUES (?, ?)");

        try {
            $stmt->bind_param("ss", $name, $description);
            if ($stmt->execute()) {
                $_SESSION['flash_message'] = "Role '{$name}' added successfully.";
                $_SESSION['flash_message_type'] = 'success';
                header("Location: ../../management/role");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) { // 1062 is the MySQL error code for a duplicate entry
                $_SESSION['flash_message'] = "A role with that name already exists. Please choose a different name.";
                $_SESSION['flash_message_type'] = 'danger';
            } else {
                $_SESSION['flash_message'] = "Database error: " . $e->getMessage();
                $_SESSION['flash_message_type'] = 'danger';
            }
            header("Location: role");
            exit();
        }
        $stmt->close();
    } else {
        $message = "Role name cannot be empty.";
        $message_type = 'danger';
    }
}

// Fetch general system settings for the header
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Add New Role';
?>
