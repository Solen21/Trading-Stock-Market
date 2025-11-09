<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $store_id = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM stores WHERE id = ?");
    $stmt->bind_param("i", $store_id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = "Store deleted successfully.";
        $_SESSION['flash_message_type'] = 'success';
    } else {
        $_SESSION['flash_message'] = "Error deleting store. It might be in use.";
        $_SESSION['flash_message_type'] = 'danger';
    }
    $stmt->close();
}

header("Location: ../../../frontend/admin/management/store");
exit();
?>
