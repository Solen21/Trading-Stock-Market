<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Add headers to prevent caching of authenticated pages.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// If the user is not logged in, or is not an admin, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../public/login");
    exit();
} elseif ($_SESSION['role'] !== 'Admin') {
    $_SESSION['flash_message'] = "You do not have permission to access this page. Please log in as an administrator.";
    $_SESSION['flash_message_type'] = 'danger';
    header("Location: /../../public/login");
    exit();
}