<?php
session_start();
$message = '';
$message_type = ''; // 'success' or 'danger'

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login.php");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch roles for the dropdown
$roles = [];
$role_result = $mysqli->query("SELECT id, name FROM roles ORDER BY name");
if ($role_result) {
    while ($row = $role_result->fetch_assoc()) {
        $roles[] = $row;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $full_name = trim($_POST['full_name']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $role_id = (int)$_POST['role_id'];

    // Basic validation
    if (empty($username) || empty($full_name) || empty($password) || empty($role_id)) {
        $message = "Please fill in all required fields.";
        $message_type = 'danger';
    } else {
        // Check if username already exists
        $stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Username already exists. Please choose a different one.";
            $message_type = 'danger';
        } else {
            // Hash the password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user
            $insert_stmt = $mysqli->prepare("INSERT INTO users (username, full_name, password_hash, email, phone, role_id) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("sssssi", $username, $full_name, $password_hash, $email, $phone, $role_id);

            if ($insert_stmt->execute()) {
                $_SESSION['flash_message'] = "User '{$username}' created successfully!";
                $_SESSION['flash_message_type'] = 'success';
                header("Location: ../management/user");
                exit();
            } else {
                $message = "Error creating user: " . $insert_stmt->error;
                $message_type = 'danger';
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
}

$page_title = 'Add New User';