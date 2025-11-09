<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $size_id = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM product_sizes WHERE id = ?");
    $stmt->bind_param("i", $size_id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = "Product size deleted successfully.";
        $_SESSION['flash_message_type'] = 'success';
    } else {
        $_SESSION['flash_message'] = "Error deleting product size.";
        $_SESSION['flash_message_type'] = 'danger';
    }
    $stmt->close();
}

header("Location: ../../../frontend/admin/management/product_sizes");
exit();