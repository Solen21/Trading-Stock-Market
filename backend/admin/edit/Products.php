<?php
session_start();
$message = '';
$message_type = '';
$product = null;

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Product ID is required.");
}
$product_id = $_GET['id'];

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
        $message = "Product Name, Purchase Price, and Sell Price are required.";
        $message_type = 'danger';
    } else {
        $stmt = $mysqli->prepare(
            "UPDATE products SET 
            name = ?, category_id = ?, supplier_id = ?, purchase_price = ?, transport_fee = ?, loading_fee = ?, 
            unloading_fee = ?, other_expenses = ?, sell_price = ?, unit_id = ?, quantity_per_unit = ?, 
            size_details = ?, status = ? 
            WHERE id = ?"
        );
        try {
            $stmt->bind_param("siiddddddidsdsi", $name, $category_id, $supplier_id, $purchase_price, $transport_fee, $loading_fee, $unloading_fee, $other_expenses, $sell_price, $unit_id, $quantity_per_unit, $size_details, $status, $product_id);
            if ($stmt->execute()) {
                $message = "Product updated successfully!";
                $message_type = 'success';
            }
        } catch (mysqli_sql_exception $e) {
            $message = "Database error: " . $e->getMessage();
            $message_type = 'danger';
        }
        $stmt->close();
    }
}

// Fetch current product data to populate the form
$stmt = $mysqli->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

$page_title = 'Edit Product';

