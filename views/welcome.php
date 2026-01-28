<?php
// Sử dụng layout auth và truyền nội dung vào
ob_start();
?>
<!--begin::Main Content-->
<div class="welcome-wrapper" style="background-image: url('<?= asset('dist/assets/img/background.png') ?>'); background-size: cover; background-position: center;">
  <div class="welcome-card" style="backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.3);">
    <div class="welcome-header text-white" style="background: linear-gradient(135deg, rgba(255, 115, 0, 0.3), rgba(250, 156, 5, 0.3));">
      <a href="<?= BASE_URL ?>" class="text-white text-decoration-none">
        <div class="brand-icon">
          <img src="<?= asset('dist/assets/img/LOGO.PNG') ?>" alt="Logo" style="height: 300px; width: auto;">
        </div>
        <h1 style="font-weight: 900; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
          Chào mừng đến với Website Luxury4Trip
        </h1>
        <div class="subtitle">
          Hệ thống quản lý tour du lịch chuyên nghiệp của Luxury4Trip
        </div>
      </a>
    </div>
    <div class="card-body">
      <div class="alert alert-info welcome-alert" role="alert" style="background: rgba(217, 237, 247, 0.3); border-color: rgba(184, 218, 224, 0.3);">
        <h4 class="alert-heading">
          <i class="bi bi-info-circle-fill me-2"></i>
          Chào mừng!
        </h4>
        <p class="mb-3">
          Đây là hệ thống quản lý tour du lịch của Luxury4Trip. 
          Để sử dụng đầy đủ chức năng, vui lòng đăng nhập vào hệ thống.
        </p>
        <div class="d-grid gap-2">
          <a href="<?= BASE_URL ?>?act=login" class="btn btn-welcome">
            <i class="bi bi-box-arrow-in-right me-2"></i>
            Đăng nhập hệ thống
          </a>
        </div>
      </div>

      <div class="row mt-4 g-3">
        <div class="col-md-4 mb-3">
          <div class="card feature-card">
            <div class="card-body text-center">
              <i class="bi bi-airplane-engines feature-icon text-fpt-orange"></i>
              <h5 class="card-title">Quản lý Tour</h5>
              <p class="card-text">Quản lý các tour du lịch một cách hiệu quả và chuyên nghiệp</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card feature-card">
            <div class="card-body text-center">
              <i class="bi bi-people feature-icon text-fpt-orange"></i>
              <h5 class="card-title">Quản lý Khách hàng</h5>
              <p class="card-text">Theo dõi thông tin khách hàng đặt tour một cách chi tiết</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card feature-card">
            <div class="card-body text-center">
              <i class="bi bi-graph-up feature-icon text-fpt-orange"></i>
              <h5 class="card-title">Báo cáo & Thống kê</h5>
              <p class="card-text">Xem báo cáo và thống kê doanh thu một cách trực quan</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end::Main Content-->
<?php
$content = ob_get_clean();
// Hiển thị layout auth với nội dung
view('layouts.AuthLayout', [
    'title' => $title ?? 'Website Quản Lý Tour Du Lịch',
    'content' => $content,
]);
?>

