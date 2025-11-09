<?php
session_start();

// If the user is not logged in, redirect to the login page. 
if (!isset($_SESSION['user_id'])) {
    header("Location: /../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];

    if (!empty($name)) {
        $stmt = $mysqli->prepare("INSERT INTO stores (name, location, capacity) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $location, $capacity);

        if ($stmt->execute()) {
            $_SESSION['flash_message'] = "Store '{$name}' created successfully.";
            $_SESSION['flash_message_type'] = 'success';
            header("Location: ../../../frontend/admin/management/store");
            exit();
        } else {
            $_SESSION['flash_message'] = "Error creating store: " . $stmt->error;
            $_SESSION['flash_message_type'] = 'danger';
        }
        $stmt->close();
    } else {
        $_SESSION['flash_message'] = "Store name cannot be empty.";
        $_SESSION['flash_message_type'] = 'danger';
    }
    header("Location: store");
    exit();
}

include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Add New Store';
?>
