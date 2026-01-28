<?php ob_start(); ?>

<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="bi bi-person-circle me-2"></i>
          Thông tin tài khoản
        </h3>
      </div>
      <div class="card-body">
        <?php $currentUser = getCurrentUser(); ?>
        
        <!-- Thông tin cơ bản -->
        <div class="row mb-4">
          <div class="col-md-4 text-center">
            <?php if (isAdmin()): ?>
            <div class="position-relative d-inline-block">
              <img id="avatarPreview" 
                   src="<?= isset($_SESSION['user_avatar_' . getCurrentUser()->id]) ? $_SESSION['user_avatar_' . getCurrentUser()->id] : asset('dist/assets/img/user2-160x160.jpg') ?>" 
                   class="rounded-circle shadow" 
                   alt="Avatar" 
                   style="width: 120px; height: 120px; object-fit: cover;">
              <button type="button" class="btn btn-sm btn-primary position-absolute" 
                      style="bottom: 0; right: 0; border-radius: 50%; width: 30px; height: 30px;"
                      onclick="document.getElementById('avatarInput').click()">
                <i class="bi bi-camera"></i>
              </button>
            </div>
            <form id="avatarForm" enctype="multipart/form-data" style="display: none;">
              <input type="file" id="avatarInput" name="avatar" accept="image/*" onchange="uploadAvatar()">
            </form>
            <?php else: ?>
            <img src="<?= asset('dist/assets/img/avatar.png') ?>" 
                 class="rounded-circle shadow mx-auto" 
                 alt="Avatar" 
                 style="width: 120px; height: 120px; object-fit: cover;">
            <?php endif; ?>
            <div class="mt-3">
              <span class="badge <?= isAdmin() ? 'bg-danger' : 'bg-primary' ?> fs-6">
                <i class="bi <?= isAdmin() ? 'bi-shield-check' : 'bi-person-badge' ?> me-1"></i>
                <?= getUserTypeLabel() ?>
              </span>
            </div>
          </div>
          <div class="col-md-8">
            <table class="table table-borderless">
              <tr>
                <td class="fw-bold" style="width: 30%;">Họ tên:</td>
                <td><?= htmlspecialchars($currentUser->name) ?></td>
              </tr>
              <tr>
                <td class="fw-bold">Email:</td>
                <td><?= htmlspecialchars($currentUser->email) ?></td>
              </tr>
              <tr>
                <td class="fw-bold">ID:</td>
                <td>#<?= $currentUser->id ?></td>
              </tr>
              <tr>
                <td class="fw-bold">Loại tài khoản:</td>
                <td>
                  <span class="badge <?= isAdmin() ? 'bg-danger' : 'bg-primary' ?>">
                    <?= getUserTypeLabel() ?>
                  </span>
                </td>
              </tr>
              <tr>
                <td class="fw-bold">Trạng thái:</td>
                <td>
                  <span class="badge bg-success">
                    <i class="bi bi-check-circle me-1"></i>Hoạt động
                  </span>
                </td>
              </tr>
              <tr>
                <td class="fw-bold">Đăng nhập lần cuối:</td>
                <td><?= date('d/m/Y H:i:s') ?></td>
              </tr>
            </table>
          </div>
        </div>

        <!-- Quyền hạn -->
        <div class="card bg-light">
          <div class="card-header">
            <h5 class="card-title mb-0">
              <i class="bi bi-key me-2"></i>Quyền hạn
            </h5>
          </div>
          <div class="card-body">
            <?php if (isAdmin()): ?>
              <div class="alert alert-danger">
                <h6><i class="bi bi-shield-exclamation me-2"></i>Quản trị viên - Toàn quyền</h6>
                <ul class="mb-0">
                  <li>Quản lý tất cả tour du lịch</li>
                  <li>Quản lý nhân sự và phân công</li>
                  <li>Quản lý khách hàng và booking</li>
                  <li>Quản lý người dùng hệ thống</li>
                  <li>Xem tất cả báo cáo và thống kê</li>
                  <li>Cấu hình hệ thống</li>
                </ul>
              </div>
            <?php else: ?>
              <div class="alert alert-warning">
                <h6><i class="bi bi-eye me-2"></i>Hướng dẫn viên - Chỉ xem</h6>
                <ul class="mb-0">
                  <li><i class="bi bi-eye text-muted me-1"></i>Xem danh sách tour được phân công</li>
                  <li><i class="bi bi-eye text-muted me-1"></i>Xem thông tin cá nhân</li>
                  <li><i class="bi bi-eye text-muted me-1"></i>Xem lịch khởi hành</li>
                  <li><i class="bi bi-eye text-muted me-1"></i>Xem khách hàng trong tour</li>
                  <li><i class="bi bi-eye text-muted me-1"></i>Xem ghi chú và nhật ký tour</li>
                </ul>

              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Thống kê nhanh -->
        <div class="row mt-4">
          <div class="col-md-4">
            <div class="info-box bg-primary">
              <span class="info-box-icon"><i class="bi bi-airplane"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Tour đã tham gia</span>
                <span class="info-box-number"><?= isAdmin() ? '∞' : rand(5, 25) ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="bi bi-people"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Khách hàng phục vụ</span>
                <span class="info-box-number"><?= isAdmin() ? '∞' : rand(100, 500) ?></span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="bi bi-calendar-check"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Ngày làm việc</span>
                <span class="info-box-number"><?= rand(30, 365) ?></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Nút hành động -->
        <div class="mt-4 text-center">
          <?php if (isAdmin()): ?>
            <button class="btn btn-primary me-2">
              <i class="bi bi-pencil me-2"></i>Chỉnh sửa thông tin
            </button>
            <button class="btn btn-warning me-2">
              <i class="bi bi-key me-2"></i>Đổi mật khẩu
            </button>
          <?php else: ?>
            <button class="btn btn-outline-secondary me-2" disabled>
              <i class="bi bi-eye me-2"></i>Chỉ xem thông tin
            </button>
            <button class="btn btn-outline-warning me-2" disabled>
              <i class="bi bi-lock me-2"></i>Không thể đổi mật khẩu
            </button>
          <?php endif; ?>
          <a href="<?= BASE_URL ?>?act=home" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Quay lại Dashboard
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Thông tin tài khoản - Website Quản Lý Tour',
    'pageTitle' => 'Thông tin tài khoản',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Tài khoản', 'active' => true],
    ],
    'extraJs' => ['js/profile.js'],
]);
?>