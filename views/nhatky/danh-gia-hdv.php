<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Đánh giá HDV - <?= htmlspecialchars($hdv['ho_ten']) ?></h3>
      </div>
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-md-4">
            <div class="card bg-primary text-white">
              <div class="card-body text-center">
                <h2>4.6/5</h2>
                <p>Đánh giá trung bình</p>
                <div>
                  <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= 4.6): ?>
                      <i class="bi bi-star-fill"></i>
                    <?php else: ?>
                      <i class="bi bi-star"></i>
                    <?php endif; ?>
                  <?php endfor; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-success text-white">
              <div class="card-body text-center">
                <h2>15</h2>
                <p>Tổng số tour</p>
                <i class="bi bi-calendar-check fs-1"></i>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-info text-white">
              <div class="card-body text-center">
                <h2>98%</h2>
                <p>Tỷ lệ hài lòng</p>
                <i class="bi bi-emoji-smile fs-1"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Chi tiết đánh giá -->
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5>Phân tích đánh giá</h5>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>5 sao</span>
                    <span>60%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-success" style="width: 60%"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>4 sao</span>
                    <span>30%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-info" style="width: 30%"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>3 sao</span>
                    <span>8%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-warning" style="width: 8%"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>2 sao</span>
                    <span>2%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-danger" style="width: 2%"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>1 sao</span>
                    <span>0%</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-dark" style="width: 0%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5>Đánh giá theo tiêu chí</h5>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>Kiến thức chuyên môn</span>
                    <span>4.8/5</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-success" style="width: 96%"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>Thái độ phục vụ</span>
                    <span>4.7/5</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-info" style="width: 94%"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>Kỹ năng giao tiếp</span>
                    <span>4.5/5</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-primary" style="width: 90%"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>Xử lý tình huống</span>
                    <span>4.3/5</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-warning" style="width: 86%"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <span>Quản lý thời gian</span>
                    <span>4.1/5</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar bg-secondary" style="width: 82%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Lịch sử đánh giá -->
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>Lịch sử đánh giá theo tour</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Tour</th>
                        <th>Ngày</th>
                        <th>Đánh giá TB</th>
                        <th>Số đánh giá</th>
                        <th>Nhận xét nổi bật</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($danhGiaList as $danhGia): ?>
                        <tr>
                          <td><?= htmlspecialchars($danhGia['tour']) ?></td>
                          <td><?= date('d/m/Y', strtotime($danhGia['ngay'])) ?></td>
                          <td>
                            <div class="d-flex align-items-center">
                              <span class="me-2"><?= $danhGia['danh_gia_tb'] ?></span>
                              <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if ($i <= $danhGia['danh_gia_tb']): ?>
                                  <i class="bi bi-star-fill text-warning"></i>
                                <?php else: ?>
                                  <i class="bi bi-star text-muted"></i>
                                <?php endif; ?>
                              <?php endfor; ?>
                            </div>
                          </td>
                          <td><span class="badge bg-info"><?= $danhGia['so_danh_gia'] ?></span></td>
                          <td><?= htmlspecialchars($danhGia['nhan_xet']) ?></td>
                          <td>
                            <button class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                              <i class="bi bi-eye"></i>
                            </button>
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

        <!-- Kế hoạch cải thiện -->
        <div class="row mt-4">
          <div class="col-md-6">
            <div class="card border-success">
              <div class="card-header bg-success text-white">
                <h5><i class="bi bi-check-circle"></i> Điểm mạnh</h5>
              </div>
              <div class="card-body">
                <ul class="list-unstyled">
                  <li><i class="bi bi-plus-circle text-success"></i> Kiến thức chuyên môn vững vàng</li>
                  <li><i class="bi bi-plus-circle text-success"></i> Thái độ phục vụ nhiệt tình</li>
                  <li><i class="bi bi-plus-circle text-success"></i> Giao tiếp tốt với khách</li>
                  <li><i class="bi bi-plus-circle text-success"></i> Linh hoạt trong xử lý</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card border-warning">
              <div class="card-header bg-warning">
                <h5><i class="bi bi-exclamation-triangle"></i> Cần cải thiện</h5>
              </div>
              <div class="card-body">
                <ul class="list-unstyled">
                  <li><i class="bi bi-arrow-up-circle text-warning"></i> Quản lý thời gian chặt chẽ hơn</li>
                  <li><i class="bi bi-arrow-up-circle text-warning"></i> Chuẩn bị kỹ lưỡng hơn</li>
                  <li><i class="bi bi-arrow-up-circle text-warning"></i> Theo dõi sát sao khách hàng</li>
                </ul>
                <div class="mt-3">
                  <button class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Lập kế hoạch đào tạo
                  </button>
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
            <i class="bi bi-printer"></i> In báo cáo đánh giá
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Đánh giá HDV - Website Quản Lý Tour',
    'pageTitle' => 'Đánh giá HDV: ' . htmlspecialchars($hdv['ho_ten']),
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Nhật ký Tour', 'url' => BASE_URL . 'nhatky'],
        ['label' => 'Đánh giá HDV', 'active' => true],
    ],
]);
?>