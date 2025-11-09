<?php
include_once __DIR__ . '/../../../backend/admin/management/companies.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">
            <i class="fas fa-building me-2 text-primary"></i>Company Management
        </h1>
        <a href="../add/companies" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Company
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
                        <th>Company Name</th>
                        <th>Contact Person</th>
                        <th>Country</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($companies as $company): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($company['name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($company['contact_person'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($company['country'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($company['email'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($company['phone'] ?? 'N/A'); ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($company['created_at'])); ?></td>
                        <td class="text-end">
                            <a href="../edit/companies?id=<?php echo $company['id']; ?>" class="btn btn-sm btn-info" title="Edit Company"><i class="fas fa-pencil-alt"></i></a>
                            <a href="../delete/companies?id=<?php echo $company['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this company?')" title="Delete Company"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>
