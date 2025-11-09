<?php
include_once __DIR__ . '/../../../backend/admin/management/role.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">
            <i class="fas fa-user-shield me-2 text-primary"></i>Role Management
        </h1>
        <a href="../add/role" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Role
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
                        <th>Role Name</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($role['name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($role['description']); ?></td>
                        <td class="text-end">
                            <a href="../edit/role?id=<?php echo $role['id']; ?>" class="btn btn-sm btn-info" title="Edit Role"><i class="fas fa-pencil-alt"></i></a>
                            <a href="../delete/role?id=<?php echo $role['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this role? This cannot be undone.')" title="Delete Role"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>
