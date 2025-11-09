<?php
include_once __DIR__ . '/../../../backend/admin/edit/units.php';
include_once __DIR__ . '/../../../include/header.php';
$categories = ['count', 'weight', 'volume', 'length', 'area', 'custom'];
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-balance-scale me-2 text-primary"></i>Edit Unit</h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($unit): ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="unit_name" class="form-label">Unit Name <span class="text-danger">*</span></label>
                <input type="text" id="unit_name" name="unit_name" class="form-control" value="<?php echo htmlspecialchars($unit['unit_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                <select id="category" name="category" class="form-select" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat; ?>" <?php echo ($unit['category'] == $cat) ? 'selected' : ''; ?>>
                            <?php echo ucfirst($cat); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="base_value" class="form-label">Base Value</label>
                <input type="number" step="0.0001" id="base_value" name="base_value" class="form-control" value="<?php echo htmlspecialchars($unit['base_value']); ?>">
                <small class="form-text text-muted">Relative value to the base unit of the category.</small>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"><?php echo htmlspecialchars($unit['description']); ?></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Changes</button>
                <a href="../management/units" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Unit not found or an error occurred.</div>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>