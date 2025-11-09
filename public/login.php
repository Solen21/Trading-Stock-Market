<?php
include_once __DIR__ . '/../backend/auth/login.php';
$page_title = 'Login';
include_once __DIR__ . '/../include/header.php';
?>
<canvas id="motion-canvas" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></canvas>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="width: 100%; max-width: 450px; backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.8);">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <?php if (isset($settings['system_logo']) && !empty($settings['system_logo'])): ?>
                    <img src="<?php echo $base_url; ?>public/<?php echo htmlspecialchars($settings['system_logo']); ?>" alt="Logo" class="mb-3" style="max-width: 120px; border-radius: 50%;">
                <?php elseif (isset($settings['system_icon']) && !empty($settings['system_icon'])): ?>
                    <i class="<?php echo htmlspecialchars($settings['system_icon']); ?> fa-3x mb-3 text-primary"></i>
                <?php endif; ?>
                <h1 class="h3 mb-3 fw-normal"><?php echo htmlspecialchars($system_name ?? 'Login'); ?></h1>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="login">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign in
                </button>
            </form>
        </div>
    </div>
</div>
 <?php
include_once __DIR__ . '/../include/footer.php'; // Includes JS files
?>
