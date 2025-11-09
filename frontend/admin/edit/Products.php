<?php
include_once __DIR__ . '/../../../backend/admin/edit/products.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-box-open me-2 text-primary"></i>Edit Product</h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($product): ?>
        <form method="post" action="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select id="category_id" name="category_id" class="form-select">
                        <option value="">Select a category...</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo ($product['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['category_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="supplier_id" class="form-label">Supplier</label>
                    <select id="supplier_id" name="supplier_id" class="form-select">
                        <option value="">Select a supplier...</option>
                        <?php foreach ($suppliers as $sup): ?>
                            <option value="<?php echo $sup['id']; ?>" <?php echo ($product['supplier_id'] == $sup['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($sup['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="unit_id" class="form-label">Unit</label>
                    <select id="unit_id" name="unit_id" class="form-select">
                        <option value="">Select a unit...</option>
                        <?php foreach ($units as $unit): ?>
                            <option value="<?php echo $unit['id']; ?>" <?php echo ($product['unit_id'] == $unit['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($unit['unit_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <hr>
            <h5 class="mb-3">Pricing & Cost</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="purchase_price" class="form-label">Purchase Price <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" id="purchase_price" name="purchase_price" class="form-control" value="<?php echo htmlspecialchars($product['purchase_price']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sell_price" class="form-label">Sell Price <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" id="sell_price" name="sell_price" class="form-control" value="<?php echo htmlspecialchars($product['sell_price']); ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3"><label for="transport_fee" class="form-label">Transport Fee</label><input type="number" step="0.01" id="transport_fee" name="transport_fee" class="form-control" value="<?php echo htmlspecialchars($product['transport_fee']); ?>"></div>
                <div class="col-md-3 mb-3"><label for="loading_fee" class="form-label">Loading Fee</label><input type="number" step="0.01" id="loading_fee" name="loading_fee" class="form-control" value="<?php echo htmlspecialchars($product['loading_fee']); ?>"></div>
                <div class="col-md-3 mb-3"><label for="unloading_fee" class="form-label">Unloading Fee</label><input type="number" step="0.01" id="unloading_fee" name="unloading_fee" class="form-control" value="<?php echo htmlspecialchars($product['unloading_fee']); ?>"></div>
                <div class="col-md-3 mb-3"><label for="other_expenses" class="form-label">Other Expenses</label><input type="number" step="0.01" id="other_expenses" name="other_expenses" class="form-control" value="<?php echo htmlspecialchars($product['other_expenses']); ?>"></div>
            </div>

            <hr>
            <h5 class="mb-3">Details</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="quantity_per_unit" class="form-label">Quantity per Unit</label>
                    <input type="number" step="0.01" id="quantity_per_unit" name="quantity_per_unit" class="form-control" value="<?php echo htmlspecialchars($product['quantity_per_unit']); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="size_details" class="form-label">Size Details (e.g., 60x60cm)</label>
                    <input type="text" id="size_details" name="size_details" class="form-control" value="<?php echo htmlspecialchars($product['size_details']); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="Active" <?php echo ($product['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                        <option value="Inactive" <?php echo ($product['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                        <option value="Unteach" <?php echo ($product['status'] == 'Unteach') ? 'selected' : ''; ?>>Unteach</option>
                    </select>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Changes</button>
                <a href="../management/products" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Product not found or an error occurred.</div>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>

