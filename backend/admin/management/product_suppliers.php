<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';
require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch all product suppliers to display on the page
$suppliers = $mysqli->query("SELECT id, name, code, type, contact_info, created_at FROM product_suppliers ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);

// Fetch general system settings for the header
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Product Supplier Management';
?>