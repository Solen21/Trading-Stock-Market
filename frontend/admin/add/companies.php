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
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Company Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contact_person" class="form-label">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" id="country" name="country" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-3"><label for="info" class="form-label">Additional Info</label><textarea id="info" name="info" class="form-control" rows="2"></textarea></div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i>Save Company</button>
                <a href="../management/companies" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../../../include/footer.php'; ?>
