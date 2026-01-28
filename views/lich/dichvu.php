<?php ob_start(); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Quản lý dịch vụ - <?= htmlspecialchars($lichKhoiHanh['ma_lich']) ?></h3>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <h5>Thông tin tour</h5>
            <table class="table table-sm">
              <tr><td><strong>Tour:</strong></td><td><?= htmlspecialchars($lichKhoiHanh['ten_tour']) ?></td></tr>
              <tr><td><strong>Thời gian:</strong></td><td><?= date('d/m/Y', strtotime($lichKhoiHanh['ngay_khoi_hanh'])) ?> - <?= date('d/m/Y', strtotime($lichKhoiHanh['ngay_ket_thuc'])) ?></td></tr>
              <tr><td><strong>Số khách:</strong></td><td><?= $lichKhoiHanh['so_khach'] ?> người</td></tr>
            </table>
          </div>
        </div>

        <!-- Tabs cho các loại dịch vụ -->
        <ul class="nav nav-tabs" id="dichVuTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="khachsan-tab" data-bs-toggle="tab" data-bs-target="#khachsan" type="button">
              <i class="bi bi-building"></i> Khách sạn
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="nhahang-tab" data-bs-toggle="tab" data-bs-target="#nhahang" type="button">
              <i class="bi bi-cup-straw"></i> Nhà hàng
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="vemaybay-tab" data-bs-toggle="tab" data-bs-target="#vemaybay" type="button">
              <i class="bi bi-airplane"></i> Vé máy bay
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="diemthamquan-tab" data-bs-toggle="tab" data-bs-target="#diemthamquan" type="button">
              <i class="bi bi-camera"></i> Điểm tham quan
            </button>
          </li>
        </ul>

        <div class="tab-content mt-3" id="dichVuTabsContent">
          <!-- Tab Khách sạn -->
          <div class="tab-pane fade show active" id="khachsan" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
              <h5>Danh sách khách sạn đã đặt</h5>
              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#themKhachSanModal">
                <i class="bi bi-plus"></i> Đặt khách sạn
              </button>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Tên khách sạn</th>
                    <th>Ngày nhận phòng</th>
                    <th>Số phòng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Khách sạn Hạ Long Bay</td>
                    <td>15/02/2024</td>
                    <td>12 phòng</td>
                    <td><span class="badge bg-success">Đã đặt</span></td>
                    <td>
                      <button class="btn btn-sm btn-outline-warning">Sửa</button>
                      <button class="btn btn-sm btn-outline-danger">Hủy</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Tab Nhà hàng -->
          <div class="tab-pane fade" id="nhahang" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
              <h5>Danh sách nhà hàng đã đặt</h5>
              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#themNhaHangModal">
                <i class="bi bi-plus"></i> Đặt nhà hàng
              </button>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Tên nhà hàng</th>
                    <th>Ngày/Bữa ăn</th>
                    <th>Số suất</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Nhà hàng Hải sản Hạ Long</td>
                    <td>15/02/2024 - Trưa</td>
                    <td>25 suất</td>
                    <td><span class="badge bg-warning">Chờ xác nhận</span></td>
                    <td>
                      <button class="btn btn-sm btn-outline-warning">Sửa</button>
                      <button class="btn btn-sm btn-outline-danger">Hủy</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Tab Vé máy bay -->
          <div class="tab-pane fade" id="vemaybay" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
              <h5>Danh sách vé máy bay</h5>
              <button class="btn btn-primary btn-sm">
                <i class="bi bi-plus"></i> Đặt vé máy bay
              </button>
            </div>
            <div class="alert alert-info">
              <i class="bi bi-info-circle"></i> Chưa có vé máy bay nào được đặt cho tour này.
            </div>
          </div>

          <!-- Tab Điểm tham quan -->
          <div class="tab-pane fade" id="diemthamquan" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
              <h5>Danh sách điểm tham quan</h5>
              <button class="btn btn-primary btn-sm">
                <i class="bi bi-plus"></i> Thêm điểm tham quan
              </button>
            </div>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Tên điểm</th>
                    <th>Ngày tham quan</th>
                    <th>Giá vé/người</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Vịnh Hạ Long</td>
                    <td>15/02/2024</td>
                    <td>200,000 VNĐ</td>
                    <td>5,000,000 VNĐ</td>
                    <td><span class="badge bg-success">Đã đặt</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="mt-3">
          <a href="<?= BASE_URL ?>lichkhoihanh" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Quản lý dịch vụ - Website Quản Lý Tour',
    'pageTitle' => 'Quản lý dịch vụ cho lịch khởi hành',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Lịch khởi hành', 'url' => BASE_URL . 'lichkhoihanh'],
        ['label' => 'Quản lý dịch vụ', 'active' => true],
    ],
]);
?>