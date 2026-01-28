<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Phân phòng khách sạn - <?= htmlspecialchars($booking['ma_booking']) ?></h3>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <table class="table table-sm">
              <tr><td><strong>Tour:</strong></td><td><?= htmlspecialchars($booking['ten_tour']) ?></td></tr>
              <tr><td><strong>Khách sạn:</strong></td><td><?= htmlspecialchars($booking['khach_san']) ?></td></tr>
            </table>
          </div>
        </div>

        <form method="POST" action="<?= BASE_URL ?>booking/savePhanPhong/<?= $booking['id'] ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5>Danh sách khách</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>Khách hàng</th>
                          <th>Phòng hiện tại</th>
                          <th>Phòng mới</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($khachHang as $khach): ?>
                          <tr>
                            <td>
                              <div class="fw-bold"><?= htmlspecialchars($khach['ho_ten']) ?></div>
                              <small class="text-muted"><?= htmlspecialchars($khach['gioi_tinh']) ?></small>
                            </td>
                            <td>
                              <span class="badge bg-info"><?= htmlspecialchars($khach['phong_hien_tai']) ?></span>
                            </td>
                            <td>
                              <select name="phong[<?= $khach['id'] ?>]" class="form-select form-select-sm">
                                <option value="<?= htmlspecialchars($khach['phong_hien_tai']) ?>"><?= htmlspecialchars($khach['phong_hien_tai']) ?> (hiện tại)</option>
                                <?php foreach ($phongTrong as $phong): ?>
                                  <option value="<?= htmlspecialchars($phong['so_phong']) ?>">
                                    <?= htmlspecialchars($phong['so_phong']) ?> - <?= htmlspecialchars($phong['loai_phong']) ?>
                                  </option>
                                <?php endforeach; ?>
                              </select>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5>Phòng trống có sẵn</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>Số phòng</th>
                          <th>Loại phòng</th>
                          <th>Giường</th>
                          <th>Trạng thái</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($phongTrong as $phong): ?>
                          <tr>
                            <td><strong><?= htmlspecialchars($phong['so_phong']) ?></strong></td>
                            <td><?= htmlspecialchars($phong['loai_phong']) ?></td>
                            <td><?= htmlspecialchars($phong['giuong']) ?></td>
                            <td><span class="badge bg-success">Trống</span></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5>Ghi chú phân phòng</h5>
                </div>
                <div class="card-body">
                  <textarea name="ghi_chu" class="form-control" rows="3" placeholder="Ghi chú về việc phân phòng..."></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-3">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-circle"></i> Lưu phân phòng
            </button>
            <a href="<?= BASE_URL ?>booking/danhsach/<?= $booking['id'] ?>" class="btn btn-secondary">
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
    'title' => 'Phân phòng khách sạn - Website Quản Lý Tour',
    'pageTitle' => 'Phân phòng khách sạn',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Booking', 'url' => BASE_URL . 'booking'],
        ['label' => 'Phân phòng', 'active' => true],
    ],
]);
?>