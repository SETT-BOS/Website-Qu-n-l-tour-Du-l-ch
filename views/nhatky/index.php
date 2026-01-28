<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Nhật ký Tour</h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>nhatky/create" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tạo nhật ký mới
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
                      <a href="<?= BASE_URL ?>nhatky/view/<?= $nhatKy['id'] ?>" class="btn btn-sm btn-outline-info" title="Xem nhật ký">
                        <i class="bi bi-eye"></i>
                      </a>
                      <a href="<?= BASE_URL ?>nhatky/them-dien-bien/<?= $nhatKy['id'] ?>" class="btn btn-sm btn-outline-primary" title="Thêm diễn biến">
                        <i class="bi bi-plus-circle"></i>
                      </a>
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

<!-- Statistics Cards -->
<div class="row mt-4">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>15</h3>
        <p>Tổng nhật ký</p>
      </div>
      <div class="icon">
        <i class="bi bi-journal-text"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>8</h3>
        <p>Sự cố đã ghi nhận</p>
      </div>
      <div class="icon">
        <i class="bi bi-exclamation-triangle"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>4.6</h3>
        <p>Đánh giá TB HDV</p>
      </div>
      <div class="icon">
        <i class="bi bi-star-fill"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>3</h3>
        <p>Tour đang thực hiện</p>
      </div>
      <div class="icon">
        <i class="bi bi-play-circle"></i>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Nhật ký Tour - Website Quản Lý Tour',
    'pageTitle' => 'Nhật ký Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Nhật ký Tour', 'active' => true],
    ],
]);
?>