<?php
// views/baocaovanhanh/index.php

layout('AdminLayout', ['title' => $title ?? 'Báo cáo vận hành tour']);

/**
 * Helper functions
 */
function safe($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function to_int($v, $default = 0) {
    if ($v === null || $v === '' || !is_numeric($v)) return $default;
    return (int)$v;
}

function to_float($v, $default = 0.0) {
    if ($v === null || $v === '' || !is_numeric($v)) return $default;
    return (float)$v;
}

function format_currency($num) {
    $n = to_float($num, 0.0);
    return number_format($n, 0, ',', '.');
}

function format_money_label($num) {
    return format_currency($num) . ' VNĐ';
}

/*
 * ----------- IMPORTANT: safe defaults if controller didn't pass variables ----------
 * Use isset() so referencing undefined variables does NOT raise a notice.
 */
$summary = (isset($summary) && is_array($summary)) ? $summary : [];
$topTours = (isset($topTours) && is_array($topTours)) ? $topTours : [];
$month = isset($month) ? $month : date('Y-m');

// Tổng quan (dùng dữ liệu summary nếu có, nếu không dùng mặc định)
$totalTours = to_int($summary['total_tours'] ?? null, 0);
$totalBookings = to_int($summary['total_bookings'] ?? null, 0);
$thisMonthRevenue = to_float($summary['revenue'] ?? null, 0.0);
$popularCount = to_int($summary['popular_tours'] ?? null, 0);

?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="mt-3">Trang chủ</h1>
            <h4 class="mb-4">Báo cáo vận hành tour</h4>
        </div>
    </div>

    <!-- Cards tổng quan -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h6>Tổng số tour</h6>
                    <h3><?= $totalTours ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white" style="background-color:#1b8f73">
                <div class="card-body">
                    <h6>Tổng booking</h6>
                    <h3><?= $totalBookings ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white" style="background-color:#16aaff">
                <div class="card-body">
                    <h6>Doanh thu tháng</h6>
                    <h3><?= format_money_label($thisMonthRevenue) ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white" style="background-color:#f4b400">
                <div class="card-body">
                    <h6>Tour phổ biến</h6>
                    <h3><?= $popularCount ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Ba ô chức năng -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-light">
                <div class="card-body">
                    <h5>Báo cáo doanh thu</h5>
                    <p class="text-muted">Doanh thu, chi phí, lợi nhuận theo tour</p>
                    <a href="<?= BASE_URL ?>baocao/doanhthu" class="btn btn-primary">Xem báo cáo</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-light">
                <div class="card-body">
                    <h5>Hiệu quả tour</h5>
                    <p class="text-muted">So sánh hiệu quả các tour theo thời gian</p>
                    <a href="<?= BASE_URL ?>baocao/hieuquatour" class="btn btn-success">Xem báo cáo</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-light">
                <div class="card-body">
                    <h5>Thống kê khách hàng</h5>
                    <p class="text-muted">Phân tích hành vi & sở thích khách hàng</p>
                    <a href="<?= BASE_URL ?>baocao/khachhang" class="btn btn-info">Xem báo cáo</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Top 5 tour phổ biến -->
    <div class="row">
        <div class="col-12">
            <div class="card border-light">
                <div class="card-header">
                    <strong>Top 5 tour phổ biến nhất</strong>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($topTours)): ?>
                        <div class="p-3 text-center text-muted">Không có dữ liệu tour</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Tên tour</th>
                                        <th class="text-center">Số lượt đặt</th>
                                        <th class="text-right">Doanh thu</th>
                                        <th class="text-center">Đánh giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($topTours as $t): ?>
                                        <?php
                                            $name = safe($t['name'] ?? $t['ten_tour'] ?? 'Không rõ');
                                            $bookings = to_int($t['bookings'] ?? $t['so_booking'] ?? 0, 0);
                                            $revenue = to_float($t['revenue'] ?? $t['doanh_thu'] ?? 0.0, 0.0);
                                            $rating = to_float($t['rating'] ?? $t['danh_gia'] ?? $t['danh_gia_tb'] ?? 0.0, 0.0);
                                        ?>
                                        <tr>
                                            <td><?= $name ?></td>
                                            <td class="text-center"><?= $bookings ?></td>
                                            <td class="text-right"><?= format_money_label($revenue) ?></td>
                                            <td class="text-center">
                                                <?= number_format($rating, 1) ?>/5
                                                <span class="ml-1">
                                                    <?php
                                                        $fullStars = floor($rating);
                                                        for ($i=1;$i<=5;$i++) {
                                                            echo $i <= $fullStars ? '★' : '☆';
                                                        }
                                                    ?>
                                                </span>
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

    <div class="row mt-4 mb-5">
        <div class="col-12 text-center text-muted">
            <small>Copyright © <?= date('Y') ?>. All rights reserved.</small>
        </div>
    </div>
</div>
