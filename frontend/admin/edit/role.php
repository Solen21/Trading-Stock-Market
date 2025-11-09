<?php
include_once __DIR__ . '/../../../backend/admin/edit/role.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0">
            <i class="fas fa-user-shield me-2 text-primary"></i>Edit Role
        </h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($role): ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($role['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"><?php echo htmlspecialchars($role['description']); ?></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Changes</button>
                <a href="../management/role" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Role not found or an error occurred.</div>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>
