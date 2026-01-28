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
        <h3 class="card-title">Hồ sơ Hướng dẫn viên</h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>nhansu/edit/<?= $hdv['id'] ?>" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil"></i> Chỉnh sửa
          </a>
          <a href="<?= BASE_URL ?>nhansu" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Quay lại
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <!-- Avatar và thông tin cơ bản -->
          <div class="col-md-4">
            <div class="text-center">
              <?php if (!empty($hdv['anh_dai_dien'])): ?>
                <img src="<?= asset($hdv['anh_dai_dien']) ?>" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Avatar">
              <?php else: ?>
                <div class="rounded-circle mx-auto mb-3 bg-secondary d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; color: white; font-size: 48px; font-weight: bold;">
                  <?= strtoupper(substr($hdv['ho_ten'], 0, 1)) ?>
                </div>
              <?php endif; ?>
              <h4><?= htmlspecialchars($hdv['ho_ten']) ?></h4>
              <p class="text-muted"><?= htmlspecialchars($hdv['ma_hdv']) ?></p>
              <span class="badge bg-success fs-6"><?= htmlspecialchars($hdv['trang_thai']) ?></span>
            </div>
            
            <div class="mt-4">
              <h5>Thông tin liên hệ</h5>
              <ul class="list-unstyled">
                <li><i class="bi bi-telephone me-2"></i> <?= htmlspecialchars($hdv['dien_thoai']) ?></li>
                <li><i class="bi bi-envelope me-2"></i> <?= htmlspecialchars($hdv['email']) ?></li>
                <li><i class="bi bi-geo-alt me-2"></i> <?= htmlspecialchars($hdv['dia_chi']) ?></li>
              </ul>
            </div>
          </div>
          
          <!-- Thông tin chi tiết -->
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-6">
                <h5>Thông tin cá nhân</h5>
                <table class="table table-borderless">
                  <tr>
                    <td><strong>Ngày sinh:</strong></td>
                    <td><?= htmlspecialchars($hdv['ngay_sinh']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Giới tính:</strong></td>
                    <td><?= htmlspecialchars($hdv['gioi_tinh']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Nhóm HDV:</strong></td>
                    <td><?= htmlspecialchars($hdv['nhom_hdv']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Kinh nghiệm:</strong></td>
                    <td><?= htmlspecialchars($hdv['kinh_nghiem']) ?> năm</td>
                  </tr>
                </table>
              </div>
              
              <div class="col-md-6">
                <h5>Chuyên môn</h5>
                <div class="mb-3">
                  <strong>Ngôn ngữ:</strong><br>
                  <?php if (!empty($hdv['ngon_ngu'])): ?>
                    <?php foreach ($hdv['ngon_ngu'] as $lang): ?>
                      <span class="badge bg-info me-1"><?= htmlspecialchars($lang) ?></span>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
                
                <div class="mb-3">
                  <strong>Chứng chỉ:</strong><br>
                  <small><?= nl2br(htmlspecialchars($hdv['chung_chi'])) ?></small>
                </div>
                
                <div class="mb-3">
                  <strong>Tình trạng sức khỏe:</strong> <span class="badge bg-success"><?= htmlspecialchars($hdv['suc_khoe']) ?></span>
                </div>
              </div>
            </div>
            
            <div class="row mt-4">
              <div class="col-12">
                <h5>Ghi chú</h5>
                <p class="text-muted"><?= nl2br(htmlspecialchars($hdv['ghi_chu'])) ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Lịch sử tour -->
<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lịch sử dẫn tour</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Mã tour</th>
                <th>Tên tour</th>
                <th>Ngày khởi hành</th>
                <th>Số khách</th>
                <th>Đánh giá</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>T001</td>
                <td>Tour Nhật Bản 7N6Đ</td>
                <td>15/12/2023</td>
                <td>25 khách</td>
                <td>
                  <span class="text-warning">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                  </span>
                </td>
                <td><span class="badge bg-success">Hoàn thành</span></td>
              </tr>
              <tr>
                <td>T002</td>
                <td>Tour Pháp - Thụy Sĩ 10N9Đ</td>
                <td>01/11/2023</td>
                <td>18 khách</td>
                <td>
                  <span class="text-warning">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                  </span>
                </td>
                <td><span class="badge bg-success">Hoàn thành</span></td>
              </tr>
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
    'title' => 'Hồ sơ HDV - Website Quản Lý Tour',
    'pageTitle' => 'Hồ sơ Hướng dẫn viên',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Nhân sự', 'url' => BASE_URL . 'nhansu'],
        ['label' => 'Hồ sơ HDV', 'active' => true],
    ],
]);
?>