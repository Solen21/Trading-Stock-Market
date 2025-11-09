<?php
include_once __DIR__ . '/../../../backend/admin/add/products.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Add New Product</h1>
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
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select id="category_id" name="category_id" class="form-select">
                        <option value="">Select a category...</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['category_name']); ?></option>
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
                            <option value="<?php echo $sup['id']; ?>"><?php echo htmlspecialchars($sup['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="unit_id" class="form-label">Unit</label>
                    <select id="unit_id" name="unit_id" class="form-select">
                        <option value="">Select a unit...</option>
                        <?php foreach ($units as $unit): ?>
                            <option value="<?php echo $unit['id']; ?>"><?php echo htmlspecialchars($unit['unit_name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <hr>
            <h5 class="mb-3">Pricing & Cost</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="purchase_price" class="form-label">Purchase Price <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" id="purchase_price" name="purchase_price" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sell_price" class="form-label">Sell Price <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" id="sell_price" name="sell_price" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3"><label for="transport_fee" class="form-label">Transport Fee</label><input type="number" step="0.01" id="transport_fee" name="transport_fee" class="form-control"></div>
                <div class="col-md-3 mb-3"><label for="loading_fee" class="form-label">Loading Fee</label><input type="number" step="0.01" id="loading_fee" name="loading_fee" class="form-control"></div>
                <div class="col-md-3 mb-3"><label for="unloading_fee" class="form-label">Unloading Fee</label><input type="number" step="0.01" id="unloading_fee" name="unloading_fee" class="form-control"></div>
                <div class="col-md-3 mb-3"><label for="other_expenses" class="form-label">Other Expenses</label><input type="number" step="0.01" id="other_expenses" name="other_expenses" class="form-control"></div>
            </div>

            <hr>
            <h5 class="mb-3">Details</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="quantity_per_unit" class="form-label">Quantity per Unit</label>
                    <input type="number" step="0.01" id="quantity_per_unit" name="quantity_per_unit" class="form-control" value="1">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="size_details" class="form-label">Size Details (e.g., 60x60cm)</label>
                    <input type="text" id="size_details" name="size_details" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Unteach">Unteach</option>
                    </select>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Product</button>
                <a href="../management/products" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>

