<?php
session_start();

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../public/login.php");
    exit();
}

// Fetch system settings for display
require_once __DIR__ . '/../../config/db_connect.php';

// Ensure all user data is in the session, refetch if necessary
if (!isset($_SESSION['full_name'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $mysqli->prepare("SELECT username, full_name FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['username'] = $user['username'];
    }
}

$settings = [];
$result = $mysqli->query("SELECT setting_key, setting_value FROM general_settings WHERE setting_key IN ('system_name', 'system_logo', 'system_icon', 'primary_color', 'sidebar_color', 'navbar_color')");
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$system_name = $settings['system_name'] ?? 'Product Management System';
$system_logo = $settings['system_logo'] ?? '';
$system_icon = $settings['system_icon'] ?? 'fas fa-igloo';
$primary_color = $settings['primary_color'] ?? '#007bff';
$sidebar_color = $settings['sidebar_color'] ?? '#343a40';
$navbar_color = $settings['navbar_color'] ?? '#f8f9fa';
$page_title = 'Dashboard'; // Define the page title