<?php
include_once __DIR__ . '/../../../backend/admin/management/product_sizes.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">
            <i class="fas fa-ruler-combined me-2 text-primary"></i>Product Size Management
        </h1>
        <a href="../add/product_sizes" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Product Size
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
                        <th>Height</th>
                        <th>Width</th>
                        <th>Thickness</th>
                        <th>Radius</th>
                        <th>Unit</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($product_sizes as $size): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($size['product_name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($size['height'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($size['width'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($size['thickness'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($size['radius'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($size['unit']); ?></td>
                        <td class="text-end">
                            <a href="../edit/product_sizes?id=<?php echo $size['id']; ?>" class="btn btn-sm btn-info" title="Edit Size"><i class="fas fa-pencil-alt"></i></a>
                            <a href="../delete/product_sizes?id=<?php echo $size['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this size entry?')" title="Delete Size"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>