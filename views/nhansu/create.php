<?php
ob_start();
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thêm Hướng dẫn viên mới</h3>
      </div>
      <form action="<?= BASE_URL ?>nhansu/store" method="POST" enctype="multipart/form-data">
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
                <input type="text" class="form-control" name="ho_ten" value="<?= htmlspecialchars($oldData['ho_ten'] ?? '') ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" name="ngay_sinh" value="<?= htmlspecialchars($oldData['ngay_sinh'] ?? '') ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <select class="form-select" name="gioi_tinh">
                  <option value="Nam">Nam</option>
                  <option value="Nữ">Nữ</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="tel" class="form-control" name="dien_thoai">
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <textarea class="form-control" name="dia_chi" rows="3"></textarea>
              </div>
            </div>
            
            <!-- Thông tin chuyên môn -->
            <div class="col-md-6">
              <h5 class="mb-3">Thông tin chuyên môn</h5>
              <div class="mb-3">
                <label class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control" name="anh_dai_dien" accept="image/*">
              </div>
              <div class="mb-3">
                <label class="form-label">Nhóm HDV</label>
                <select class="form-select" name="nhom_hdv">
                  <option value="noi_dia">HDV nội địa</option>
                  <option value="quoc_te">HDV quốc tế</option>
                  <option value="chuyen_tuyen">Chuyên tuyến</option>
                  <option value="chuyen_khach_doan">Chuyên khách đoàn</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Ngôn ngữ sử dụng</label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_viet" checked>
                  <label class="form-check-label">Tiếng Việt</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_anh">
                  <label class="form-check-label">Tiếng Anh</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_nhat">
                  <label class="form-check-label">Tiếng Nhật</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_han">
                  <label class="form-check-label">Tiếng Hàn</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="ngon_ngu[]" value="tieng_phap">
                  <label class="form-check-label">Tiếng Pháp</label>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Kinh nghiệm (năm)</label>
                <input type="number" class="form-control" name="kinh_nghiem" min="0">
              </div>
              <div class="mb-3">
                <label class="form-label">Chứng chỉ chuyên môn</label>
                <textarea class="form-control" name="chung_chi" rows="3" placeholder="Liệt kê các chứng chỉ, bằng cấp..."></textarea>
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
                  <option value="tot">Tốt</option>
                  <option value="binh_thuong">Bình thường</option>
                  <option value="can_chu_y">Cần chú ý</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Trạng thái làm việc</label>
                <select class="form-select" name="trang_thai">
                  <option value="ranh">Rảnh</option>
                  <option value="ban">Bận</option>
                  <option value="nghi_phep">Nghỉ phép</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Ghi chú</label>
                <textarea class="form-control" name="ghi_chu" rows="4" placeholder="Ghi chú thêm về HDV..."></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Lưu thông tin
          </button>
          <a href="<?= BASE_URL ?>nhansu" class="btn btn-secondary">
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
    'title' => 'Thêm HDV mới - Website Quản Lý Tour',
    'pageTitle' => 'Thêm Hướng dẫn viên mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Nhân sự', 'url' => BASE_URL . 'nhansu'],
        ['label' => 'Thêm mới', 'active' => true],
    ],
]);
?>