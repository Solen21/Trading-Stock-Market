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
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($company['name'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contact_person" class="form-label">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person" class="form-control" value="<?php echo htmlspecialchars($company['contact_person'] ?? ''); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($company['email'] ?? ''); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($company['phone'] ?? ''); ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" id="country" name="country" class="form-control" value="<?php echo htmlspecialchars($company['country'] ?? ''); ?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" rows="2"><?php echo htmlspecialchars($company['address'] ?? ''); ?></textarea>
            </div>
            <div class="mb-3"><label for="info" class="form-label">Additional Info</label><textarea id="info" name="info" class="form-control" rows="2"><?php echo htmlspecialchars($company['info'] ?? ''); ?></textarea></div>
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
