<?php
include_once __DIR__ . '/../../../backend/admin/add/product_sizes.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Add New Product Size</h1>
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
                <label for="product_id" class="form-label">Product <span class="text-danger">*</span></label>
                <select id="product_id" name="product_id" class="form-select" required>
                    <option value="">Select a product...</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="height" class="form-label">Height</label>
                    <input type="number" step="0.01" id="height" name="height" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="width" class="form-label">Width</label>
                    <input type="number" step="0.01" id="width" name="width" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="thickness" class="form-label">Thickness</label>
                    <input type="number" step="0.01" id="thickness" name="thickness" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="radius" class="form-label">Radius</label>
                    <input type="number" step="0.01" id="radius" name="radius" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <input type="text" id="unit" name="unit" class="form-control" value="cm">
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <textarea id="note" name="note" class="form-control" rows="3"></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Size</button>
                <a href="../management/product_sizes" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>