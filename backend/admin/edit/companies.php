<?php
session_start();
$message = '';
$message_type = '';
$company = null;

// If the user is not logged in, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
}

require_once __DIR__ . '/../../../config/db_connect.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Company ID is required.");
}
$company_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $contact_info = $_POST['contact_info'];

    if (empty($name) || empty($code)) {
        $message = "Company Name and Code are required.";
        $message_type = 'danger';
    } else {
        $stmt = $mysqli->prepare("UPDATE companies SET name = ?, code = ?, contact_info = ? WHERE id = ?");
        try {
            $stmt->bind_param("sssi", $name, $code, $contact_info, $company_id);
            if ($stmt->execute()) {
                $message = "Company updated successfully!";
                $message_type = 'success';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $message = "A company with that code already exists.";
                $message_type = 'danger';
            } else {
                $message = "Database error: " . $e->getMessage();
                $message_type = 'danger';
            }
        }
        $stmt->close();
    }
}

// Fetch current company data to populate the form
$stmt = $mysqli->prepare("SELECT id, name, code, contact_info FROM companies WHERE id = ?");
$stmt->bind_param("i", $company_id);
$stmt->execute();
$result = $stmt->get_result();
$company = $result->fetch_assoc();
if (!$company) {
    die("Error: Company not found.");
}
$stmt->close();

include_once __DIR__ . '/../../../helpers/system_settings.php';
$page_title = 'Edit Company';
?>

