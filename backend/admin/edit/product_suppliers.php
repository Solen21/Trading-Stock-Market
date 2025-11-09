<?php
session_start();
$message = '';
$message_type = '';
$supplier = null;

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Supplier ID is required.");
}
$supplier_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $code = trim($_POST['code']);
    $type = trim($_POST['type']);
    $contact_info = trim($_POST['contact_info']);

    if (empty($name) || empty($code)) {
        $message = "Supplier Name and Code are required.";
        $message_type = 'danger';
    } else {
        $stmt = $mysqli->prepare("UPDATE product_suppliers SET name = ?, code = ?, type = ?, contact_info = ? WHERE id = ?");
        try {
            $stmt->bind_param("ssssi", $name, $code, $type, $contact_info, $supplier_id);
            if ($stmt->execute()) {
                $message = "Supplier updated successfully!";
                $message_type = 'success';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $message = "A supplier with that code already exists.";
                $message_type = 'danger';
            } else {
                $message = "Database error: " . $e->getMessage();
                $message_type = 'danger';
            }
        }
        $stmt->close();
    }
}

// Fetch current supplier data to populate the form
$stmt = $mysqli->prepare("SELECT id, name, code, type, contact_info FROM product_suppliers WHERE id = ?");
$stmt->bind_param("i", $supplier_id);
$stmt->execute();
$result = $stmt->get_result();
$supplier = $result->fetch_assoc();
$stmt->close();

$page_title = 'Edit Product Supplier';