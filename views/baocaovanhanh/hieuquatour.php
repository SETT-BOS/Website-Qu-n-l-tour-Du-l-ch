<?php layout('AdminLayout', ['title' => $title]); ?>

<?php
// Hàm tránh lỗi null với htmlspecialchars
function safe($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Đảm bảo $tourStats là array
$tourStats = is_array($tourStats) ? $tourStats : [];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Báo cáo hiệu quả tour</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>?act=baocao">Báo cáo</a></li>
                    <li class="breadcrumb-item active">Hiệu quả tour</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Bộ lọc tháng -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" class="row">
                        <div class="col-md-6">
                            <label>Chọn tháng:</label>
                            <input type="month" name="thang" class="form-control" value="<?= safe($thang) ?>">
                        </div>
                        <div class="col-md-6">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary form-control">Xem báo cáo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bảng -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>So sánh hiệu quả các tour tháng <?= date('m/Y', strtotime($thang)) ?></h5>
                </div>
                <div class="card-body">
                    <?php if (empty($tourStats)): ?>
                        <p class="text-center text-muted">Không có dữ liệu cho tháng này.</p>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Tên tour</th>
                                <th>Số lượt đặt</th>
                                <th>Tỷ lệ hủy</th>
                                <th>Doanh thu</th>
                                <th>Đánh giá TB</th>
                                <th>Tỷ lệ lấp đầy</th>
                                <th>Hiệu quả</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($tourStats as $stat): ?>
                                <?php
                                    $tenTour = safe($stat['ten_tour'] ?? 'Không rõ');
                                    $soBooking = $stat['so_booking'] ?? 0;
                                    $tyLeHuy = $stat['ty_le_huy'] ?? 0;
                                    $doanhThu = $stat['doanh_thu'] ?? 0;
                                    $danhGia = $stat['danh_gia_tb'] ?? 0;
                                    $lapDay = $stat['ty_le_lap_day'] ?? 0;
                                    $diemHQ = $stat['diem_hieu_qua'] ?? 0;
                                ?>
                                <tr>
                                    <td><?= $tenTour ?></td>
                                    <td><?= $soBooking ?></td>
                                    <td>
                                        <span class="badge <?= $tyLeHuy > 10 ? 'badge-danger' : 'badge-success' ?>">
                                            <?= number_format($tyLeHuy, 1) ?>%
                                        </span>
                                    </td>
                                    <td><?= number_format($doanhThu) ?> VNĐ</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span><?= number_format($danhGia, 1) ?></span>
                                            <div class="ml-2">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <span class="<?= $i <= $danhGia ? 'text-warning' : 'text-muted' ?>">★</span>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar 
                                                <?= $lapDay > 80 ? 'bg-success' : ($lapDay > 50 ? 'bg-warning' : 'bg-danger') ?>"
                                                style="width: <?= $lapDay ?>%">
                                                <?= number_format($lapDay, 1) ?>%
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php 
                                            if ($diemHQ >= 80) {
                                                $hq = 'Cao';
                                                $cls = 'badge-success';
                                            } elseif ($diemHQ >= 60) {
                                                $hq = 'Trung bình';
                                                $cls = 'badge-warning';
                                            } else {
                                                $hq = 'Thấp';
                                                $cls = 'badge-danger';
                                            }
                                        ?>
                                        <span class="badge <?= $cls ?>"><?= $hq ?> (<?= $diemHQ ?>)</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
