<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = trim($_POST['category_name']);
    $description = trim($_POST['description']);

    if (!empty($category_name)) {
        $stmt = $mysqli->prepare("INSERT INTO product_categories (category_name, description) VALUES (?, ?)");
        try {
            $stmt->bind_param("ss", $category_name, $description);
            if ($stmt->execute()) {
                $_SESSION['flash_message'] = "Category '{$category_name}' created successfully.";
                $_SESSION['flash_message_type'] = 'success';
                header("Location: ../../../frontend/admin/management/product_categories.php");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            $_SESSION['flash_message'] = "Database error: A category with that name might already exist.";
            $_SESSION['flash_message_type'] = 'danger';
            header("Location: ../../../frontend/admin/add/product_categories.php");
            exit();
        }
    }
}

$page_title = 'Add New Product Category';
?>