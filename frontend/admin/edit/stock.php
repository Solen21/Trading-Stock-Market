<?php
include_once __DIR__ . '/../../../backend/admin/edit/stock.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-edit me-2 text-primary"></i>Edit Stock Item</h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($stock_item): ?>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Store</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($stock_item['store_name']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Product</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($stock_item['product_name']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                <input type="number" id="quantity" name="quantity" class="form-control" value="<?php echo htmlspecialchars($stock_item['quantity']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="broken" class="form-label">Broken Quantity</label>
                <input type="number" id="broken" name="broken" class="form-control" value="<?php echo htmlspecialchars($stock_item['broken']); ?>">
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Changes</button>
            <a href="../management/stock" class="btn btn-secondary">Cancel</a>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Stock item not found.</div>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>