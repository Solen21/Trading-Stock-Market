<?php
session_start();
$message = '';
$message_type = '';
$category = null;

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Category ID is required.");
}
$category_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = trim($_POST['category_name']);
    $description = trim($_POST['description']);

    if (empty($category_name)) {
        $message = "Category Name is required.";
        $message_type = 'danger';
    } else {
        $stmt = $mysqli->prepare("UPDATE product_categories SET category_name = ?, description = ? WHERE id = ?");
        try {
            $stmt->bind_param("ssi", $category_name, $description, $category_id);
            if ($stmt->execute()) {
                $message = "Category updated successfully!";
                $message_type = 'success';
            }
        } catch (mysqli_sql_exception $e) {
            $message = "Database error: A category with that name might already exist.";
            $message_type = 'danger';
        }
        $stmt->close();
    }
}

// Fetch current category data
$stmt = $mysqli->prepare("SELECT * FROM product_categories WHERE id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();
$category = $result->fetch_assoc();
$stmt->close();

$page_title = 'Edit Product Category';
?>