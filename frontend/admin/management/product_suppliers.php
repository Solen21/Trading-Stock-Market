<?php
include_once __DIR__ . '/../../../backend/admin/management/product_suppliers.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">
            <i class="fas fa-truck-field me-2 text-primary"></i>Product Supplier Management
        </h1>
        <a href="../add/product_suppliers" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Supplier
        </a>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['flash_message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['flash_message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['flash_message'], $_SESSION['flash_message_type']); ?>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Supplier Name</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Contact Info</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($suppliers as $supplier): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($supplier['name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($supplier['code']); ?></td>
                        <td><?php echo htmlspecialchars($supplier['type']); ?></td>
                        <td><?php echo htmlspecialchars($supplier['contact_info']); ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($supplier['created_at'])); ?></td>
                        <td class="text-end">
                            <a href="../edit/product_suppliers?id=<?php echo $supplier['id']; ?>" class="btn btn-sm btn-info" title="Edit Supplier"><i class="fas fa-pencil-alt"></i></a>
                            <a href="../delete/product_suppliers?id=<?php echo $supplier['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this supplier?')" title="Delete Supplier"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>