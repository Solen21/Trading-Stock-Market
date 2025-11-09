<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

// Fetch products for the dropdown
$products = $mysqli->query("SELECT id, name FROM products ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = (int)$_POST['product_id'];
    $height = !empty($_POST['height']) ? (float)$_POST['height'] : null;
    $width = !empty($_POST['width']) ? (float)$_POST['width'] : null;
    $thickness = !empty($_POST['thickness']) ? (float)$_POST['thickness'] : null;
    $radius = !empty($_POST['radius']) ? (float)$_POST['radius'] : null;
    $unit = trim($_POST['unit']);
    $note = trim($_POST['note']);

    if (!empty($product_id)) {
        $stmt = $mysqli->prepare("INSERT INTO product_sizes (product_id, height, width, thickness, radius, unit, note) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iddddss", $product_id, $height, $width, $thickness, $radius, $unit, $note);
        
        if ($stmt->execute()) {
            $_SESSION['flash_message'] = "Product size created successfully.";
            $_SESSION['flash_message_type'] = 'success';
            header("Location: ../../../frontend/admin/management/product_sizes");
            exit();
        } else {
            $_SESSION['flash_message'] = "Database error: " . $stmt->error;
            $_SESSION['flash_message_type'] = 'danger';
        }
    } else {
        $_SESSION['flash_message'] = "Product is a required field.";
        $_SESSION['flash_message_type'] = 'danger';
    }
    header("Location: ../../../frontend/admin/add/product_sizes");
    exit();
}

$page_title = 'Add New Product Size';