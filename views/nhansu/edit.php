<?php
ob_start();
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Chỉnh sửa thông tin HDV</h3>
      </div>
      <form action="<?= BASE_URL ?>nhansu/update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $hdv['id'] ?>">
        <div class="card-body">
          <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
              <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                  <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
          
          <div class="row">
            <!-- Thông tin cơ bản -->
            <div class="col-md-6">
              <h5 class="mb-3">Thông tin cơ bản</h5>
              <div class="mb-3">
                <label class="form-label">Họ tên *</label>
                <input type="text" class="form-control" name="ho_ten" value="<?= htmlspecialchars($hdv['ho_ten']) ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" name="ngay_sinh" value="<?= htmlspecialchars($hdv['ngay_sinh']) ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <select class="form-select" name="gioi_tinh">
                  <option value="Nam" <?= $hdv['gioi_tinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                  <option value="Nữ" <?= $hdv['gioi_tinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" name="dien_thoai" value="<?= htmlspecialchars($hdv['dien_thoai']) ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($hdv['email']) ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <textarea class="form-control" name="dia_chi" rows="3"><?= htmlspecialchars($hdv['dia_chi']) ?></textarea>
              </div>
            </div>
            
            <!-- Thông tin chuyên môn -->
            <div class="col-md-6">
              <h5 class="mb-3">Thông tin chuyên môn</h5>
              <div class="mb-3">
                <label class="form-label">Ảnh đại diện</label>
                <?php if (!empty($hdv['anh_dai_dien'])): ?>
                  <div class="mb-2">
                    <img src="<?= asset($hdv['anh_dai_dien']) ?>" class="rounded" style="width: 80px; height: 80px; object-fit: cover;" alt="Current Avatar">
                    <small class="d-block text-muted">Ảnh hiện tại</small>
                  </div>
                <?php endif; ?>
                <input type="file" class="form-control" name="anh_dai_dien" accept="image/*">
                <small class="text-muted">Để trống nếu không muốn thay đổi</small>
              </div>
              <div class="mb-3">
                <label class="form-label">Nhóm HDV</label>
                <select class="form-select" name="nhom_hdv">
                  <option value="noi_dia" <?= $hdv['nhom_hdv'] == 'noi_dia' ? 'selected' : '' ?>>HDV nội địa</option>
                  <option value="quoc_te" <?= $hdv['nhom_hdv'] == 'quoc_te' ? 'selected' : '' ?>>HDV quốc tế</option>
                  <option value="chuyen_tuyen" <?= $hdv['nhom_hdv'] == 'chuyen_tuyen' ? 'selected' : '' ?>>Chuyên tuyến</option>
                  <option value="chuyen_khach_doan" <?= $hdv['nhom_hdv'] == 'chuyen_khach_doan' ? 'selected' : '' ?>>Chuyên khách đoàn</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Ngôn ngữ sử dụng</label>
                <?php $ngonNgu = $hdv['ngon_ngu'] ?? []; ?>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_viet" <?= in_array('tieng_viet', $ngonNgu) ? 'checked' : '' ?>>
                  <label class="form-check-label">Tiếng Việt</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_anh" <?= in_array('tieng_anh', $ngonNgu) ? 'checked' : '' ?>>
                  <label class="form-check-label">Tiếng Anh</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_nhat" <?= in_array('tieng_nhat', $ngonNgu) ? 'checked' : '' ?>>
                  <label class="form-check-label">Tiếng Nhật</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_han" <?= in_array('tieng_han', $ngonNgu) ? 'checked' : '' ?>>
                  <label class="form-check-label">Tiếng Hàn</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_phap" <?= in_array('tieng_phap', $ngonNgu) ? 'checked' : '' ?>>
                  <label class="form-check-label">Tiếng Pháp</label>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Kinh nghiệm (năm)</label>
                <input type="number" class="form-control" name="kinh_nghiem" min="0" value="<?= htmlspecialchars($hdv['kinh_nghiem']) ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Chứng chỉ chuyên môn</label>
                <textarea class="form-control" name="chung_chi" rows="3"><?= htmlspecialchars($hdv['chung_chi']) ?></textarea>
              </div>
            </div>
          </div>
          
          <!-- Thông tin bổ sung -->
          <div class="row mt-4">
            <div class="col-12">
              <h5 class="mb-3">Thông tin bổ sung</h5>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Tình trạng sức khỏe</label>
                <select class="form-select" name="suc_khoe">
                  <option value="tot" <?= $hdv['suc_khoe'] == 'tot' ? 'selected' : '' ?>>Tốt</option>
                  <option value="binh_thuong" <?= $hdv['suc_khoe'] == 'binh_thuong' ? 'selected' : '' ?>>Bình thường</option>
                  <option value="can_chu_y" <?= $hdv['suc_khoe'] == 'can_chu_y' ? 'selected' : '' ?>>Cần chú ý</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Trạng thái làm việc</label>
                <select class="form-select" name="trang_thai">
                  <option value="ranh" <?= $hdv['trang_thai'] == 'ranh' ? 'selected' : '' ?>>Rảnh</option>
                  <option value="ban" <?= $hdv['trang_thai'] == 'ban' ? 'selected' : '' ?>>Bận</option>
                  <option value="nghi_phep" <?= $hdv['trang_thai'] == 'nghi_phep' ? 'selected' : '' ?>>Nghỉ phép</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Ghi chú</label>
                <textarea class="form-control" name="ghi_chu" rows="4"><?= htmlspecialchars($hdv['ghi_chu']) ?></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Cập nhật thông tin
          </button>
          <a href="<?= BASE_URL ?>nhansu/view/<?= $hdv['id'] ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Chỉnh sửa HDV - Website Quản Lý Tour',
    'pageTitle' => 'Chỉnh sửa thông tin HDV',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Nhân sự', 'url' => BASE_URL . 'nhansu'],
        ['label' => 'Chỉnh sửa HDV', 'active' => true],
    ],
]);
?>