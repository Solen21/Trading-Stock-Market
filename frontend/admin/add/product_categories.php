<?php
include_once __DIR__ . '/../../../backend/admin/add/product_categories.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Add New Product Category</h1>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['flash_message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['flash_message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['flash_message'], $_SESSION['flash_message_type']); ?>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text" id="category_name" name="category_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Category</button>
            <a href="../management/product_categories" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>