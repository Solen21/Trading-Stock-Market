<?php

// This script fetches system-wide settings from the database.
// It should be included in backend files where page-specific variables are set.

// Ensure a database connection exists.
if (!isset($mysqli) || $mysqli->connect_errno) {
    require_once __DIR__ . '/../../config/db_connect.php';
}

$settings = [];
$result = $mysqli->query("SELECT setting_key, setting_value FROM general_settings");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
}

$system_name = $settings['system_name'] ?? 'Product Management System';
$system_logo = $settings['system_logo'] ?? '';
$primary_color = $settings['primary_color'] ?? '#007bff';
$sidebar_color = $settings['sidebar_color'] ?? '#343a40';
$navbar_color = $settings['navbar_color'] ?? '#f8f9fa';
$system_font = $settings['system_font'] ?? 'Poppins';

