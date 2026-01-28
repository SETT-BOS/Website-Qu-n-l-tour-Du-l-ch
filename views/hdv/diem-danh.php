<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Điểm Danh Khách Hàng' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white p-3">
                <h5><i class="bi bi-person-badge"></i> HDV Panel</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= BASE_URL ?>hdv/lich-lam-viec">
                            <i class="bi bi-calendar-check"></i> Lịch Làm Việc
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="<?= BASE_URL ?>hdv/diem-danh">
                            <i class="bi bi-check2-square"></i> Điểm Danh
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= BASE_URL ?>hdv/yeu-cau-dac-biet">
                            <i class="bi bi-exclamation-triangle"></i> Yêu Cầu Đặc Biệt
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= BASE_URL ?>home">
                            <i class="bi bi-house"></i> Trang Chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= BASE_URL ?>logout">
                            <i class="bi bi-box-arrow-right"></i> Đăng Xuất
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-check2-square text-primary"></i> Điểm Danh Khách Hàng</h2>
                    <div>
                        <a href="<?= BASE_URL ?>hdv/lich-lam-viec" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Quay Lại
                        </a>
                    </div>
                </div>
                
                <!-- Thông tin tour -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5><i class="bi bi-info-circle"></i> Thông Tin Tour</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Tên Tour:</strong> Tour Hà Nội - Hạ Long 3N2Đ</p>
                                <p><strong>Ngày Khởi Hành:</strong> 15/02/2024</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Tổng Số Khách:</strong> <?= count($danhSachKhach) ?> người</p>
                                <p><strong>Đã Check-in:</strong> <?= count(array_filter($danhSachKhach, fn($k) => $k['check_in'])) ?> người</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Thống kê nhanh -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <h5><i class="bi bi-people"></i> Tổng Khách</h5>
                                <h3><?= count($danhSachKhach) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h5><i class="bi bi-check-circle"></i> Đã Check-in</h5>
                                <h3><?= count(array_filter($danhSachKhach, fn($k) => $k['check_in'])) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h5><i class="bi bi-x-circle"></i> Chưa Check-in</h5>
                                <h3><?= count(array_filter($danhSachKhach, fn($k) => !$k['check_in'])) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <h5><i class="bi bi-percent"></i> Tỷ Lệ</h5>
                                <h3><?= round((count(array_filter($danhSachKhach, fn($k) => $k['check_in'])) / count($danhSachKhach)) * 100) ?>%</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Danh sách khách hàng -->
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-list-check"></i> Danh Sách Khách Hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ Tên</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Email</th>
                                        <th>Trạng Thái</th>
                                        <th>Thời Gian Check-in</th>
                                        <th>Ghi Chú</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($danhSachKhach as $index => $khach): ?>
                                    <tr class="<?= $khach['check_in'] ? 'table-success' : 'table-warning' ?>">
                                        <td><?= $index + 1 ?></td>
                                        <td>
                                            <strong><?= $khach['ho_ten'] ?></strong>
                                        </td>
                                        <td>
                                            <i class="bi bi-telephone"></i> <?= $khach['so_dien_thoai'] ?>
                                        </td>
                                        <td>
                                            <i class="bi bi-envelope"></i> <?= $khach['email'] ?>
                                        </td>
                                        <td>
                                            <?php if ($khach['check_in']): ?>
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle"></i> Đã Check-in
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-x-circle"></i> Chưa Check-in
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($khach['thoi_gian_check_in']): ?>
                                                <small class="text-muted">
                                                    <?= date('H:i d/m/Y', strtotime($khach['thoi_gian_check_in'])) ?>
                                                </small>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $khach['ghi_chu'] ?></td>
                                        <td>
                                            <form method="POST" action="<?= BASE_URL ?>hdv/cap-nhat-check-in" class="d-inline">
                                                <input type="hidden" name="khach_id" value="<?= $khach['id'] ?>">
                                                <input type="hidden" name="tour_id" value="<?= $tourId ?>">
                                                <input type="hidden" name="check_in" value="<?= $khach['check_in'] ? 0 : 1 ?>">
                                                <input type="hidden" name="ghi_chu" value="<?= $khach['check_in'] ? 'Hủy check-in' : 'Check-in thành công' ?>">
                                                
                                                <?php if ($khach['check_in']): ?>
                                                    <button type="submit" class="btn btn-sm btn-warning" title="Hủy check-in">
                                                        <i class="bi bi-x-circle"></i> Hủy
                                                    </button>
                                                <?php else: ?>
                                                    <button type="submit" class="btn btn-sm btn-success" title="Check-in">
                                                        <i class="bi bi-check-circle"></i> Check-in
                                                    </button>
                                                <?php endif; ?>
                                            </form>
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
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>