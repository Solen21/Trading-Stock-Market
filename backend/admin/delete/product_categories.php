<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM product_categories WHERE id = ?");
    $stmt->bind_param("i", $category_id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = "Category deleted successfully.";
        $_SESSION['flash_message_type'] = 'success';
    } else {
        $_SESSION['flash_message'] = "Error deleting category. It might be associated with existing products.";
        $_SESSION['flash_message_type'] = 'danger';
    }
    $stmt->close();
}

header("Location: ../../../frontend/admin/management/product_categories");
exit();