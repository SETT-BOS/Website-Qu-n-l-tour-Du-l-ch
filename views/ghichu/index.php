<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Ghi chú đặc biệt của khách hàng</h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>ghichu/create" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Thêm ghi chú
          </a>
        </div>
      </div>
      <div class="card-body">
        <!-- Filter -->
        <div class="row mb-3">
          <div class="col-md-3">
            <select class="form-select">
              <option>Tất cả loại</option>
              <option>Ăn uống</option>
              <option>Sức khỏe</option>
              <option>Phòng nghỉ</option>
              <option>Di chuyển</option>
              <option>Khác</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option>Tất cả mức độ</option>
              <option>Rất quan trọng</option>
              <option>Quan trọng</option>
              <option>Bình thường</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option>Tất cả trạng thái</option>
              <option>Chưa xử lý</option>
              <option>Đã xử lý</option>
            </select>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Tìm theo tên khách...">
          </div>
        </div>
        
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>Khách hàng</th>
                <th>Tour</th>
                <th>Loại ghi chú</th>
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
                    <div class="fw-bold"><?= htmlspecialchars($ghiChu['ho_ten']) ?></div>
                    <small class="text-muted">ID: <?= $ghiChu['khach_hang_id'] ?></small>
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
                      <a href="<?= BASE_URL ?>ghichu/khachhang/<?= $ghiChu['khach_hang_id'] ?>" class="btn btn-sm btn-outline-primary" title="Tất cả ghi chú của khách">
                        <i class="bi bi-person-lines-fill"></i>
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
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>5</h3>
        <p>Rất quan trọng</p>
      </div>
      <div class="icon">
        <i class="bi bi-exclamation-triangle-fill"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>8</h3>
        <p>Chưa xử lý</p>
      </div>
      <div class="icon">
        <i class="bi bi-clock"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>12</h3>
        <p>Sức khỏe</p>
      </div>
      <div class="icon">
        <i class="bi bi-heart-pulse"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>25</h3>
        <p>Tổng ghi chú</p>
      </div>
      <div class="icon">
        <i class="bi bi-journal-text"></i>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Ghi chú đặc biệt - Website Quản Lý Tour',
    'pageTitle' => 'Ghi chú đặc biệt của khách hàng',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Ghi chú đặc biệt', 'active' => true],
    ],
]);
?>