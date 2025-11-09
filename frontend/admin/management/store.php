
<?php
include_once __DIR__ . '/../../../backend/admin/management/store.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">
            <i class="fas fa-store me-2 text-primary"></i>Store Management
        </h1>
        <a href="../add/store" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Store
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
                        <th>Store Name</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stores as $store): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($store['name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($store['location']); ?></td>
                        <td><?php echo htmlspecialchars($store['capacity']); ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($store['created_at'])); ?></td>
                        <td class="text-end">
                            <a href="../edit/store?id=<?php echo $store['id']; ?>" class="btn btn-sm btn-info" title="Edit Store"><i class="fas fa-pencil-alt"></i></a>
                            <a href="../delete/store?id=<?php echo $store['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this store?')" title="Delete Store"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>

