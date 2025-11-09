<?php
include_once __DIR__ . '/../../../backend/admin/edit/product_categories.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-edit me-2 text-primary"></i>Edit Product Category</h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($category): ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo htmlspecialchars($category['category_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"><?php echo htmlspecialchars($category['description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Changes</button>
            <a href="../management/product_categories" class="btn btn-secondary">Cancel</a>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Category not found.</div>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>