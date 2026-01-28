<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Quản lý Booking & Khách hàng</h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>quanly" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Quay lại tổng quan
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>Mã Booking</th>
                <th>Tour</th>
                <th>Ngày khởi hành</th>
                <th>Số khách</th>
                <th>Thanh toán</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($bookings as $booking): ?>
                <tr>
                  <td><strong><?= htmlspecialchars($booking['ma_booking']) ?></strong></td>
                  <td><?= htmlspecialchars($booking['ten_tour']) ?></td>
                  <td><?= date('d/m/Y', strtotime($booking['ngay_khoi_hanh'])) ?></td>
                  <td><span class="badge bg-info"><?= $booking['so_khach'] ?> người</span></td>
                  <td>
                    <div><?= number_format($booking['da_thanh_toan']) ?> / <?= number_format($booking['tong_tien']) ?> VNĐ</div>
                    <div class="progress" style="height: 5px;">
                      <div class="progress-bar" style="width: <?= ($booking['da_thanh_toan']/$booking['tong_tien'])*100 ?>%"></div>
                    </div>
                  </td>
                  <td>
                    <?php if ($booking['trang_thai'] == 'Hoàn thành'): ?>
                      <span class="badge bg-success"><?= htmlspecialchars($booking['trang_thai']) ?></span>
                    <?php else: ?>
                      <span class="badge bg-primary"><?= htmlspecialchars($booking['trang_thai']) ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <button class="btn btn-sm btn-outline-primary" title="Danh sách khách">
                        <i class="bi bi-people"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-info" title="In danh sách">
                        <i class="bi bi-printer"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-warning" title="Phân phòng">
                        <i class="bi bi-house"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Quản lý Booking - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý Booking & Khách hàng',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'quanly'],
        ['label' => 'Booking', 'active' => true],
    ],
]);
?>