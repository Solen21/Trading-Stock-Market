<?php
session_start();
$message = '';
$message_type = '';
$stock_item = null;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Stock ID is required.");
}
$stock_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = (int)$_POST['quantity'];
    $broken = (int)$_POST['broken'];

    $stmt = $mysqli->prepare("UPDATE stock SET quantity = ?, broken = ? WHERE id = ?");
    $stmt->bind_param("iii", $quantity, $broken, $stock_id);
    
    if ($stmt->execute()) {
        $message = "Stock item updated successfully!";
        $message_type = 'success';
    } else {
        $message = "Database error: " . $stmt->error;
        $message_type = 'danger';
    }
    $stmt->close();
}

$sql = "SELECT s.id, s.quantity, s.broken, p.name as product_name, st.name as store_name 
        FROM stock s
        JOIN products p ON s.product_id = p.id
        JOIN stores st ON s.store_id = st.id
        WHERE s.id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $stock_id);
$stmt->execute();
$stock_item = $stmt->get_result()->fetch_assoc();
$stmt->close();

$page_title = 'Edit Stock Item';
?>