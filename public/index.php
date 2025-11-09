<?php
session_start();
include_once __DIR__ . '/../include/header.php';
?>
<body>
    <div class="container">
        <h1>Welcome to the Product Management System</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            <p><a href="../frontend/admin/dashboard.php" class="button">Go to Dashboard</a></p>
            <p><a href="../backend/auth/logout.php" class="button">Logout</a></p>
            <?php else: ?>
            <p>Please log in to manage your products.</p>
            <p><a href="login.php" class="button">Go to Login Page</a></p>
            <?php endif; ?>
    </div>
</body>
</html>