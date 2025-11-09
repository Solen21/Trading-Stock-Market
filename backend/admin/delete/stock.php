<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $stock_id = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM stock WHERE id = ?");
    $stmt->bind_param("i", $stock_id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = "Stock entry deleted successfully.";
        $_SESSION['flash_message_type'] = 'success';
    } 
    $stmt->close();
}

header("Location: ../../../frontend/admin/management/stock");
exit();