<?php
// Sử dụng layout auth và truyền nội dung vào
ob_start();
?>
<!--begin::Admin Login Content-->
<div class="login-wrapper" style="background-image: url('<?= asset('dist/assets/img/background.png') ?>'); background-size: cover; background-position: center;">
    <div class="col-12 col-md-8 col-lg-5 col-xl-4">
        <div class="card login-card shadow-lg border-0" style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.3);">
            <div class="login-header text-center text-white" style="background: linear-gradient(135deg, rgba(220, 53, 69, 0.3), rgba(200, 35, 51, 0.3));">
                <a href="<?= BASE_URL ?>" class="text-white text-decoration-none">
                    <div class="brand-icon mb-2">
                        <img src="<?= asset('dist/assets/img/LOGO.PNG') ?>" alt="Logo" style="height: 300px; width: auto;">
                    </div>
                    <h2 style="font-weight: 900; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        Quản Trị Viên
                    </h2>
                </a>
                <div class="mt-2 fw-light fst-italic" style="font-size: 1rem;">
                    Khu vực dành cho quản trị viên
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-title text-center mb-4 fw-bold card-title-login text-danger">
                    Đăng nhập Admin
                </h4>
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger fade show" role="alert">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>
                        <strong>Lỗi đăng nhập</strong>
                    </div>
                    <ul class="mb-0 ps-3">
                        <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <form action="<?= BASE_URL ?>admin/check-login" method="post" autocomplete="on" novalidate>
                    <input type="hidden" name="redirect" value="<?= $redirect ?? BASE_URL . '?act=home' ?>" />

                    <div class="mb-3">
                        <label for="adminEmail" class="form-label fw-semibold">
                            Tài khoản Admin
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <input type="text"
                                   class="form-control"
                                   id="adminEmail"
                                   name="email"
                                   value="<?= htmlspecialchars($email ?? '') ?>"
                                   placeholder="Nhập mã sinh viên (VD: PH59005)"
                                   required
                                   autofocus />
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="adminPassword" class="form-label fw-semibold">
                            Mật khẩu Admin
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                            <input type="password"
                                   class="form-control"
                                   id="adminPassword"
                                   name="password"
                                   placeholder="Nhập mật khẩu admin"
                                   required
                                   autocomplete="current-password"/>
                            <button type="button" class="btn btn-outline-secondary btn-sm" tabindex="-1" id="togglePassword" title="Hiện/ẩn mật khẩu">
                                <i class="bi bi-eye" id="togglePasswordIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="rememberMe" name="remember_me">
                            <label class="form-check-label" for="rememberMe">
                                Ghi nhớ tài khoản
                            </label>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="bi bi-shield-check me-2"></i>Đăng nhập Admin
                        </button>
                    </div>
                </form>
                <div class="login-divider"></div>
                <div class="text-center">
                    <a href="<?= BASE_URL ?>login" class="text-decoration-none text-primary fw-semibold me-3">
                        <i class="bi bi-person me-2"></i>
                        Đăng nhập User
                    </a>
                    <a href="<?= BASE_URL ?>" class="text-decoration-none text-secondary fw-semibold">
                        <i class="bi bi-arrow-left me-2"></i>
                        Trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Admin Login Content-->
<?php
$content = ob_get_clean();

// Hiển thị layout auth với nội dung
view('layouts.AuthLayout', [
    'title' => $title ?? 'Đăng nhập Admin',
    'content' => $content,
    'extraJs' => ['js/login.js'],
]);
?>