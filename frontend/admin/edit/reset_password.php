<?php
include_once __DIR__ . '/../../../backend/admin/edit/reset_password.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0">
            <i class="fas fa-key me-2 text-warning"></i>Reset Password
        </h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($user): ?>
        <p>You are resetting the password for <strong><?php echo htmlspecialchars($user['full_name']); ?> (<?php echo htmlspecialchars($user['username']); ?>)</strong>.</p>
        
        <form method="post" action="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-warning"><i class="fas fa-save me-2"></i>Reset Password</button>
                <a href="../management/user" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">User not found or an error occurred.</div>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>

