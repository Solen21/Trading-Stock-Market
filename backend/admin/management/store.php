<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';

require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch all stores to display on the page
$stores = $mysqli->query("SELECT id, name, location, capacity, created_at FROM stores ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);

// Fetch general system settings for the header
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Store Management';
?>
