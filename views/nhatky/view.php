<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Nhật ký Tour - <?= htmlspecialchars($nhatKy['ma_tour']) ?></h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>nhatky/them-dien-bien/<?= $nhatKy['id'] ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Thêm diễn biến
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <table class="table table-sm">
              <tr><td><strong>Tour:</strong></td><td><?= htmlspecialchars($nhatKy['tour']) ?></td></tr>
              <tr><td><strong>HDV:</strong></td><td><?= htmlspecialchars($nhatKy['hdv']) ?></td></tr>
              <tr><td><strong>Thời gian:</strong></td><td><?= date('d/m/Y', strtotime($nhatKy['ngay_bat_dau'])) ?> - <?= date('d/m/Y', strtotime($nhatKy['ngay_ket_thuc'])) ?></td></tr>
              <tr><td><strong>Trạng thái:</strong></td><td><span class="badge bg-success"><?= htmlspecialchars($nhatKy['trang_thai']) ?></span></td></tr>
            </table>
          </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="nhatKyTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="dienbien-tab" data-bs-toggle="tab" data-bs-target="#dienbien" type="button">
              <i class="bi bi-clock-history"></i> Diễn biến Tour
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="phanhoi-tab" data-bs-toggle="tab" data-bs-target="#phanhoi" type="button">
              <i class="bi bi-chat-dots"></i> Phản hồi khách hàng
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="danhgia-tab" data-bs-toggle="tab" data-bs-target="#danhgia" type="button">
              <i class="bi bi-star"></i> Đánh giá HDV
            </button>
          </li>
        </ul>

        <div class="tab-content mt-3" id="nhatKyTabsContent">
          <!-- Tab Diễn biến -->
          <div class="tab-pane fade show active" id="dienbien" role="tabpanel">
            <div class="timeline">
              <?php foreach ($dienBien as $db): ?>
                <div class="timeline-item">
                  <div class="timeline-marker">
                    <?php
                    $iconClass = match($db['loai']) {
                        'Thời tiết' => 'bi-cloud-rain text-info',
                        'Sự cố' => 'bi-exclamation-triangle text-warning',
                        'Sức khỏe' => 'bi-heart-pulse text-danger',
                        'Hoạt động' => 'bi-camera text-success',
                        default => 'bi-info-circle text-secondary'
                    };
                    ?>
                    <i class="bi <?= $iconClass ?>"></i>
                  </div>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between">
                      <h6><?= htmlspecialchars($db['loai']) ?></h6>
                      <small class="text-muted"><?= date('d/m/Y', strtotime($db['ngay'])) ?> - <?= $db['gio'] ?></small>
                    </div>
                    <p><?= htmlspecialchars($db['noi_dung']) ?></p>
                    <small class="text-muted">Ghi bởi: <?= htmlspecialchars($db['nguoi_ghi']) ?></small>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Tab Phản hồi -->
          <div class="tab-pane fade" id="phanhoi" role="tabpanel">
            <div class="row">
              <?php foreach ($phanHoi as $ph): ?>
                <div class="col-md-6 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between mb-2">
                        <h6><?= htmlspecialchars($ph['khach_hang']) ?></h6>
                        <div>
                          <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php if ($i <= $ph['danh_gia']): ?>
                              <i class="bi bi-star-fill text-warning"></i>
                            <?php else: ?>
                              <i class="bi bi-star text-muted"></i>
                            <?php endif; ?>
                          <?php endfor; ?>
                        </div>
                      </div>
                      <p class="card-text"><?= htmlspecialchars($ph['noi_dung']) ?></p>
                      <small class="text-muted"><?= date('d/m/Y', strtotime($ph['ngay_danh_gia'])) ?></small>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Tab Đánh giá HDV -->
          <div class="tab-pane fade" id="danhgia" role="tabpanel">
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h5>Tổng kết đánh giá</h5>
                  </div>
                  <div class="card-body">
                    <div class="text-center mb-3">
                      <h2 class="text-warning">4.5/5</h2>
                      <div>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                          <?php if ($i <= 4.5): ?>
                            <i class="bi bi-star-fill text-warning fs-4"></i>
                          <?php else: ?>
                            <i class="bi bi-star text-muted fs-4"></i>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </div>
                      <p class="text-muted">Dựa trên <?= count($phanHoi) ?> đánh giá</p>
                    </div>
                    <div class="mb-2">
                      <div class="d-flex justify-content-between">
                        <span>Chuyên môn</span>
                        <span>4.8/5</span>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-success" style="width: 96%"></div>
                      </div>
                    </div>
                    <div class="mb-2">
                      <div class="d-flex justify-content-between">
                        <span>Thái độ phục vụ</span>
                        <span>4.6/5</span>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-info" style="width: 92%"></div>
                      </div>
                    </div>
                    <div class="mb-2">
                      <div class="d-flex justify-content-between">
                        <span>Xử lý tình huống</span>
                        <span>4.2/5</span>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-warning" style="width: 84%"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h5>Nhận xét nổi bật</h5>
                  </div>
                  <div class="card-body">
                    <div class="alert alert-success">
                      <strong>Điểm mạnh:</strong>
                      <ul class="mb-0">
                        <li>HDV nhiệt tình, am hiểu</li>
                        <li>Xử lý tình huống linh hoạt</li>
                        <li>Thái độ phục vụ tốt</li>
                      </ul>
                    </div>
                    <div class="alert alert-warning">
                      <strong>Cần cải thiện:</strong>
                      <ul class="mb-0">
                        <li>Quản lý thời gian chặt chẽ hơn</li>
                        <li>Chuẩn bị kỹ hơn cho thời tiết xấu</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-3">
          <a href="<?= BASE_URL ?>nhatky" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
          </a>
          <button class="btn btn-info">
            <i class="bi bi-printer"></i> In nhật ký
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.timeline {
  position: relative;
  padding-left: 30px;
}
.timeline-item {
  position: relative;
  margin-bottom: 20px;
  padding-left: 20px;
}
.timeline-marker {
  position: absolute;
  left: -35px;
  top: 5px;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: white;
  border: 2px solid #dee2e6;
  display: flex;
  align-items: center;
  justify-content: center;
}
.timeline-item:not(:last-child)::before {
  content: '';
  position: absolute;
  left: -26px;
  top: 25px;
  width: 2px;
  height: calc(100% + 10px);
  background: #dee2e6;
}
.timeline-content {
  background: #f8f9fa;
  padding: 15px;
  border-radius: 8px;
  border-left: 4px solid #007bff;
}
</style>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Chi tiết nhật ký - Website Quản Lý Tour',
    'pageTitle' => 'Chi tiết nhật ký Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Nhật ký Tour', 'url' => BASE_URL . 'nhatky'],
        ['label' => 'Chi tiết', 'active' => true],
    ],
]);
?>