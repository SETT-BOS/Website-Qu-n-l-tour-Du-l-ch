<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="<?= BASE_URL . '?act=home' ?>" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="<?= asset('dist/assets/img/AdminLTELogo.png') ?>"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">
        <?php if (isAdmin()): ?>
          Quản Trị Viên
        <?php else: ?>
          Quản Lý Tour
        <?php endif; ?>
      </span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="menu"
        data-accordion="false"
      >
        <li class="nav-item">
          <a href="<?= BASE_URL . '?act=home' ?>" class="nav-link">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li> 




         <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-people-fill"></i>
            <p>
              <?= isAdmin() ? 'Quản lý tour và sản phẩm du lịch' : 'Xem Khách hàng' ?>
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= BASE_URL ?>?act=Category" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p><?= isAdmin() ? 'Danh mục tour' : 'Khách hàng trong tour' ?></p>
              </a>
            </li>
          </ul>
        </li>




        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-airplane-engines"></i>
            <p>
              Bán tour và đặt chỗ
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= BASE_URL ?>?act=tours" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>
                  Danh sách Tour
                  <span class="badge badge-info right"><?= getTourCount() ?></span>
                </p>
              </a>
            </li>
            <?php if (isAdmin()): ?>
            <li class="nav-item">
              <a href="<?= BASE_URL ?>?act=tours/form" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Thêm Tour mới</p>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-gear-wide-connected"></i>
            <p>
              <?= isAdmin() ? 'Quản lý & Điều hành Tour' : 'Thông tin Tour' ?>
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if (isAdmin()): ?>
            <li class="nav-item">
              <a href="<?= BASE_URL ?>?act=nhansu" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>
                  Quản lý Nhân sự
                  <span class="badge badge-success right"><?= getNhanSuCount() ?></span>
                </p>
              </a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
              <a href="<?= BASE_URL ?>?act=lich" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p><?= isAdmin() ? 'Lịch khởi hành & Phân bổ' : 'Xem lịch khởi hành' ?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASE_URL ?>?act=booking" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>
                  <?= isAdmin() ? 'Danh sách Khách đoàn' : 'Xem khách đoàn' ?>
                  <span class="badge badge-warning right"><?= getBookingCount() ?></span>
                </p>
              </a>
            </li>
            <?php if (isAdmin()): ?>
            <li class="nav-item">
              <a href="<?= BASE_URL ?>?act=admin/bookings" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>
                  Quản lý Đơn hàng
                  <span class="badge badge-danger right"><?= getBookingCount() ?></span>
                </p>
              </a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
              <a href="<?= BASE_URL ?>?act=ghichu" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p><?= isAdmin() ? 'Ghi chú đặc biệt' : 'Xem ghi chú' ?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASE_URL ?>?act=nhatky" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p><?= isAdmin() ? 'Nhật ký Tour' : 'Xem nhật ký' ?></p>
              </a>
            </li>
          </ul>
        </li>
      
        <?php if (isAdmin()): ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-bar-chart-line"></i>
            <p>
              Báo cáo Vận hành
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= BASE_URL . '?act=baocao/doanhthu' ?>" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Doanh thu</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASE_URL . '?act=baocao/hieuquatour' ?>" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Hiệu quả Tour</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASE_URL . '?act=baocao/khachhang' ?>" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Khách hàng</p>
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
        <li class="nav-header">HỆ THỐNG</li>
        <li class="nav-item">
          <a href="<?= BASE_URL . 'logout' ?>" class="nav-link">
            <i class="nav-icon bi bi-box-arrow-right"></i>
            <p>Đăng xuất</p>
          </a>
        </li>
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

