<?php
include_once __DIR__ . '/../../../backend/admin/add/companies.php';
include_once __DIR__ . '/../../../include/header.php';
?>

<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3 mb-0"><i class="fas fa-plus-circle me-2 text-primary"></i>Add New Company</h1>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['flash_message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['flash_message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['flash_message'], $_SESSION['flash_message_type']); ?>
        <?php endif; ?>

        <form method="post" action="companies">
            <div class="mb-3">
                <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Company Code <span class="text-danger">*</span></label>
                <input type="text" id="code" name="code" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contact_info" class="form-label">Contact Info</label>
                <textarea id="contact_info" name="contact_info" class="form-control" rows="3"></textarea>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Company</button>
                <a href="../management/companies" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>

