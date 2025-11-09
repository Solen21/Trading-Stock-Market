<?php
include_once __DIR__ . '/../../../backend/admin/add/units.php';
include_once __DIR__ . '/../../../include/header.php';
$categories = ['count', 'weight', 'volume', 'length', 'area', 'custom'];
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Add New Unit</h1>
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
                <label for="unit_name" class="form-label">Unit Name <span class="text-danger">*</span></label>
                <input type="text" id="unit_name" name="unit_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                <select id="category" name="category" class="form-select" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat; ?>"><?php echo ucfirst($cat); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="base_value" class="form-label">Base Value</label>
                <input type="number" step="0.0001" id="base_value" name="base_value" class="form-control" value="1">
                <small class="form-text text-muted">Relative value to the base unit of the category (e.g., for 'gram', if 'kg' is base, value is 0.001).</small>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Unit</button>
                <a href="../management/units" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>