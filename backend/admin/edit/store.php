<?php
session_start();
$message = '';
$message_type = '';
$store = null;

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Store ID is required.");
}
$store_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];

    if (empty($name)) {
        $message = "Store name cannot be empty.";
        $message_type = 'danger';
    } else {
        $stmt = $mysqli->prepare("UPDATE stores SET name = ?, location = ?, capacity = ? WHERE id = ?");
        $stmt->bind_param("ssii", $name, $location, $capacity, $store_id);

        if ($stmt->execute()) {
            $message = "Store updated successfully!";
            $message_type = 'success';
        } else {
            $message = "Error updating store: " . $stmt->error;
            $message_type = 'danger';
        }
        $stmt->close();
    }
}

// Fetch current store data to populate the form
$stmt = $mysqli->prepare("SELECT id, name, location, capacity FROM stores WHERE id = ?");
$stmt->bind_param("i", $store_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $store = $result->fetch_assoc();
} else {
    die("Error: Store not found.");
}
$stmt->close();
header("Location: ../../../frontend/admin/management/store");
include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Edit Store';
?>
