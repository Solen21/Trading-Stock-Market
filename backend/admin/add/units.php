<?php
session_start();

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $unit_name = trim($_POST['unit_name']);
    $category = trim($_POST['category']);
    $base_value = (float)$_POST['base_value'];
    $description = trim($_POST['description']);

    if (!empty($unit_name) && !empty($category)) {
        $stmt = $mysqli->prepare("INSERT INTO units (unit_name, category, base_value, description) VALUES (?, ?, ?, ?)");
        try {
            $stmt->bind_param("ssds", $unit_name, $category, $base_value, $description);
            if ($stmt->execute()) {
                $_SESSION['flash_message'] = "Unit '{$unit_name}' created successfully.";
                $_SESSION['flash_message_type'] = 'success';
                header("Location: ../../../frontend/admin/management/units");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) { 
                $_SESSION['flash_message'] = "A unit with the name '{$unit_name}' already exists.";
            } else {
                $_SESSION['flash_message'] = "Database error: " . $e->getMessage();
            }
            $_SESSION['flash_message_type'] = 'danger';
            header("Location: ../../../frontend/admin/add/units");
            exit();
        }
    } else {
        $_SESSION['flash_message'] = "Unit Name and Category are required.";
        $_SESSION['flash_message_type'] = 'danger';
        header("Location: ../../../frontend/admin/add/units");
        exit();
    }
}

$page_title = 'Add New Unit';