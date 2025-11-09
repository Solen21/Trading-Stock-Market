<?php
include_once __DIR__ . '/../../backend/admin/dashboard.php';
include_once __DIR__ . '/../../include/header.php';
?>

<canvas id="motion-canvas"></canvas>

<h1 class="h2">Dashboard Overview</h1>
<p>This is your main dashboard. You can manage users, products, and settings from here.</p>

<div class="row mt-4 text-center g-4">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                <h5 class="card-title">User Management</h5>
                <p class="card-text">Add, edit, and manage system users.</p>
                <a href="<?php echo $base_path; ?>frontend/admin/management/user" class="btn btn-outline-primary">Go to Users</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <i class="fas fa-user-shield fa-3x mb-3 text-primary"></i>
                <h5 class="card-title">Role Management</h5>
                <p class="card-text">Add, edit, and manage user roles and permissions.</p>
                <a href="<?php echo $base_path; ?>frontend/admin/management/role" class="btn btn-outline-primary">Go to Roles</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <i class="fas fa-store-alt fa-3x mb-3 text-primary"></i>
                <h5 class="card-title">Store Management</h5>
                <p class="card-text">Manage your store locations and their details.</p>
                <a href="<?php echo $base_path; ?>frontend/admin/management/store" class="btn btn-outline-primary">Go to Stores</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <i class="fas fa-building fa-3x mb-3 text-primary"></i>
                <h5 class="card-title">Companies Management</h5>
                <p class="card-text">Add, edit, and manage companies profiles.</p>
                <a href="<?php echo $base_path; ?>frontend/admin/management/companies" class="btn btn-outline-primary">Go to Companies</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <i class="fas fa-truck-field fa-3x mb-3 text-primary"></i>
                <h5 class="card-title">Product Suppliers</h5>
                <p class="card-text">Manage all product suppliers and their details.</p>
                <a href="<?php echo $base_path; ?>frontend/admin/management/product_suppliers" class="btn btn-outline-primary">Go to Suppliers</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <i class="fas fa-balance-scale fa-3x mb-3 text-primary"></i>
                <h5 class="card-title">Units Management</h5>
                <p class="card-text">Manage measurement units for products.</p>
                <a href="<?php echo $base_path; ?>frontend/admin/management/units" class="btn btn-outline-primary">Go to Units</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <i class="fas fa-box-open fa-3x mb-3 text-primary"></i>
                <h5 class="card-title">Product Management</h5>
                <p class="card-text">Manage all products, pricing, and details.</p>
                <a href="<?php echo $base_path; ?>frontend/admin/management/products" class="btn btn-outline-primary">Go to Products</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <i class="fas fa-cogs fa-3x mb-3 text-info"></i>
                <h5 class="card-title">System Configuration</h5>
                <p class="card-text">Update system name, logo, and other settings.</p> 
                <a href="<?php echo $base_path; ?>frontend/admin/setting/config" class="btn btn-outline-info">Go to Settings</a>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../../include/footer.php';
?>
