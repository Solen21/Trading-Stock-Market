<?php
session_start();
$message = '';
$message_type = '';
$user = null;
$roles = [];

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch all roles for the dropdown
$roles_result = $mysqli->query("SELECT id, name FROM roles ORDER BY name ASC");
while ($row = $roles_result->fetch_assoc()) {
    $roles[] = $row;
}

// Check for user ID in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: User ID is required.");
}
$user_id = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role_id = $_POST['role_id'];

    // Basic validation
    if (empty($full_name) || empty($username) || empty($role_id)) {
        $message = "Full Name, Username, and Role are required fields.";
        $message_type = 'danger';
    } else {
        // Prepare and execute the update statement
        $stmt = $mysqli->prepare("UPDATE users SET full_name = ?, username = ?, email = ?, phone = ?, role_id = ? WHERE id = ?");
        $stmt->bind_param("ssssii", $full_name, $username, $email, $phone, $role_id, $user_id);

        if ($stmt->execute()) {
            $message = "User updated successfully!";
            $message_type = 'success';
        } else {
            $message = "Error updating user: " . $stmt->error;
            $message_type = 'danger';
        }
        $stmt->close();
    }
}

// Fetch current user data to populate the form
$stmt = $mysqli->prepare("SELECT full_name, username, email, phone, role_id FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    die("Error: User not found.");
}
$stmt->close();

// Fetch general system settings for the header and page
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Edit User';
?>