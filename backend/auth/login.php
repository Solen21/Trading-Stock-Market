<?php
session_start();
$error_message = '';
$max_login_attempts = 5;
$lockout_time = 900; // 15 minutes in seconds

// Function to get client IP address
function get_client_ip() {
    return $_SERVER['REMOTE_ADDR'];
}

// If user is already logged in, redirect to the main page
if (isset($_SESSION['user_id'])) {
    header("Location: ../../frontend/admin/dashboard");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ip = get_client_ip();
    $_SESSION['login_attempts'][$ip] = $_SESSION['login_attempts'][$ip] ?? 0;

    if (isset($_SESSION['lockout_time'][$ip]) && $_SESSION['lockout_time'][$ip] > time()) {
        $remaining_time = $_SESSION['lockout_time'][$ip] - time();
        $error_message = "Too many failed login attempts. Please try again in " . ceil($remaining_time / 60) . " minutes.";
    } else {
        unset($_SESSION['lockout_time'][$ip]);
    }

    require_once __DIR__ . '/../../config/db_connect.php';

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error_message = "Username and password are required.";
    } elseif (!isset($error_message) || empty($error_message)) {
        // Prepare a statement to prevent SQL injection
        $stmt = $mysqli->prepare("SELECT u.id, u.username, u.password_hash, u.full_name, r.name as role_name 
                                  FROM users u 
                                  JOIN roles r ON u.role_id = r.id WHERE u.username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // Verify the password
            if (password_verify($password, $user['password_hash'])) {
                // Clear login attempts on success
                unset($_SESSION['login_attempts'][$ip]);
                unset($_SESSION['lockout_time'][$ip]);

                // Password is correct, start a new session
                session_regenerate_id(true); // Prevent session fixation
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role_name'];

                // Redirect to the dashboard
                header("Location: ../frontend/admin/dashboard");
                exit();
            }
        }

        // If we reach here, it's a failed login attempt.
        $_SESSION['login_attempts'][$ip]++;
        $error_message = "Invalid username or password.";

        if ($_SESSION['login_attempts'][$ip] >= $max_login_attempts) {
            $_SESSION['lockout_time'][$ip] = time() + $lockout_time;
            // Be more specific when a lockout occurs.
            $error_message = "Too many failed login attempts. You have been locked out for 15 minutes.";
        }
        $stmt->close();
    }
}

// If there's no active database connection, create one.
if (!isset($mysqli) || is_null($mysqli->thread_id)) {
    require_once __DIR__ . '/../../config/db_connect.php';
}

$settingsResult = $mysqli->query("SELECT setting_key, setting_value FROM general_settings");
$settings = [];
while ($row = $settingsResult->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$system_name = $settings['system_name'] ?? 'Product Management System';
?>