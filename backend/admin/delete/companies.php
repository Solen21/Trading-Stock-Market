<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $company_id = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM companies WHERE id = ?");
    $stmt->bind_param("i", $company_id);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = "Company deleted successfully.";
        $_SESSION['flash_message_type'] = 'success';
    } else {
        $_SESSION['flash_message'] = "Error deleting company. It might be associated with other records.";
        $_SESSION['flash_message_type'] = 'danger';
    }
    $stmt->close();
}

header("Location: ../../../frontend/admin/management/companies");
exit();
?>

