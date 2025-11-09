<div class="wrapper">
    <?php
    // Get the current page filename to set the active link
    $currentPage = basename($_SERVER['PHP_SELF']);
    $userPages = ['user.php', 'add_user.php', 'edit_user.php'];
    ?>
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center justify-content-center">
            <a href="<?php echo $base_url; ?>frontend/admin/dashboard" class="d-flex align-items-center text-white text-decoration-none">
                <?php if (!empty($system_logo)): ?>
                    <img src="<?php echo $base_url; ?>public/<?php echo htmlspecialchars($system_logo); ?>" alt="Logo" class="sidebar-logo me-2">
                <?php endif; ?>
                <span class="fs-5"><?php echo $system_name; ?></span>
            </a>
        </div>
        <ul class="list-unstyled components">
            <li class="<?php echo ($currentPage == 'dashboard.php') ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>frontend/admin/dashboard"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
            <li class="<?php echo in_array($currentPage, $userPages) ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>frontend/admin/management/user"><i class="fas fa-users-cog me-2"></i>User Management</a></li>
            <li><a href="#"><i class="fas fa-box-open me-2"></i>Product Management</a></li>
            <li class="<?php echo ($currentPage == 'system_config.php') ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>frontend/admin/system_config"><i class="fas fa-cogs me-2"></i>Settings</a></li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info d-md-none">
                    <i class="fas fa-align-left"></i>
                </button>
                <span class="navbar-brand mb-0 h1 ms-md-3 d-none d-md-block">Hello, <?php echo htmlspecialchars($_SESSION['full_name']); ?>!</span>
                <div class="ms-auto d-flex align-items-center">
                    <button id="darkModeToggle" class="btn btn-outline-secondary me-2" title="Toggle Dark Mode">
                        <i id="darkModeIcon" class="fas fa-moon"></i>
                    </button>
                    <a href="<?php echo $base_url; ?>backend/auth/logout" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
        </nav>
        <div class="main-content p-4">