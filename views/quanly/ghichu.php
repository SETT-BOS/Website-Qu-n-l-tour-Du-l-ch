<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Quản lý Ghi chú đặc biệt</h3>
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
                <th>Khách hàng</th>
                <th>Tour</th>
                <th>Loại ghi chú</th>
                <th>Nội dung</th>
                <th>Mức độ</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ghiChuList as $ghiChu): ?>
                <tr>
                  <td>
                    <div class="fw-bold"><?= htmlspecialchars($ghiChu['ho_ten']) ?></div>
                  </td>
                  <td><?= htmlspecialchars($ghiChu['tour']) ?></td>
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
                    <div class="text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($ghiChu['noi_dung']) ?>">
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
                  <td>
                    <?php if ($ghiChu['trang_thai'] == 'Đã xử lý'): ?>
                      <span class="badge bg-success"><?= htmlspecialchars($ghiChu['trang_thai']) ?></span>
                    <?php else: ?>
                      <span class="badge bg-warning"><?= htmlspecialchars($ghiChu['trang_thai']) ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <button class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                        <i class="bi bi-pencil"></i>
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
    'title' => 'Quản lý Ghi chú - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý Ghi chú đặc biệt',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'quanly'],
        ['label' => 'Ghi chú đặc biệt', 'active' => true],
    ],
]);
?>