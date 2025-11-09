<?php
include_once __DIR__ . '/../../../backend/admin/add/stock.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Add or Update Stock</h1>
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
                <label for="store_id" class="form-label">Store <span class="text-danger">*</span></label>
                <select id="store_id" name="store_id" class="form-select" required>
                    <option value="">Select a store...</option>
                    <?php foreach ($stores as $store): ?>
                        <option value="<?php echo $store['id']; ?>"><?php echo htmlspecialchars($store['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="product_id" class="form-label">Product <span class="text-danger">*</span></label>
                <select id="product_id" name="product_id" class="form-select" required>
                    <option value="">Select a product...</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product['id']; ?>"><?php echo htmlspecialchars($product['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity to Add <span class="text-danger">*</span></label>
                <input type="number" id="quantity" name="quantity" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Stock</button>
            <a href="../management/stock" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>