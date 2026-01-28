<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tất cả ghi chú của khách hàng</h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>ghichu/create" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Thêm ghi chú mới
          </a>
        </div>
      </div>
      <div class="card-body">
        <!-- Thông tin khách hàng -->
        <div class="row mb-4">
          <div class="col-md-6">
            <div class="card bg-light">
              <div class="card-body">
                <h5><i class="bi bi-person-circle"></i> Thông tin khách hàng</h5>
                <table class="table table-sm table-borderless">
                  <tr>
                    <td><strong>Họ tên:</strong></td>
                    <td><?= htmlspecialchars($khachHang['ho_ten']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Tour:</strong></td>
                    <td><?= htmlspecialchars($khachHang['tour']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Điện thoại:</strong></td>
                    <td><?= htmlspecialchars($khachHang['dien_thoai']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Tổng ghi chú:</strong></td>
                    <td><span class="badge bg-info"><?= count($ghiChuList) ?> ghi chú</span></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card bg-warning bg-opacity-10">
              <div class="card-body">
                <h6><i class="bi bi-exclamation-triangle"></i> Tóm tắt yêu cầu đặc biệt</h6>
                <ul class="list-unstyled mb-0">
                  <?php foreach ($ghiChuList as $ghiChu): ?>
                    <li class="mb-1">
                      <span class="badge bg-secondary"><?= htmlspecialchars($ghiChu['loai_ghi_chu']) ?></span>
                      <?= htmlspecialchars(substr($ghiChu['noi_dung'], 0, 50)) ?>...
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Danh sách ghi chú -->
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>Loại</th>
                <th>Nội dung</th>
                <th>Mức độ</th>
                <th>Ngày tạo</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ghiChuList as $ghiChu): ?>
                <tr>
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
                    <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($ghiChu['loai_ghi_chu']) ?></span>
                  </td>
                  <td>
                    <div class="text-truncate" style="max-width: 300px;" title="<?= htmlspecialchars($ghiChu['noi_dung']) ?>">
                      <?= htmlspecialchars($ghiChu['noi_dung']) ?>
                    </div>
                  </td>
                  <td>
                    <?php
                    $priorityClass = match($ghiChu['muc_do']) {
                        'Rất quan trọng' => 'bg-danger',
                        'Quan trọng' => 'bg-warning',
                        'Bình thường' => 'bg-success',
                        default => 'bg-secondary'
                    };
                    ?>
                    <span class="badge <?= $priorityClass ?>"><?= htmlspecialchars($ghiChu['muc_do']) ?></span>
                  </td>
                  <td><?= date('d/m/Y', strtotime($ghiChu['ngay_tao'])) ?></td>
                  <td>
                    <?php if ($ghiChu['trang_thai'] == 'Đã xử lý'): ?>
                      <span class="badge bg-success"><?= htmlspecialchars($ghiChu['trang_thai']) ?></span>
                    <?php else: ?>
                      <span class="badge bg-warning"><?= htmlspecialchars($ghiChu['trang_thai']) ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="<?= BASE_URL ?>ghichu/view/<?= $ghiChu['id'] ?>" class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                        <i class="bi bi-eye"></i>
                      </a>
                      <button class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <?php if ($ghiChu['trang_thai'] == 'Chưa xử lý'): ?>
                        <button class="btn btn-sm btn-outline-success" title="Đánh dấu đã xử lý">
                          <i class="bi bi-check-circle"></i>
                        </button>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="mt-3">
          <a href="<?= BASE_URL ?>ghichu" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại danh sách tổng
          </a>
          <button class="btn btn-info">
            <i class="bi bi-printer"></i> In tất cả ghi chú
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Ghi chú khách hàng - Website Quản Lý Tour',
    'pageTitle' => 'Ghi chú của khách hàng: ' . htmlspecialchars($khachHang['ho_ten']),
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Ghi chú đặc biệt', 'url' => BASE_URL . 'ghichu'],
        ['label' => 'Ghi chú khách hàng', 'active' => true],
    ],
]);
?>