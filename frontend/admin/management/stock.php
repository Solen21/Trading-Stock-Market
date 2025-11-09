<?php
include_once __DIR__ . '/../../../backend/admin/management/stock.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">
            <i class="fas fa-warehouse me-2 text-primary"></i>Stock Management
        </h1>
        <a href="../add/stock.php" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add/Update Stock
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
                        <th>Store</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Broken</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stock_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['store_name']); ?></td>
                        <td><strong><?php echo htmlspecialchars($item['product_name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($item['broken']); ?></td>
                        <td class="text-end">
                            <a href="../edit/stock.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-info" title="Edit Stock"><i class="fas fa-pencil-alt"></i></a>
                            <a href="../delete/stock.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this stock entry? This is not recommended unless it was a mistake.')" title="Delete Stock Entry"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>