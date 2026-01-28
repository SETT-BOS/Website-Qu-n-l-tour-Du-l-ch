<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Quản lý Lịch khởi hành</h3>
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
                <th>Mã lịch</th>
                <th>Tour</th>
                <th>Ngày khởi hành</th>
                <th>Số khách</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lichKhoiHanh as $lich): ?>
                <tr>
                  <td><strong><?= htmlspecialchars($lich['ma_lich']) ?></strong></td>
                  <td>
                    <div>
                      <div class="fw-bold"><?= htmlspecialchars($lich['ten_tour']) ?></div>
                      <small class="text-muted"><?= htmlspecialchars($lich['ngay_khoi_hanh']) ?> - <?= htmlspecialchars($lich['ngay_ket_thuc']) ?></small>
                    </div>
                  </td>
                  <td>
                    <div><?= date('d/m/Y', strtotime($lich['ngay_khoi_hanh'])) ?></div>
                    <small class="text-muted"><?= htmlspecialchars($lich['gio_khoi_hanh']) ?></small>
                  </td>
                  <td>
                    <span class="badge bg-info"><?= $lich['so_khach'] ?>/<?= $lich['so_khach_toi_da'] ?></span>
                  </td>
                  <td>
                    <?php if ($lich['trang_thai'] == 'Đã phân bổ'): ?>
                      <span class="badge bg-success"><?= htmlspecialchars($lich['trang_thai']) ?></span>
                    <?php else: ?>
                      <span class="badge bg-warning"><?= htmlspecialchars($lich['trang_thai']) ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <button class="btn btn-sm btn-outline-primary" title="Phân bổ nhân sự">
                        <i class="bi bi-people"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-info" title="Quản lý dịch vụ">
                        <i class="bi bi-gear"></i>
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
    'title' => 'Quản lý Lịch khởi hành - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý Lịch khởi hành',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'quanly'],
        ['label' => 'Lịch khởi hành', 'active' => true],
    ],
]);
?>