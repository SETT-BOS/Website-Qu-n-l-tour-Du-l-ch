<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Quản lý Nhật ký Tour</h3>
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
                <th>Tour</th>
                <th>HDV</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Sự cố</th>
                <th>Đánh giá TB</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($nhatKyList as $nhatKy): ?>
                <tr>
                  <td>
                    <div class="fw-bold"><?= htmlspecialchars($nhatKy['tour']) ?></div>
                    <small class="text-muted"><?= htmlspecialchars($nhatKy['ma_tour']) ?></small>
                  </td>
                  <td><?= htmlspecialchars($nhatKy['hdv']) ?></td>
                  <td>
                    <div><?= date('d/m/Y', strtotime($nhatKy['ngay_bat_dau'])) ?></div>
                    <small class="text-muted">đến <?= date('d/m/Y', strtotime($nhatKy['ngay_ket_thuc'])) ?></small>
                  </td>
                  <td>
                    <?php if ($nhatKy['trang_thai'] == 'Hoàn thành'): ?>
                      <span class="badge bg-success"><?= htmlspecialchars($nhatKy['trang_thai']) ?></span>
                    <?php else: ?>
                      <span class="badge bg-primary"><?= htmlspecialchars($nhatKy['trang_thai']) ?></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($nhatKy['so_su_co'] > 0): ?>
                      <span class="badge bg-warning"><?= $nhatKy['so_su_co'] ?> sự cố</span>
                    <?php else: ?>
                      <span class="badge bg-success">Không có</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($nhatKy['danh_gia_tb']): ?>
                      <div class="d-flex align-items-center">
                        <span class="me-1"><?= $nhatKy['danh_gia_tb'] ?></span>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <?php if ($i <= $nhatKy['danh_gia_tb']): ?>
                            <i class="bi bi-star-fill text-warning"></i>
                          <?php else: ?>
                            <i class="bi bi-star text-muted"></i>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </div>
                    <?php else: ?>
                      <span class="text-muted">Chưa có</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <button class="btn btn-sm btn-outline-info" title="Xem nhật ký">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-primary" title="Thêm diễn biến">
                        <i class="bi bi-plus-circle"></i>
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
    'title' => 'Quản lý Nhật ký - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý Nhật ký Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'quanly'],
        ['label' => 'Nhật ký Tour', 'active' => true],
    ],
]);
?>