<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';

// Fetch system settings for display
require_once __DIR__ . '/../../../config/db_connect.php';
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
$page_title = 'User Management'; // Define the page title

// Fetch all users
$users = [];
$sql = "SELECT u.id, u.username, u.full_name, u.email, u.status, r.name as role_name 
        FROM users u 
        JOIN roles r ON u.role_id = r.id 
        ORDER BY u.full_name ASC";
$result = $mysqli->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}