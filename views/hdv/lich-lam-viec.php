<?php
$title = 'Lịch Làm Việc HDV';
$pageTitle = 'Lịch Làm Việc HDV';
$breadcrumb = [
    ['label' => 'HDV', 'url' => BASE_URL . 'hdv/lich-lam-viec'],
    ['label' => 'Lịch Làm Việc', 'active' => true]
];

ob_start();
?>

<!-- Thông tin nhanh -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <span class="badge bg-info fs-6">Hôm nay: <?= date('d/m/Y') ?></span>
    </div>
</div>
<!-- Thống kê nhanh -->
<div class="row mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3><?= count($lichLamViec) ?></h3>
                <p>Tổng Tour</p>
            </div>
            <div class="small-box-icon">
                <i class="bi bi-calendar-event"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3><?= count(array_filter($lichLamViec, fn($item) => $item['trang_thai'] === 'confirmed')) ?></h3>
                <p>Đã Xác Nhận</p>
            </div>
            <div class="small-box-icon">
                <i class="bi bi-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3><?= count(array_filter($lichLamViec, fn($item) => $item['trang_thai'] === 'pending')) ?></h3>
                <p>Chờ Xác Nhận</p>
            </div>
            <div class="small-box-icon">
                <i class="bi bi-clock"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-info">
            <div class="inner">
                <h3><?= array_sum(array_column($lichLamViec, 'so_khach')) ?></h3>
                <p>Tổng Khách</p>
            </div>
            <div class="small-box-icon">
                <i class="bi bi-people"></i>
            </div>
        </div>
    </div>
</div>
<!-- Bảng lịch làm việc -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="bi bi-list-ul"></i> Danh Sách Tour Được Phân Công</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Tour</th>
                        <th>Ngày Khởi Hành</th>
                        <th>Ngày Kết Thúc</th>
                        <th>Số Khách</th>
                        <th>Trạng Thái</th>
                        <th>Ghi Chú</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lichLamViec as $index => $tour): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <strong><?= $tour['tour_name'] ?></strong>
                        </td>
                        <td>
                            <i class="bi bi-calendar-date text-success"></i>
                            <?= date('d/m/Y', strtotime($tour['ngay_khoi_hanh'])) ?>
                        </td>
                        <td>
                            <i class="bi bi-calendar-date text-danger"></i>
                            <?= date('d/m/Y', strtotime($tour['ngay_ket_thuc'])) ?>
                        </td>
                        <td>
                            <span class="badge text-bg-info"><?= $tour['so_khach'] ?> người</span>
                        </td>
                        <td>
                            <?php if ($tour['trang_thai'] === 'confirmed'): ?>
                                <span class="badge text-bg-success">Đã Xác Nhận</span>
                            <?php else: ?>
                                <span class="badge text-bg-warning">Chờ Xác Nhận</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $tour['ghi_chu'] ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?= BASE_URL ?>hdv/chi-tiet-tour?id=<?= $tour['id'] ?>" 
                                   class="btn btn-sm btn-info" title="Chi tiết">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= BASE_URL ?>hdv/diem-danh?tour_id=<?= $tour['id'] ?>" 
                                   class="btn btn-sm btn-primary" title="Điểm danh">
                                    <i class="bi bi-check2-square"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layouts/AdminLayout.php';
?>