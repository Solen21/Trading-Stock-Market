<?php
require_once __DIR__ . '/../../../helpers/auth_admin_check.php';
$message = '';

require_once __DIR__ . '/../../../config/db_connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update System Name
    if (isset($_POST['system_name'])) {
        $system_name = $_POST['system_name'];
        $stmt = $mysqli->prepare("INSERT INTO general_settings (setting_key, setting_value) VALUES ('system_name', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
        $stmt->bind_param("ss", $system_name, $system_name);
        $stmt->execute();
        $message .= "System name updated successfully.<br>";
    }

    // Update Primary Color
    if (isset($_POST['primary_color'])) {
        $primary_color = $_POST['primary_color'];
        $stmt = $mysqli->prepare("INSERT INTO general_settings (setting_key, setting_value) VALUES ('primary_color', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
        $stmt->bind_param("ss", $primary_color, $primary_color);
        $stmt->execute();
        $message .= "Primary color updated successfully.<br>";
    }

    // Update Sidebar Color
    if (isset($_POST['sidebar_color'])) {
        $sidebar_color = $_POST['sidebar_color'];
        $stmt = $mysqli->prepare("INSERT INTO general_settings (setting_key, setting_value) VALUES ('sidebar_color', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
        $stmt->bind_param("ss", $sidebar_color, $sidebar_color);
        $stmt->execute();
        $message .= "Sidebar color updated successfully.<br>";
    }

    // Update Navbar Color
    if (isset($_POST['navbar_color'])) {
        $navbar_color = $_POST['navbar_color'];
        $stmt = $mysqli->prepare("INSERT INTO general_settings (setting_key, setting_value) VALUES ('navbar_color', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
        $stmt->bind_param("ss", $navbar_color, $navbar_color);
        $stmt->execute();
        $message .= "Navbar color updated successfully.<br>";
    }

    // Update System Font
    if (isset($_POST['system_font'])) {
        $system_font = $_POST['system_font'];
        $stmt = $mysqli->prepare("INSERT INTO general_settings (setting_key, setting_value) VALUES ('system_font', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
        $stmt->bind_param("ss", $system_font, $system_font);
        $stmt->execute();
        $message .= "System font updated successfully.<br>";
    }

    // Handle Logo Upload
    if (isset($_FILES['system_logo']) && $_FILES['system_logo']['error'] == 0) {
        $upload_dir = __DIR__ . '/../../../public/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_name = 'logo_' . time() . '_' . basename($_FILES["system_logo"]["name"]);
        $target_file = $upload_dir . $file_name;
        
        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            if (move_uploaded_file($_FILES["system_logo"]["tmp_name"], $target_file)) {
                $logo_path = 'uploads/' . $file_name; // Relative path to store in DB
                $stmt = $mysqli->prepare("INSERT INTO general_settings (setting_key, setting_value) VALUES ('system_logo', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
                $stmt->bind_param("ss", $logo_path, $logo_path);
                $stmt->execute();
                $message .= "Logo uploaded successfully.";
            } else {
                $message .= "Sorry, there was an error uploading your file.";
            }
        }
    }
}

// Fetch current settings to display in the form
$settings = [];
$result = $mysqli->query("SELECT setting_key, setting_value FROM general_settings WHERE setting_key IN ('system_name', 'system_logo', 'primary_color', 'sidebar_color', 'navbar_color', 'system_font')");
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$current_name = $settings['system_name'] ?? 'Product Management System';
$current_logo = $settings['system_logo'] ?? '';
$current_color = $settings['primary_color'] ?? '#007bff'; // Default to Bootstrap blue
$current_sidebar_color = $settings['sidebar_color'] ?? '#343a40'; // Default dark grey
$current_navbar_color = $settings['navbar_color'] ?? '#f8f9fa'; // Default light grey
$current_font = $settings['system_font'] ?? 'Poppins'; // Default Font
$page_title = 'System Configuration'; // Define the page title
include_once __DIR__ . '/../../../include/header.php';
?>