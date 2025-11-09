<?php
include_once __DIR__ . '/../../../backend/admin/edit/store.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-store-alt me-2 text-primary"></i>Edit Store</h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($store): ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Store Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($store['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($store['location']); ?>">
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" id="capacity" name="capacity" class="form-control" value="<?php echo htmlspecialchars($store['capacity']); ?>">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Changes</button>
                <a href="../management/store" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Store not found or an error occurred.</div>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>

