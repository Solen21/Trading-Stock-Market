<?php
session_start();

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $code = trim($_POST['code']);
    $type = trim($_POST['type']);
    $contact_info = trim($_POST['contact_info']);

    if (!empty($name) && !empty($code)) {
        $stmt = $mysqli->prepare("INSERT INTO product_suppliers (name, code, type, contact_info) VALUES (?, ?, ?, ?)");
        try {
            $stmt->bind_param("ssss", $name, $code, $type, $contact_info);
            if ($stmt->execute()) {
                $_SESSION['flash_message'] = "Supplier '{$name}' created successfully.";
                $_SESSION['flash_message_type'] = 'success';
                header("Location: ../../../frontend/admin/management/product_suppliers");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            // Handle potential duplicate entry for the unique 'code'
            if ($e->getCode() == 1062) { 
                $_SESSION['flash_message'] = "A supplier with the code '{$code}' already exists.";
            } else {
                $_SESSION['flash_message'] = "Database error: " . $e->getMessage();
            }
            $_SESSION['flash_message_type'] = 'danger';
            header("Location: ../../../frontend/admin/add/product_suppliers"); // Redirect back to the add page
            exit();
        }
    } else {
        $_SESSION['flash_message'] = "Supplier Name and Code are required.";
        $_SESSION['flash_message_type'] = 'danger';
        header("Location: ../../../frontend/admin/add/product_suppliers");
        exit();
    }
}

$page_title = 'Add New Product Supplier';