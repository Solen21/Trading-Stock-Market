<?php
include_once __DIR__ . '/../../../backend/admin/management/user.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">
            <i class="fas fa-users-cog me-2 text-primary"></i>User Management
        </h1>
        <a href="../add/user" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New User
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
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><span class="badge bg-info text-dark"><?php echo htmlspecialchars($user['role_name']); ?></span></td>
                        <td>
                            <?php if ($user['status'] == 'Active'): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="../edit/user?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="../edit/reset_password?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-warning" title="Reset Password"><i class="fas fa-key"></i></a>
                            <?php if ($user['status'] == 'Active'): ?>
                                <a href="../edit/user_status?id=<?php echo $user['id']; ?>&status=Inactive" class="btn btn-sm btn-secondary" title="Click to deactivate this user">Deactivate</a>
                            <?php else: ?>
                                <a href="../edit/user_status?id=<?php echo $user['id']; ?>&status=Active" class="btn btn-sm btn-success" title="Click to activate this user">Activate</a>
                            <?php endif; ?>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-user-id="<?php echo $user['id']; ?>" title="Delete User"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to permanently delete this user? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="#" id="confirmDeleteButton" class="btn btn-danger">Delete User</a>
      </div>
    </div>
  </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>