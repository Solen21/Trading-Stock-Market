<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';
require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch all units to display on the page
$units = $mysqli->query("SELECT id, unit_name, category, base_value, description, created_at FROM units ORDER BY unit_name ASC")->fetch_all(MYSQLI_ASSOC);

// Fetch general system settings for the header
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Units Management';
?>