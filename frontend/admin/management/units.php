<?php
include_once __DIR__ . '/../../../backend/admin/management/units.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">
            <i class="fas fa-balance-scale me-2 text-primary"></i>Units Management
        </h1>
        <a href="../add/units" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Unit
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
                        <th>Unit Name</th>
                        <th>Category</th>
                        <th>Base Value</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($units as $unit): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($unit['unit_name']); ?></strong></td>
                        <td><span class="badge bg-secondary"><?php echo htmlspecialchars(ucfirst($unit['category'])); ?></span></td>
                        <td><?php echo htmlspecialchars($unit['base_value']); ?></td>
                        <td><?php echo htmlspecialchars($unit['description']); ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($unit['created_at'])); ?></td>
                        <td class="text-end">
                            <a href="../edit/units?id=<?php echo $unit['id']; ?>" class="btn btn-sm btn-info" title="Edit Unit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="../delete/units?id=<?php echo $unit['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this unit?')" title="Delete Unit"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>