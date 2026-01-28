<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Chi tiết ghi chú đặc biệt</h3>
        <div class="card-tools">
          <button class="btn btn-warning btn-sm">
            <i class="bi bi-pencil"></i> Chỉnh sửa
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <table class="table table-borderless">
              <tr>
                <td width="150"><strong>Khách hàng:</strong></td>
                <td><?= htmlspecialchars($ghiChu['ho_ten']) ?></td>
              </tr>
              <tr>
                <td><strong>Tour:</strong></td>
                <td><?= htmlspecialchars($ghiChu['tour']) ?></td>
              </tr>
              <tr>
                <td><strong>Loại ghi chú:</strong></td>
                <td>
                  <?php
                  $badgeClass = match($ghiChu['loai_ghi_chu']) {
                      'Ăn uống' => 'bg-info',
                      'Sức khỏe' => 'bg-danger',
                      'Phòng nghỉ' => 'bg-warning',
                      'Di chuyển' => 'bg-primary',
                      default => 'bg-secondary'
                  };
                  ?>
                  <span class="badge <?= $badgeClass ?> fs-6"><?= htmlspecialchars($ghiChu['loai_ghi_chu']) ?></span>
                </td>
              </tr>
              <tr>
                <td><strong>Mức độ:</strong></td>
                <td>
                  <?php
                  $priorityClass = match($ghiChu['muc_do']) {
                      'Rất quan trọng' => 'bg-danger',
                      'Quan trọng' => 'bg-warning',
                      'Bình thường' => 'bg-success',
                      default => 'bg-secondary'
                  };
                  ?>
                  <span class="badge <?= $priorityClass ?> fs-6"><?= htmlspecialchars($ghiChu['muc_do']) ?></span>
                </td>
              </tr>
              <tr>
                <td><strong>Ngày tạo:</strong></td>
                <td><?= date('d/m/Y H:i', strtotime($ghiChu['ngay_tao'])) ?></td>
              </tr>
              <tr>
                <td><strong>Người tạo:</strong></td>
                <td><?= htmlspecialchars($ghiChu['nguoi_tao']) ?></td>
              </tr>
              <tr>
                <td><strong>Trạng thái:</strong></td>
                <td>
                  <?php if ($ghiChu['trang_thai'] == 'Đã xử lý'): ?>
                    <span class="badge bg-success fs-6"><?= htmlspecialchars($ghiChu['trang_thai']) ?></span>
                  <?php else: ?>
                    <span class="badge bg-warning fs-6"><?= htmlspecialchars($ghiChu['trang_thai']) ?></span>
                  <?php endif; ?>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-4">
            <div class="alert alert-info">
              <h6><i class="bi bi-info-circle"></i> Lưu ý quan trọng</h6>
              <p class="mb-0">Thông tin này cần được thông báo đến HDV và các nhân viên liên quan trước khi tour bắt đầu.</p>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>Nội dung ghi chú</h5>
              </div>
              <div class="card-body">
                <p class="fs-5"><?= nl2br(htmlspecialchars($ghiChu['noi_dung'])) ?></p>
              </div>
            </div>
          </div>
        </div>

        <?php if (!empty($ghiChu['ghi_chu_xu_ly'])): ?>
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>Ghi chú xử lý</h5>
              </div>
              <div class="card-body">
                <p><?= nl2br(htmlspecialchars($ghiChu['ghi_chu_xu_ly'])) ?></p>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Action buttons -->
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>Hành động</h5>
              </div>
              <div class="card-body">
                <?php if ($ghiChu['trang_thai'] == 'Chưa xử lý'): ?>
                  <button class="btn btn-success me-2">
                    <i class="bi bi-check-circle"></i> Đánh dấu đã xử lý
                  </button>
                <?php endif; ?>
                <button class="btn btn-info me-2">
                  <i class="bi bi-bell"></i> Thông báo HDV
                </button>
                <button class="btn btn-warning me-2">
                  <i class="bi bi-printer"></i> In ghi chú
                </button>
                <a href="<?= BASE_URL ?>ghichu/khachhang/<?= $ghiChu['khach_hang_id'] ?>" class="btn btn-primary">
                  <i class="bi bi-person-lines-fill"></i> Xem tất cả ghi chú của khách
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-3">
          <a href="<?= BASE_URL ?>ghichu" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại danh sách
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Chi tiết ghi chú - Website Quản Lý Tour',
    'pageTitle' => 'Chi tiết ghi chú đặc biệt',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Ghi chú đặc biệt', 'url' => BASE_URL . 'ghichu'],
        ['label' => 'Chi tiết', 'active' => true],
    ],
]);
?>