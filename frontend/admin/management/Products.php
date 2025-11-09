<?php
include_once __DIR__ . '/../../../backend/admin/management/products.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">
            <i class="fas fa-box-open me-2 text-primary"></i>Product Management
        </h1>
        <a href="../add/products" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Product
        </a>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['flash_message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['flash_message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['flash_message'], $_SESSION['flash_message_type']); ?>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Total Cost</th>
                        <th>Sell Price</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr><td colspan="8" class="text-center">No products found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($product['name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($product['category_name'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($product['supplier_name'] ?? 'N/A'); ?></td>
                            <td><?php echo number_format($product['total_cost'], 2); ?></td>
                            <td><?php echo number_format($product['sell_price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($product['unit_name'] ?? 'N/A'); ?></td>
                            <td><span class="badge bg-<?php echo $product['status'] == 'Active' ? 'success' : 'secondary'; ?>"><?php echo htmlspecialchars($product['status']); ?></span></td>
                            <td class="text-end">
                                <a href="../edit/products?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-info" title="Edit Product"><i class="fas fa-pencil-alt"></i></a>
                                <a href="../delete/products?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')" title="Delete Product"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>

