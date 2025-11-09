<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';

require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch all companies to display on the page
$companies = $mysqli->query("SELECT id, name, contact_person, country, email, phone, created_at FROM companies ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);

// Fetch general system settings for the header
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Company Management';
?>
