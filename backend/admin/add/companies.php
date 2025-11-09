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
    $contact_person = trim($_POST['contact_person']) ?: null;
    $country = trim($_POST['country']) ?: null;
    $email = trim($_POST['email']) ?: null;
    $phone = trim($_POST['phone']) ?: null;
    $address = trim($_POST['address']) ?: null;
    $info = trim($_POST['info']) ?: null;

    if (!empty($name)) {
        $stmt = $mysqli->prepare("INSERT INTO companies (name, contact_person, country, email, phone, address, info) VALUES (?, ?, ?, ?, ?, ?, ?)");
        try {
            $stmt->bind_param("sssssss", $name, $contact_person, $country, $email, $phone, $address, $info);
            if ($stmt->execute()) {
                $_SESSION['flash_message'] = "Company '{$name}' created successfully.";
                $_SESSION['flash_message_type'] = 'success';
                header("Location: ../../../frontend/admin/management/companies");
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            // Since there's no unique constraint besides ID, a duplicate error is unlikely unless you add one.
            $_SESSION['flash_message'] = "Database error: " . $e->getMessage();
            $_SESSION['flash_message_type'] = 'danger';
            header("Location: ../../../frontend/admin/add/companies"); // Redirect back to the add page
            exit();
        }
    } else {
        $_SESSION['flash_message'] = "Company Name is a required field.";
        $_SESSION['flash_message_type'] = 'danger';
        header("Location: ../../../frontend/admin/add/companies");
        exit();
    }
}

include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Add New Company';
?>
