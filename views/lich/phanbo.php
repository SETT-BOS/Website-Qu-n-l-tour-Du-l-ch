<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Phân bổ nhân sự - <?= htmlspecialchars($lichKhoiHanh['ma_lich']) ?></h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <h5>Thông tin lịch khởi hành</h5>
            <table class="table table-sm">
              <tr><td><strong>Tour:</strong></td><td><?= htmlspecialchars($lichKhoiHanh['ten_tour']) ?></td></tr>
              <tr><td><strong>Ngày khởi hành:</strong></td><td><?= date('d/m/Y', strtotime($lichKhoiHanh['ngay_khoi_hanh'])) ?></td></tr>
              <tr><td><strong>Số khách:</strong></td><td><?= $lichKhoiHanh['so_khach'] ?> người</td></tr>
            </table>
          </div>
        </div>

        <form method="POST" action="<?= BASE_URL ?>lichkhoihanh/savePhanBo/<?= $lichKhoiHanh['id'] ?>">
          <div class="row">
            <!-- Phân bổ HDV -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5>Chọn Hướng dẫn viên</h5>
                </div>
                <div class="card-body">
                  <select name="hdv_id" class="form-select" required>
                    <option value="">-- Chọn HDV --</option>
                    <?php foreach ($hdvList as $hdv): ?>
                      <option value="<?= $hdv['id'] ?>">
                        <?= htmlspecialchars($hdv['ma_hdv']) ?> - <?= htmlspecialchars($hdv['ho_ten']) ?>
                        (<?= implode(', ', $hdv['ngon_ngu']) ?>)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <!-- Phân bổ Tài xế -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5>Chọn Tài xế</h5>
                </div>
                <div class="card-body">
                  <select name="tai_xe_id" class="form-select" required>
                    <option value="">-- Chọn tài xế --</option>
                    <?php foreach ($taiXeList as $taiXe): ?>
                      <option value="<?= $taiXe['id'] ?>">
                        <?= htmlspecialchars($taiXe['ma_tai_xe']) ?> - <?= htmlspecialchars($taiXe['ho_ten']) ?>
                        (Bằng <?= htmlspecialchars($taiXe['bang_lai']) ?>)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <!-- Phân bổ Xe -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5>Chọn Phương tiện</h5>
                </div>
                <div class="card-body">
                  <select name="xe_id" class="form-select" required>
                    <option value="">-- Chọn xe --</option>
                    <?php foreach ($xeList as $xe): ?>
                      <option value="<?= $xe['id'] ?>">
                        <?= htmlspecialchars($xe['bien_so']) ?> - <?= htmlspecialchars($xe['loai_xe']) ?>
                        (<?= $xe['so_cho'] ?> chỗ)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <!-- Phân bổ Khách sạn -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5>Chọn Khách sạn</h5>
                </div>
                <div class="card-body">
                  <select name="khach_san_id" class="form-select">
                    <option value="">-- Chọn khách sạn --</option>
                    <?php foreach ($khachSanList as $ks): ?>
                      <option value="<?= $ks['id'] ?>">
                        <?= htmlspecialchars($ks['ten_ks']) ?> - <?= htmlspecialchars($ks['dia_chi']) ?>
                        (<?= $ks['so_phong_trong'] ?> phòng trống)
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5>Ghi chú phân bổ</h5>
                </div>
                <div class="card-body">
                  <textarea name="ghi_chu" class="form-control" rows="3" placeholder="Ghi chú về việc phân bổ nhân sự và dịch vụ..."></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-3">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Lưu phân bổ
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
    'title' => 'Phân bổ nhân sự - Website Quản Lý Tour',
    'pageTitle' => 'Phân bổ nhân sự cho lịch khởi hành',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Lịch khởi hành', 'url' => BASE_URL . 'lichkhoihanh'],
        ['label' => 'Phân bổ nhân sự', 'active' => true],
    ],
]);
?>