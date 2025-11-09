<?php

// Include the configuration file created by the installer
require_once __DIR__ . '/database.php';

// Create connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($mysqli->connect_error) {
    // In a production environment, you should log this error and show a generic message.
    die("Database connection failed: " . $mysqli->connect_error);
}

// Set the character set to prevent SQL injection issues with certain character sets
$mysqli->set_charset('utf8mb4');