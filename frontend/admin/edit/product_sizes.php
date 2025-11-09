<?php
include_once __DIR__ . '/../../../backend/admin/edit/product_sizes.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-ruler-combined me-2 text-primary"></i>Edit Product Size</h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($size): ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="product_id" class="form-label">Product <span class="text-danger">*</span></label>
                <select id="product_id" name="product_id" class="form-select" required>
                    <option value="">Select a product...</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product['id']; ?>" <?php echo ($size['product_id'] == $product['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($product['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="height" class="form-label">Height</label>
                    <input type="number" step="0.01" id="height" name="height" class="form-control" value="<?php echo htmlspecialchars($size['height'] ?? ''); ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="width" class="form-label">Width</label>
                    <input type="number" step="0.01" id="width" name="width" class="form-control" value="<?php echo htmlspecialchars($size['width'] ?? ''); ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="thickness" class="form-label">Thickness</label>
                    <input type="number" step="0.01" id="thickness" name="thickness" class="form-control" value="<?php echo htmlspecialchars($size['thickness'] ?? ''); ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="radius" class="form-label">Radius</label>
                    <input type="number" step="0.01" id="radius" name="radius" class="form-control" value="<?php echo htmlspecialchars($size['radius'] ?? ''); ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <input type="text" id="unit" name="unit" class="form-control" value="<?php echo htmlspecialchars($size['unit'] ?? 'cm'); ?>">
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <textarea id="note" name="note" class="form-control" rows="3"><?php echo htmlspecialchars($size['note'] ?? ''); ?></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Changes</button>
                <a href="../management/product_sizes" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Product size not found or an error occurred.</div>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>