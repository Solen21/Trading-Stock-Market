<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';
require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch all product categories
$categories = $mysqli->query("SELECT * FROM product_categories ORDER BY category_name ASC")->fetch_all(MYSQLI_ASSOC);

$page_title = 'Product Category Management';
?>