<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';
require_once __DIR__ . '/../../../config/db_connect.php';

$sql = "SELECT 
            s.id, 
            st.name as store_name, 
            p.name as product_name, 
            s.quantity, 
            s.broken 
        FROM stock s
        JOIN stores st ON s.store_id = st.id
        JOIN products p ON s.product_id = p.id
        ORDER BY st.name ASC, p.name ASC";

$stock_items = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
$page_title = 'Stock Management';
?>