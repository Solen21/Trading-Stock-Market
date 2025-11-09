<?php
session_start();
$message = '';
$message_type = '';
$unit = null;

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Unit ID is required.");
}
$unit_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $unit_name = trim($_POST['unit_name']);
    $category = trim($_POST['category']);
    $base_value = (float)$_POST['base_value'];
    $description = trim($_POST['description']);

    if (empty($unit_name) || empty($category)) {
        $message = "Unit Name and Category are required.";
        $message_type = 'danger';
    } else {
        $stmt = $mysqli->prepare("UPDATE units SET unit_name = ?, category = ?, base_value = ?, description = ? WHERE id = ?");
        try {
            $stmt->bind_param("ssdsi", $unit_name, $category, $base_value, $description, $unit_id);
            if ($stmt->execute()) {
                $message = "Unit updated successfully!";
                $message_type = 'success';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $message = "A unit with that name already exists.";
                $message_type = 'danger';
            } else {
                $message = "Database error: " . $e->getMessage();
                $message_type = 'danger';
            }
        }
        $stmt->close();
    }
}

$stmt = $mysqli->prepare("SELECT id, unit_name, category, base_value, description FROM units WHERE id = ?");
$stmt->bind_param("i", $unit_id);
$stmt->execute();
$result = $stmt->get_result();
$unit = $result->fetch_assoc();
$stmt->close();

$page_title = 'Edit Unit';