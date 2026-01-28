<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Quản lý Nhân sự</h3>
        <div class="card-tools">
          <a href="<?= BASE_URL ?>quanly" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Quay lại tổng quan
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>Mã HDV</th>
                <th>Họ tên</th>
                <th>Ngôn ngữ</th>
                <th>Chuyên môn</th>
                <th>Kinh nghiệm</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($hdvList as $hdv): ?>
                <tr>
                  <td><strong><?= htmlspecialchars($hdv['ma_hdv']) ?></strong></td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="rounded-circle me-2 bg-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; color: white; font-weight: bold;">
                        <?= strtoupper(substr($hdv['ho_ten'], 0, 1)) ?>
                      </div>
                      <div>
                        <div class="fw-bold"><?= htmlspecialchars($hdv['ho_ten']) ?></div>
                        <small class="text-muted"><?= htmlspecialchars($hdv['dien_thoai']) ?></small>
                      </div>
                    </div>
                  </td>
                  <td>
                    <?php foreach ($hdv['ngon_ngu'] as $lang): ?>
                      <span class="badge bg-info me-1"><?= htmlspecialchars($lang) ?></span>
                    <?php endforeach; ?>
                  </td>
                  <td><?= htmlspecialchars($hdv['nhom_hdv']) ?></td>
                  <td><?= htmlspecialchars($hdv['kinh_nghiem']) ?> năm</td>
                  <td><span class="badge bg-success"><?= htmlspecialchars($hdv['trang_thai']) ?></span></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button class="btn btn-sm btn-outline-info" title="Xem hồ sơ">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                        <i class="bi bi-pencil"></i>
                      </button>
                    </div>
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

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Quản lý Nhân sự - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý Nhân sự',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Quản lý Tour', 'url' => BASE_URL . 'quanly'],
        ['label' => 'Nhân sự', 'active' => true],
    ],
]);
?>