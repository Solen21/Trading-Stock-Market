<?php
// Set the HTTP status code to 404
http_response_code(404);

// Include a backend file that can initialize session and settings
include_once __DIR__ . '/../backend/admin/dashboard.php';
$page_title = 'Page Not Found';
include_once __DIR__ . '/../include/header.php';
?>

<div class="container text-center d-flex flex-column justify-content-center" style="min-height: 70vh;">
    <div class="card shadow-lg mx-auto" style="max-width: 500px; backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.8);">
        <div class="card-body p-5">
            <h1 class="display-1 text-danger fw-bold">404</h1>
            <h2 class="h3 mb-3">Page Not Found</h2>
            <p class="lead text-muted">
                Sorry, the page you are looking for could not be found.
            </p>
            <hr>
            <a href="<?php echo $base_url; ?>frontend/admin/dashboard" class="btn btn-primary mt-3"><i class="fas fa-home me-2"></i>Return to Dashboard</a>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../include/footer.php'; ?>