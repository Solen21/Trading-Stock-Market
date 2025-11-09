<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch stores and products for dropdowns
$stores = $mysqli->query("SELECT id, name FROM stores ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);
$products = $mysqli->query("SELECT id, name FROM products ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $store_id = (int)$_POST['store_id'];
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $broken = (int)($_POST['broken'] ?? 0);

    if (!empty($store_id) && !empty($product_id)) {
        // Use INSERT...ON DUPLICATE KEY UPDATE to avoid errors and simplify logic
        $stmt = $mysqli->prepare(
            "INSERT INTO stock (store_id, product_id, quantity, broken) VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity), broken = broken + VALUES(broken)"
        );
        $stmt->bind_param("iiii", $store_id, $product_id, $quantity, $broken);
        
        if ($stmt->execute()) {
            $_SESSION['flash_message'] = "Stock updated successfully.";
            $_SESSION['flash_message_type'] = 'success';
            header("Location: ../../../frontend/admin/management/stock");
            exit();
        } else {
            $_SESSION['flash_message'] = "Database error: " . $stmt->error;
            $_SESSION['flash_message_type'] = 'danger';
        }
    }
}

$page_title = 'Add/Update Stock';
?>