<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tổng quan Quản lý Tour</h3>
      </div>
      <div class="card-body">
        <!-- Quick Stats -->
        <div class="row mb-4">
          <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $thongKe['nhan_su']['tong'] ?></h3>
                <p>Nhân sự</p>
              </div>
              <div class="icon"><i class="bi bi-people"></i></div>
              <a href="<?= BASE_URL ?>quanly/nhansu" class="small-box-footer">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $thongKe['lich_khoi_hanh']['tong'] ?></h3>
                <p>Lịch khởi hành</p>
              </div>
              <div class="icon"><i class="bi bi-calendar-event"></i></div>
              <a href="<?= BASE_URL ?>quanly/lich" class="small-box-footer">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $thongKe['booking']['tong'] ?></h3>
                <p>Booking</p>
              </div>
              <div class="icon"><i class="bi bi-journal-check"></i></div>
              <a href="<?= BASE_URL ?>quanly/booking" class="small-box-footer">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $thongKe['ghi_chu']['tong'] ?></h3>
                <p>Ghi chú đặc biệt</p>
              </div>
              <div class="icon"><i class="bi bi-journal-text"></i></div>
              <a href="<?= BASE_URL ?>quanly/ghichu" class="small-box-footer">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $thongKe['nhat_ky']['tong'] ?></h3>
                <p>Nhật ký tour</p>
              </div>
              <div class="icon"><i class="bi bi-book"></i></div>
              <a href="<?= BASE_URL ?>quanly/nhatky" class="small-box-footer">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Navigation Cards -->
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              <div class="card-header bg-info text-white">
                <h5><i class="bi bi-people"></i> Quản lý Nhân sự</h5>
              </div>
              <div class="card-body">
                <p>Quản lý HDV, tài xế và nhân viên hỗ trợ</p>
                <ul class="list-unstyled">
                  <li><i class="bi bi-check-circle text-success"></i> Rảnh: <?= $thongKe['nhan_su']['ranh'] ?></li>
                  <li><i class="bi bi-clock text-warning"></i> Bận: <?= $thongKe['nhan_su']['ban'] ?></li>
                  <li><i class="bi bi-x-circle text-danger"></i> Nghỉ: <?= $thongKe['nhan_su']['nghi'] ?></li>
                </ul>
                <a href="<?= BASE_URL ?>quanly/nhansu" class="btn btn-info">Quản lý</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              <div class="card-header bg-success text-white">
                <h5><i class="bi bi-calendar-event"></i> Lịch khởi hành</h5>
              </div>
              <div class="card-body">
                <p>Lập lịch và phân bổ nhân sự, dịch vụ</p>
                <ul class="list-unstyled">
                  <li><i class="bi bi-exclamation-triangle text-warning"></i> Chưa phân bổ: <?= $thongKe['lich_khoi_hanh']['chua_phan_bo'] ?></li>
                  <li><i class="bi bi-play-circle text-primary"></i> Đang thực hiện: <?= $thongKe['lich_khoi_hanh']['dang_thuc_hien'] ?></li>
                  <li><i class="bi bi-check-circle text-success"></i> Hoàn thành: <?= $thongKe['lich_khoi_hanh']['hoan_thanh'] ?></li>
                </ul>
                <a href="<?= BASE_URL ?>quanly/lich" class="btn btn-success">Quản lý</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="card h-100">
              <div class="card-header bg-warning text-white">
                <h5><i class="bi bi-journal-check"></i> Booking & Khách hàng</h5>
              </div>
              <div class="card-body">
                <p>Danh sách khách, check-in, phân phòng</p>
                <ul class="list-unstyled">
                  <li><i class="bi bi-check-circle text-success"></i> Đã xác nhận: <?= $thongKe['booking']['xac_nhan'] ?></li>
                  <li><i class="bi bi-clock text-warning"></i> Chờ thanh toán: <?= $thongKe['booking']['cho_thanh_toan'] ?></li>
                </ul>
                <a href="<?= BASE_URL ?>quanly/booking" class="btn btn-warning">Quản lý</a>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">
                <h5><i class="bi bi-journal-text"></i> Ghi chú đặc biệt</h5>
              </div>
              <div class="card-body">
                <p>Yêu cầu riêng của khách: ăn chay, dị ứng, bệnh lý...</p>
                <ul class="list-unstyled">
                  <li><i class="bi bi-exclamation-triangle text-danger"></i> Rất quan trọng: <?= $thongKe['ghi_chu']['rat_quan_trong'] ?></li>
                  <li><i class="bi bi-clock text-warning"></i> Chưa xử lý: <?= $thongKe['ghi_chu']['chua_xu_ly'] ?></li>
                </ul>
                <a href="<?= BASE_URL ?>quanly/ghichu" class="btn btn-danger">Quản lý</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header bg-primary text-white">
                <h5><i class="bi bi-book"></i> Nhật ký Tour</h5>
              </div>
              <div class="card-body">
                <p>Ghi nhận sự cố, phản hồi khách, đánh giá HDV</p>
                <ul class="list-unstyled">
                  <li><i class="bi bi-exclamation-triangle text-warning"></i> Sự cố: <?= $thongKe['nhat_ky']['su_co'] ?></li>
                  <li><i class="bi bi-star-fill text-warning"></i> Đánh giá TB: <?= $thongKe['nhat_ky']['danh_gia_tb'] ?>/5</li>
                </ul>
                <a href="<?= BASE_URL ?>quanly/nhatky" class="btn btn-primary">Quản lý</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Quản lý Tour - Website Quản Lý Tour',
    'pageTitle' => 'Tổng quan Quản lý Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'active' => true],
    ],
]);
?>