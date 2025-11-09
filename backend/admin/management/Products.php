<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';
require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch all products with their related names for the management page
$sql = "SELECT 
            p.id, 
            p.name, 
            pc.category_name, 
            ps.name as supplier_name, 
            p.total_cost, 
            p.sell_price, 
            u.unit_name,
            p.status
        FROM products p
        LEFT JOIN product_categories pc ON p.category_id = pc.id
        LEFT JOIN product_suppliers ps ON p.supplier_id = ps.id
        LEFT JOIN units u ON p.unit_id = u.id
        ORDER BY p.name ASC";

$products = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);

$page_title = 'Product Management';

