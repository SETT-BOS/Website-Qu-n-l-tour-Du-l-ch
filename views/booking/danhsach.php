<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Danh sách khách - <?= htmlspecialchars($booking['ma_booking']) ?></h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>booking/print/<?= $booking['id'] ?>" class="btn btn-info btn-sm" target="_blank">
            <i class="bi bi-printer"></i> In danh sách
          </a>
          <a href="<?= BASE_URL ?>booking/phanphong/<?= $booking['id'] ?>" class="btn btn-warning btn-sm">
            <i class="bi bi-house"></i> Phân phòng
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <table class="table table-sm">
              <tr><td><strong>Tour:</strong></td><td><?= htmlspecialchars($booking['ten_tour']) ?></td></tr>
              <tr><td><strong>Thời gian:</strong></td><td><?= date('d/m/Y', strtotime($booking['ngay_khoi_hanh'])) ?> - <?= date('d/m/Y', strtotime($booking['ngay_ket_thuc'])) ?></td></tr>
              <tr><td><strong>HDV:</strong></td><td><?= htmlspecialchars($booking['hdv']) ?></td></tr>
            </table>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
                <th>Năm sinh</th>
                <th>CMND/CCCD</th>
                <th>Liên hệ</th>
                <th>Thanh toán</th>
                <th>Phòng KS</th>
                <th>Check-in</th>
                <th>Yêu cầu</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($khachHang as $index => $khach): ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td>
                    <div class="fw-bold"><?= htmlspecialchars($khach['ho_ten']) ?></div>
                    <small class="text-muted"><?= htmlspecialchars($khach['email']) ?></small>
                  </td>
                  <td><?= htmlspecialchars($khach['gioi_tinh']) ?></td>
                  <td><?= $khach['nam_sinh'] ?></td>
                  <td><?= htmlspecialchars($khach['so_cmnd']) ?></td>
                  <td><?= htmlspecialchars($khach['dien_thoai']) ?></td>
                  <td>
                    <?php if ($khach['trang_thai_tt'] == 'Đã thanh toán'): ?>
                      <span class="badge bg-success"><?= htmlspecialchars($khach['trang_thai_tt']) ?></span>
                    <?php else: ?>
                      <span class="badge bg-danger"><?= htmlspecialchars($khach['trang_thai_tt']) ?></span>
                    <?php endif; ?>
                  </td>
                  <td><span class="badge bg-info"><?= htmlspecialchars($khach['phong_ks']) ?></span></td>
                  <td>
                    <?php if ($khach['check_in']): ?>
                      <span class="badge bg-success"><i class="bi bi-check-circle"></i> Đã check-in</span>
                    <?php else: ?>
                      <button class="btn btn-sm btn-outline-primary" onclick="checkIn(<?= $khach['id'] ?>)">
                        <i class="bi bi-box-arrow-in-right"></i> Check-in
                      </button>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (!empty($khach['yeu_cau'])): ?>
                      <span class="badge bg-warning"><?= htmlspecialchars($khach['yeu_cau']) ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <button class="btn btn-sm btn-outline-warning" title="Sửa thông tin">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="mt-3">
          <a href="<?= BASE_URL ?>booking" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function checkIn(khachId) {
  if (confirm('Xác nhận check-in cho khách này?')) {
    // Ajax call to update check-in status
    alert('Check-in thành công!');
    location.reload();
  }
}
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Danh sách khách - Website Quản Lý Tour',
    'pageTitle' => 'Danh sách khách trong đoàn',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Booking', 'url' => BASE_URL . 'booking'],
        ['label' => 'Danh sách khách', 'active' => true],
    ],
]);
?>