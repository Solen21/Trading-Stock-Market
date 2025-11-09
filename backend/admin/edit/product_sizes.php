<?php
session_start();
$message = '';
$message_type = '';
$size = null;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Product Size ID is required.");
}
$size_id = $_GET['id'];

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

    if (empty($product_id)) {
        $message = "Product is a required field.";
        $message_type = 'danger';
    } else {
        $stmt = $mysqli->prepare("UPDATE product_sizes SET product_id = ?, height = ?, width = ?, thickness = ?, radius = ?, unit = ?, note = ? WHERE id = ?");
        $stmt->bind_param("iddddssi", $product_id, $height, $width, $thickness, $radius, $unit, $note, $size_id);
        
        if ($stmt->execute()) {
            $message = "Product size updated successfully!";
            $message_type = 'success';
        } else {
            $message = "Database error: " . $stmt->error;
            $message_type = 'danger';
        }
        $stmt->close();
    }
}

$stmt = $mysqli->prepare("SELECT * FROM product_sizes WHERE id = ?");
$stmt->bind_param("i", $size_id);
$stmt->execute();
$size = $stmt->get_result()->fetch_assoc();
$stmt->close();

$page_title = 'Edit Product Size';