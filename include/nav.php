<div class="wrapper">
    <?php
    // Get the current page filename to set the active link
    $currentPage = basename($_SERVER['PHP_SELF']);
    $userManagementPages = ['user.php', 'add_user.php', 'edit_user.php', 'reset_password.php'];
    $roleManagementPages = ['role.php', 'add_role.php', 'edit_role.php'];
    $storeManagementPages = ['store.php', 'add_store.php', 'edit_store.php'];
    $companyManagementPages = ['company.php', 'add_company.php', 'edit_company.php'];
    $productSupplierPages = ['product_suppliers.php', 'add_product_suppliers.php', 'edit_product_suppliers.php'];
    $unitPages = ['units.php', 'add_units.php', 'edit_units.php'];
    $productPages = ['products.php', 'add_products.php', 'edit_products.php'];
    ?>
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center justify-content-center">
            <a href="<?php echo $base_path; ?>frontend/admin/dashboard" class="d-flex align-items-center text-white text-decoration-none">
                <?php if (!empty($system_logo)): ?>
                    <img src="<?php echo $base_path; ?>public/<?php echo htmlspecialchars($system_logo); ?>" alt="Logo" class="sidebar-logo me-2">
                <?php endif; ?>
                <span class="fs-5"><?php echo $system_name; ?></span>
            </a>
        </div>
        <ul class="list-unstyled components">
            <li class="<?php echo ($currentPage == 'dashboard.php') ? 'active' : ''; ?>"><a href="<?php echo $base_path; ?>frontend/admin/dashboard"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
            <li class="<?php echo in_array($currentPage, $userManagementPages) ? 'active' : ''; ?>"><a href="<?php echo $base_path; ?>frontend/admin/management/user"><i class="fas fa-users-cog me-2"></i>User Management</a></li>
            <li class="<?php echo in_array($currentPage, $roleManagementPages) ? 'active' : ''; ?>"><a href="<?php echo $base_path; ?>frontend/admin/management/role"><i class="fas fa-user-shield me-2"></i>Role Management</a></li>
            <li class="<?php echo in_array($currentPage, $storeManagementPages) ? 'active' : ''; ?>"><a href="<?php echo $base_path; ?>frontend/admin/management/store"><i class="fas fa-store-alt me-2"></i>Store Management</a></li>
            <li class="<?php echo in_array($currentPage, $companyManagementPages) ? 'active' : ''; ?>"><a href="<?php echo $base_path; ?>frontend/admin/management/companies"><i class="fas fa-building me-2"></i>Company Management</a></li>
            <li class="<?php echo in_array($currentPage, $productSupplierPages) ? 'active' : ''; ?>"><a href="<?php echo $base_path; ?>frontend/admin/management/product_suppliers"><i class="fas fa-truck-field me-2"></i>Product Suppliers</a></li>
            <li class="<?php echo in_array($currentPage, $unitPages) ? 'active' : ''; ?>"><a href="<?php echo $base_path; ?>frontend/admin/management/units"><i class="fas fa-balance-scale me-2"></i>Units</a></li>
            <li class="<?php echo in_array($currentPage, $productPages) ? 'active' : ''; ?>"><a href="<?php echo $base_path; ?>frontend/admin/management/products"><i class="fas fa-box-open me-2"></i>Product Management</a></li>
            <li class="<?php echo ($currentPage == 'config.php') ? 'active' : ''; ?>"><a href="<?php echo $base_path; ?>frontend/admin/setting/config"><i class="fas fa-cogs me-2"></i>Settings</a></li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info d-md-none">
                    <i id="sidebarIcon" class="fas fa-bars"></i>
                </button>
                <span class="navbar-brand mb-0 h1 ms-md-3 d-none d-md-block">Hello, <?php echo htmlspecialchars($_SESSION['full_name']); ?>!</span>
                <div class="ms-auto d-flex align-items-center">
                    <button id="darkModeToggle" class="btn btn-outline-secondary me-2" title="Toggle Dark Mode">
                        <i id="darkModeIcon" class="fas fa-moon"></i>
                    </button>
                    <a href="<?php echo $base_path; ?>frontend/admin/dashboard" class="btn btn-outline-primary me-2"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="<?php echo $base_path; ?>backend/auth/logout" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
        </nav>
        <div class="main-content p-4">