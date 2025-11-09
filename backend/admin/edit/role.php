<?php
session_start();
$message = '';
$message_type = '';
$role = null;

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: /project/Abiel/public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

// Check for role ID in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Role ID is required.");
}
$role_id = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (empty($name)) {
        $message = "Role name cannot be empty.";
        $message_type = 'danger';
    } else {
        $stmt = $mysqli->prepare("UPDATE roles SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $role_id);

        if ($stmt->execute()) {
            $message = "Role updated successfully!";
            $message_type = 'success';
        } else {
            $message = "Error updating role: " . $stmt->error;
            $message_type = 'danger';
        }
        $stmt->close();
    }
}

// Fetch current role data to populate the form
$stmt = $mysqli->prepare("SELECT id, name, description FROM roles WHERE id = ?");
$stmt->bind_param("i", $role_id);
$stmt->execute();
$result = $stmt->get_result();
$role = $result->fetch_assoc();
$stmt->close();

// Fetch general system settings for the header
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Edit Role';
?>

