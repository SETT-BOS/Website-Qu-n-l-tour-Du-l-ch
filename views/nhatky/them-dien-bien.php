<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Thêm diễn biến Tour - <?= htmlspecialchars($nhatKy['ma_tour']) ?></h3>
      </div>
      <div class="card-body">
        <form method="POST" action="<?= BASE_URL ?>nhatky/storeDienBien/<?= $nhatKy['id'] ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Ngày <span class="text-danger">*</span></label>
                <input type="date" name="ngay" class="form-control" value="<?= date('Y-m-d') ?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Giờ <span class="text-danger">*</span></label>
                <input type="time" name="gio" class="form-control" value="<?= date('H:i') ?>" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Loại diễn biến <span class="text-danger">*</span></label>
                <select name="loai" class="form-select" required onchange="showTemplates(this.value)">
                  <option value="">-- Chọn loại --</option>
                  <option value="Thời tiết">Thời tiết</option>
                  <option value="Sự cố">Sự cố</option>
                  <option value="Sức khỏe">Sức khỏe khách</option>
                  <option value="Hoạt động">Hoạt động đặc biệt</option>
                  <option value="Giao thông">Giao thông</option>
                  <option value="Khác">Khác</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Mức độ nghiêm trọng</label>
                <select name="muc_do" class="form-select">
                  <option value="Thông tin">Thông tin</option>
                  <option value="Lưu ý">Lưu ý</option>
                  <option value="Quan trọng">Quan trọng</option>
                  <option value="Nghiêm trọng">Nghiêm trọng</option>
                </select>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Nội dung diễn biến <span class="text-danger">*</span></label>
            <textarea name="noi_dung" id="noiDung" class="form-control" rows="4" placeholder="Mô tả chi tiết diễn biến..." required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Cách xử lý</label>
            <textarea name="cach_xu_ly" class="form-control" rows="3" placeholder="Mô tả cách xử lý tình huống (nếu có)..."></textarea>
          </div>

          <!-- Templates nhanh -->
          <div class="mb-3">
            <label class="form-label">Mẫu nhanh</label>
            <div id="templates" class="row" style="display: none;">
              <!-- Templates sẽ được hiển thị bằng JavaScript -->
            </div>
          </div>

          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="thong_bao_quan_ly" id="thongBaoQuanLy">
              <label class="form-check-label" for="thongBaoQuanLy">
                Thông báo ngay cho quản lý (dành cho sự cố nghiêm trọng)
              </label>
            </div>
          </div>

          <div class="mt-3">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Lưu diễn biến
            </button>
            <a href="<?= BASE_URL ?>nhatky/view/<?= $nhatKy['id'] ?>" class="btn btn-secondary">
              <i class="bi bi-arrow-left"></i> Quay lại
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
const templates = {
  'Thời tiết': [
    'Trời nắng đẹp, thuận lợi cho tham quan',
    'Mưa nhẹ, đã chuẩn bị áo mưa cho khách',
    'Gió mạnh, hạn chế hoạt động ngoài trời',
    'Sương mù dày, hạn chế tầm nhìn'
  ],
  'Sự cố': [
    'Xe bị hỏng, đã liên hệ xe dự phòng',
    'Khách bị mất đồ, đã hỗ trợ tìm kiếm',
    'Nhà hàng không đủ chỗ, đã đổi địa điểm',
    'Điểm tham quan đóng cửa bất ngờ'
  ],
  'Sức khỏe': [
    'Khách bị say xe, đã hỗ trợ thuốc',
    'Khách bị dị ứng thức ăn, đã đưa đến y tế',
    'Khách bị ngã, đã sơ cứu và theo dõi',
    'Khách có triệu chứng cảm cúm'
  ],
  'Hoạt động': [
    'Tổ chức sinh nhật cho khách',
    'Khách tự tổ chức hoạt động team building',
    'Tham gia lễ hội địa phương',
    'Chụp ảnh kỷ niệm tập thể'
  ]
};

function showTemplates(loai) {
  const templatesDiv = document.getElementById('templates');
  if (templates[loai]) {
    templatesDiv.style.display = 'block';
    templatesDiv.innerHTML = templates[loai].map(template => 
      `<div class="col-md-6 mb-2">
        <button type="button" class="btn btn-outline-secondary btn-sm w-100" onclick="setTemplate('${template}')">
          ${template}
        </button>
      </div>`
    ).join('');
  } else {
    templatesDiv.style.display = 'none';
  }
}

function setTemplate(text) {
  document.getElementById('noiDung').value = text;
}
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Thêm diễn biến - Website Quản Lý Tour',
    'pageTitle' => 'Thêm diễn biến Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Nhật ký Tour', 'url' => BASE_URL . 'nhatky'],
        ['label' => 'Thêm diễn biến', 'active' => true],
    ],
]);
?>