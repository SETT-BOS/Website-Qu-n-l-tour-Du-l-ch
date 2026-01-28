<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tạo nhật ký tour mới</h3>
      </div>
      <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>nhatky/store">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Chọn Tour <span class="text-danger">*</span></label>
                <select name="tour_id" class="form-select" required>
                  <option value="">-- Chọn tour --</option>
                  <?php foreach ($tourList as $tour): ?>
                    <option value="<?= $tour['id'] ?>">
                      <?= htmlspecialchars($tour['ma_tour']) ?> - <?= htmlspecialchars($tour['ten_tour']) ?>
                      (HDV: <?= htmlspecialchars($tour['hdv']) ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="trang_thai" class="form-select">
                  <option value="Chuẩn bị">Chuẩn bị</option>
                  <option value="Đang thực hiện">Đang thực hiện</option>
                  <option value="Hoàn thành">Hoàn thành</option>
                </select>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Ghi chú ban đầu</label>
            <textarea name="ghi_chu_ban_dau" class="form-control" rows="3" placeholder="Ghi chú về chuẩn bị, kế hoạch tour..."></textarea>
          </div>

          <div class="mt-3">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Tạo nhật ký
            </button>
            <a href="<?= BASE_URL ?>nhatky" class="btn btn-secondary">
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
    'title' => 'Tạo nhật ký - Website Quản Lý Tour',
    'pageTitle' => 'Tạo nhật ký tour mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Nhật ký Tour', 'url' => BASE_URL . 'nhatky'],
        ['label' => 'Tạo mới', 'active' => true],
    ],
]);
?>