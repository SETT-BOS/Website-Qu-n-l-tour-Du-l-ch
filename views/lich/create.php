<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tạo lịch khởi hành mới</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>lichkhoihanh/store">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Chọn Tour <span class="text-danger">*</span></label>
                <select name="tour_id" class="form-select" required>
                  <option value="">-- Chọn tour --</option>
                  <?php foreach ($tours as $tour): ?>
                    <option value="<?= $tour['id'] ?>"><?= htmlspecialchars($tour['ten_tour']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Mã lịch khởi hành <span class="text-danger">*</span></label>
                <input type="text" name="ma_lich" class="form-control" value="LKH<?= date('ymd') . rand(100, 999) ?>" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Ngày khởi hành <span class="text-danger">*</span></label>
                <input type="date" name="ngay_khoi_hanh" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Giờ khởi hành <span class="text-danger">*</span></label>
                <input type="time" name="gio_khoi_hanh" class="form-control" value="07:00" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                <input type="date" name="ngay_ket_thuc" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Số khách tối đa <span class="text-danger">*</span></label>
                <input type="number" name="so_khach_toi_da" class="form-control" min="1" max="50" value="30" required>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Điểm tập trung <span class="text-danger">*</span></label>
            <textarea name="diem_tap_trung" class="form-control" rows="2" placeholder="Nhập địa chỉ điểm tập trung chi tiết..." required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Ghi chú</label>
            <textarea name="ghi_chu" class="form-control" rows="3" placeholder="Ghi chú thêm về lịch khởi hành..."></textarea>
          </div>

          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="auto_phan_bo" id="autoPhanBo">
              <label class="form-check-label" for="autoPhanBo">
                Tự động chuyển đến phân bổ nhân sự sau khi tạo
              </label>
            </div>
          </div>

          <div class="mt-3">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Tạo lịch khởi hành
            </button>
            <a href="<?= BASE_URL ?>lichkhoihanh" class="btn btn-secondary">
              <i class="bi bi-arrow-left"></i> Quay lại
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Tạo lịch khởi hành - Website Quản Lý Tour',
    'pageTitle' => 'Tạo lịch khởi hành mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Lịch khởi hành', 'url' => BASE_URL . 'lichkhoihanh'],
        ['label' => 'Tạo mới', 'active' => true],
    ],
]);
?>