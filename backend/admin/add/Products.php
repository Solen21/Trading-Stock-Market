<?php
session_start();

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}
require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch related data for dropdowns
$categories = $mysqli->query("SELECT id, category_name FROM product_categories ORDER BY category_name ASC")->fetch_all(MYSQLI_ASSOC);
$suppliers = $mysqli->query("SELECT id, name FROM product_suppliers ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);
$units = $mysqli->query("SELECT id, unit_name FROM units ORDER BY unit_name ASC")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve POST data
    $name = trim($_POST['name']);
    $category_id = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;
    $supplier_id = !empty($_POST['supplier_id']) ? (int)$_POST['supplier_id'] : null;
    $purchase_price = (float)$_POST['purchase_price'];
    $transport_fee = (float)($_POST['transport_fee'] ?? 0);
    $loading_fee = (float)($_POST['loading_fee'] ?? 0);
    $unloading_fee = (float)($_POST['unloading_fee'] ?? 0);
    $other_expenses = (float)($_POST['other_expenses'] ?? 0);
    $sell_price = (float)$_POST['sell_price'];
    $unit_id = !empty($_POST['unit_id']) ? (int)$_POST['unit_id'] : null;
    $quantity_per_unit = (float)($_POST['quantity_per_unit'] ?? 1);
    $size_details = trim($_POST['size_details']);
    $status = trim($_POST['status']);

    if (empty($name) || empty($purchase_price) || empty($sell_price)) {
        $_SESSION['flash_message'] = "Product Name, Purchase Price, and Sell Price are required.";
        $_SESSION['flash_message_type'] = 'danger';
        header("Location: ../../../frontend/admin/add/products");
        exit();
    } else {
        $stmt = $mysqli->prepare(
            "INSERT INTO products (name, category_id, supplier_id, purchase_price, transport_fee, loading_fee, unloading_fee, other_expenses, sell_price, unit_id, quantity_per_unit, size_details, status) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        try {
            $stmt->bind_param("siidddddidsss", $name, $category_id, $supplier_id, $purchase_price, $transport_fee, $loading_fee, $unloading_fee, $other_expenses, $sell_price, $unit_id, $quantity_per_unit, $size_details, $status);
            if ($stmt->execute()) {
                $_SESSION['flash_message'] = "Product '{$name}' created successfully.";
                $_SESSION['flash_message_type'] = 'success';
                header("Location: ../../../frontend/admin/management/products");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            $_SESSION['flash_message'] = "Database error: " . $e->getMessage();
            $_SESSION['flash_message_type'] = 'danger';
            header("Location: ../../../frontend/admin/add/products");
            exit();
        }
    }
}

$page_title = 'Add New Product';
