<?php
include_once __DIR__ . '/../../../backend/admin/edit/companies.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-building me-2 text-primary"></i>Edit Company</h1>
    </div>
    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($company): ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($company['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Company Code <span class="text-danger">*</span></label>
                <input type="text" id="code" name="code" class="form-control" value="<?php echo htmlspecialchars($company['code']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Info</label>
                <textarea id="contact_info" name="contact_info" class="form-control" rows="3"><?php echo htmlspecialchars($company['contact_info']); ?></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Changes</button>
                <a href="../management/companies" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php else: ?>
            <div class="alert alert-danger">Company not found or an error occurred.</div>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>

