<?php ob_start(); ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-graph-up"></i> Báo cáo nhật ký Tour</h2>
            <button class="btn btn-success" onclick="window.print()">
                <i class="bi bi-printer"></i> In báo cáo
            </button>
        </div>

        <!-- Thống kê tổng quan -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <h3><?= $thongKe['tong_nhat_ky'] ?? 0 ?></h3>
                        <p>Tổng nhật ký</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h3><?= $thongKe['su_co'] ?? 0 ?></h3>
                        <p>Sự cố</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <h3><?= $thongKe['phan_hoi'] ?? 0 ?></h3>
                        <p>Phản hồi khách</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h3><?= number_format($thongKe['danh_gia_tb'] ?? 0, 1) ?>/5</h3>
                        <p>Đánh giá TB</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sự cố nghiêm trọng -->
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h5><i class="bi bi-exclamation-triangle"></i> Sự cố cần chú ý</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Tour</th>
                                <th>Sự cố</th>
                                <th>Mức độ</th>
                                <th>Xử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($suCoNghiemTrong as $sc): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($sc['ngay_dien_bien'])) ?></td>
                                <td><?= htmlspecialchars($sc['tour_name']) ?></td>
                                <td><?= htmlspecialchars($sc['tieu_de']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $sc['muc_do_nghiem_trong'] === 'nghiem_trong' ? 'danger' : 'warning' ?>">
                                        <?= ucfirst($sc['muc_do_nghiem_trong']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars(substr($sc['ghi_chu'], 0, 50)) ?>...</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kinh nghiệm rút ra -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5><i class="bi bi-lightbulb"></i> Kinh nghiệm rút ra</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Vấn đề thường gặp:</h6>
                        <ul>
                            <li>Thời tiết bất lợi (<?= $thongKe['thoi_tiet'] ?? 0 ?> lần)</li>
                            <li>Sự cố xe cộ (<?= $thongKe['xe_co'] ?? 0 ?> lần)</li>
                            <li>Vấn đề sức khỏe khách (<?= $thongKe['suc_khoe'] ?? 0 ?> lần)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Giải pháp hiệu quả:</h6>
                        <ul>
                            <li>Chuẩn bị phương án dự phòng</li>
                            <li>Tăng cường kiểm tra xe trước khởi hành</li>
                            <li>Mang theo thuốc y tế cơ bản</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="<?= BASE_URL ?>/nhatky" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại
            </a>
        </div>
<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Báo cáo nhật ký - Website Quản Lý Tour',
    'pageTitle' => 'Báo cáo nhật ký Tour',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Nhật ký Tour', 'url' => BASE_URL . 'nhatky'],
        ['label' => 'Báo cáo', 'active' => true],
    ],
]);
?>