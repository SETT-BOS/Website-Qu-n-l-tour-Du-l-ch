<?php
ob_start();
?>

<?php if (!empty($success)): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($success) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Quản lý Hướng dẫn viên (HDV)</h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>nhansu/create" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Thêm HDV mới
          </a>
        </div>
      </div>
      <div class="card-body">
        <!-- Filter -->
        <div class="row mb-3">
          <div class="col-md-3">
            <select class="form-select">
              <option>Tất cả nhóm</option>
              <option>HDV nội địa</option>
              <option>HDV quốc tế</option>
              <option>Chuyên tuyến</option>
              <option>Chuyên khách đoàn</option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option>Tất cả trạng thái</option>
              <option>Rảnh</option>
              <option>Bận</option>
              <option>Nghỉ phép</option>
            </select>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Tìm kiếm theo tên, ngôn ngữ...">
          </div>
          <div class="col-md-2">
            <button class="btn btn-outline-secondary">Tìm kiếm</button>
          </div>
        </div>
        
        <!-- HDV List -->
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>Mã HDV</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Ngôn ngữ</th>
                <th>Chuyên môn</th>
                <th>Kinh nghiệm</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($hdvList)): ?>
                <?php foreach ($hdvList as $hdv): ?>
                  <tr>
                    <td><strong><?= htmlspecialchars($hdv['ma_hdv']) ?></strong></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <?php if (!empty($hdv['anh_dai_dien'])): ?>
                          <img src="<?= asset($hdv['anh_dai_dien']) ?>" class="rounded-circle me-2" alt="Avatar" style="width: 40px; height: 40px; object-fit: cover;">
                        <?php else: ?>
                          <div class="rounded-circle me-2 bg-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; color: white; font-weight: bold;">
                            <?= strtoupper(substr($hdv['ho_ten'], 0, 1)) ?>
                          </div>
                        <?php endif; ?>
                        <div>
                          <div class="fw-bold"><?= htmlspecialchars($hdv['ho_ten']) ?></div>
                          <small class="text-muted"><?= htmlspecialchars($hdv['dien_thoai']) ?></small>
                        </div>
                      </div>
                    </td>
                    <td><?= htmlspecialchars($hdv['ngay_sinh']) ?></td>
                    <td>
                      <?php if (!empty($hdv['ngon_ngu'])): ?>
                        <?php foreach ($hdv['ngon_ngu'] as $lang): ?>
                          <span class="badge bg-info me-1"><?= htmlspecialchars($lang) ?></span>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($hdv['nhom_hdv']) ?></td>
                    <td><?= htmlspecialchars($hdv['kinh_nghiem']) ?> năm</td>
                    <td><span class="badge bg-success"><?= htmlspecialchars($hdv['trang_thai']) ?></span></td>
                    <td>
                      <div class="btn-group" role="group">
                        <a href="<?= BASE_URL ?>nhansu/view/<?= $hdv['id'] ?>" class="btn btn-sm btn-outline-info" title="Xem hồ sơ">
                          <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?= BASE_URL ?>nhansu/edit/<?= $hdv['id'] ?>" class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                          <i class="bi bi-pencil"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
              <tr>
                <td><strong>HDV001</strong></td>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="<?= asset('dist/assets/img/avatar.png') ?>" class="rounded-circle me-2" alt="Avatar" style="width: 40px; height: 40px; object-fit: cover;">
                    <div>
                      <div class="fw-bold">Nguyễn Văn A</div>
                      <small class="text-muted">0901234567</small>
                    </div>
                  </div>
                </td>
                <td>15/03/1985</td>
                <td>
                  <span class="badge bg-info me-1">Tiếng Anh</span>
                  <span class="badge bg-info">Tiếng Nhật</span>
                </td>
                <td>Tour quốc tế</td>
                <td>8 năm</td>
                <td><span class="badge bg-success">Rảnh</span></td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="<?= BASE_URL ?>nhansu/view/1" class="btn btn-sm btn-outline-info" title="Xem hồ sơ">
                      <i class="bi bi-eye"></i>
                    </a>
                    <a href="<?= BASE_URL ?>nhansu/edit/1" class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <a href="<?= BASE_URL ?>nhansu/history/1" class="btn btn-sm btn-outline-primary" title="Lịch sử tour">
                      <i class="bi bi-calendar"></i>
                    </a>
                  </div>
                </td>
              </tr>
              <tr>
                <td><strong>HDV002</strong></td>
                <td>
                  <div class="d-flex align-items-center">
                    <img src="<?= asset('dist/assets/img/avatar2.png') ?>" class="rounded-circle me-2" alt="Avatar" style="width: 40px; height: 40px; object-fit: cover;">
                    <div>
                      <div class="fw-bold">Trần Thị B</div>
                      <small class="text-muted">0987654321</small>
                    </div>
                  </div>
                </td>
                <td>22/08/1990</td>
                <td>
                  <span class="badge bg-info me-1">Tiếng Anh</span>
                  <span class="badge bg-info">Tiếng Hàn</span>
                </td>
                <td>Tour nội địa</td>
                <td>5 năm</td>
                <td><span class="badge bg-warning">Bận</span></td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="<?= BASE_URL ?>nhansu/view/2" class="btn btn-sm btn-outline-info" title="Xem hồ sơ">
                      <i class="bi bi-eye"></i>
                    </a>
                    <a href="<?= BASE_URL ?>nhansu/edit/2" class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <a href="<?= BASE_URL ?>nhansu/history/2" class="btn btn-sm btn-outline-primary" title="Lịch sử tour">
                      <i class="bi bi-calendar"></i>
                    </a>
                  </div>
                </td>
              </tr>
              <?php endif; ?>
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
        <p>Tổng HDV</p>
      </div>
      <div class="icon">
        <i class="bi bi-people"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>8</h3>
        <p>HDV rảnh</p>
      </div>
      <div class="icon">
        <i class="bi bi-check-circle"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>5</h3>
        <p>HDV bận</p>
      </div>
      <div class="icon">
        <i class="bi bi-clock"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>2</h3>
        <p>Nghỉ phép</p>
      </div>
      <div class="icon">
        <i class="bi bi-calendar-x"></i>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Quản lý Nhân sự - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý Hướng dẫn viên (HDV)',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Nhân sự', 'active' => true],
    ],
]);
?>