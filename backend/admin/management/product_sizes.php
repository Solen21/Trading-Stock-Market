<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';
require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch all product sizes with their related product names
$sql = "SELECT 
            ps.id,
            p.name as product_name,
            ps.height,
            ps.width,
            ps.thickness,
            ps.radius,
            ps.unit
        FROM product_sizes ps
        JOIN products p ON ps.product_id = p.id
        ORDER BY p.name ASC, ps.id ASC";

$product_sizes = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);

$page_title = 'Product Size Management';