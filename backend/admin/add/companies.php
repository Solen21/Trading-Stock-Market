<?php
session_start();

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $contact_info = $_POST['contact_info'];

    if (!empty($name) && !empty($code)) {
        $stmt = $mysqli->prepare("INSERT INTO companies (name, code, contact_info) VALUES (?, ?, ?)");
        try {
            $stmt->bind_param("sss", $name, $code, $contact_info);
            if ($stmt->execute()) {
                $_SESSION['flash_message'] = "Company '{$name}' created successfully.";
                $_SESSION['flash_message_type'] = 'success';
                header("Location: ../../../frontend/admin/management/companies");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) { // Duplicate entry
                $_SESSION['flash_message'] = "A company with the code '{$code}' already exists.";
                $_SESSION['flash_message_type'] = 'danger';
            } else {
                $_SESSION['flash_message'] = "Database error: " . $e->getMessage();
                $_SESSION['flash_message_type'] = 'danger';
            }
            header("Location: company"); // Redirect back to the add page
            exit();
        }
    } else {
        $_SESSION['flash_message'] = "Company Name and Code are required.";
        $_SESSION['flash_message_type'] = 'danger';
        header("Location: companies");
        exit();
    }
}

include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Add New Company';
?>

