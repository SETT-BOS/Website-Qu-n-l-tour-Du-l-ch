<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thêm ghi chú đặc biệt</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>ghichu/store">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Chọn khách hàng <span class="text-danger">*</span></label>
                <select name="khach_hang_id" class="form-select" required>
                  <option value="">-- Chọn khách hàng --</option>
                  <?php foreach ($khachHangList as $khach): ?>
                    <option value="<?= $khach['id'] ?>">
                      <?= htmlspecialchars($khach['ho_ten']) ?> - <?= htmlspecialchars($khach['tour']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Loại ghi chú <span class="text-danger">*</span></label>
                <select name="loai_ghi_chu" class="form-select" required>
                  <option value="">-- Chọn loại --</option>
                  <option value="Ăn uống">Ăn uống</option>
                  <option value="Sức khỏe">Sức khỏe</option>
                  <option value="Phòng nghỉ">Phòng nghỉ</option>
                  <option value="Di chuyển">Di chuyển</option>
                  <option value="Khác">Khác</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Mức độ quan trọng <span class="text-danger">*</span></label>
                <select name="muc_do" class="form-select" required>
                  <option value="">-- Chọn mức độ --</option>
                  <option value="Rất quan trọng">Rất quan trọng</option>
                  <option value="Quan trọng">Quan trọng</option>
                  <option value="Bình thường">Bình thường</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="trang_thai" class="form-select">
                  <option value="Chưa xử lý">Chưa xử lý</option>
                  <option value="Đã xử lý">Đã xử lý</option>
                </select>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Nội dung ghi chú <span class="text-danger">*</span></label>
            <textarea name="noi_dung" class="form-control" rows="4" placeholder="Mô tả chi tiết yêu cầu đặc biệt của khách hàng..." required></textarea>
            <div class="form-text">
              Ví dụ: Ăn chay trường, dị ứng hải sản, bệnh tim, sợ độ cao, cần phòng tầng thấp...
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Ghi chú xử lý</label>
            <textarea name="ghi_chu_xu_ly" class="form-control" rows="2" placeholder="Cách thức xử lý hoặc lưu ý cho nhân viên..."></textarea>
          </div>

          <!-- Quick Templates -->
          <div class="mb-3">
            <label class="form-label">Mẫu ghi chú nhanh</label>
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h6>Ăn uống</h6>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-1" onclick="setTemplate('Ăn chay trường, không ăn hành tỏi')">Ăn chay</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-1" onclick="setTemplate('Dị ứng hải sản, không ăn tôm cua')">Dị ứng hải sản</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-1" onclick="setTemplate('Không ăn cay, dạ dày yếu')">Không ăn cay</button>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h6>Sức khỏe</h6>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-1" onclick="setTemplate('Bệnh tim, cần tránh hoạt động mạnh')">Bệnh tim</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-1" onclick="setTemplate('Tiểu đường, cần ăn đúng giờ')">Tiểu đường</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary mb-1" onclick="setTemplate('Say xe, cần ghế đầu xe')">Say xe</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-3">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Lưu ghi chú
            </button>
            <a href="<?= BASE_URL ?>ghichu" class="btn btn-secondary">
              <i class="bi bi-arrow-left"></i> Quay lại
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function setTemplate(text) {
  document.querySelector('textarea[name="noi_dung"]').value = text;
}
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Thêm ghi chú - Website Quản Lý Tour',
    'pageTitle' => 'Thêm ghi chú đặc biệt',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Ghi chú đặc biệt', 'url' => BASE_URL . 'ghichu'],
        ['label' => 'Thêm mới', 'active' => true],
    ],
]);
?>