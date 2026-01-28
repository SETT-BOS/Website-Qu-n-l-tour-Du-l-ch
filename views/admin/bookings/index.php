<?php ob_start(); ?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title mb-0">
            <i class="bi bi-list-check me-2"></i>Quản lý Đơn hàng
        </h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th style="min-width: 250px;">Thông tin Khách hàng</th>
                    <th>Tour đăng ký</th>
                    <th>Chi tiết</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $b): ?>
                    <?php 
                        // Giải mã JSON để lấy tên và SĐT
                        $info = json_decode($b['service_detail'], true);
                        
                        $name = !empty($info['name']) ? $info['name'] : 'Khách vãng lai';
                        $phone = !empty($info['phone']) ? $info['phone'] : 'Không có SĐT';
                        
                        // Tạo avatar dựa trên tên khách
                        $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random&color=fff&size=128";
                    ?>
                <tr>
                    <td>#<?= $b['id'] ?></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?= $avatarUrl ?>" alt="Avatar" class="rounded-circle me-3 shadow-sm" width="50" height="50">
                            
                            <div>
                                <p class="fw-bold mb-0 text-dark fs-6"><?= htmlspecialchars($name) ?></p>
                                <small class="text-muted">
                                    <i class="bi bi-telephone-fill me-1 text-success"></i>
                                    <?= htmlspecialchars($phone) ?>
                                </small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-info text-dark">
                            <?= htmlspecialchars($b['tour_name']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="small text-muted">
                            <div><i class="bi bi-people me-1"></i> <b><?= $info['people'] ?? 1 ?></b> người</div>
                            <div class="text-danger fw-bold"><i class="bi bi-cash me-1"></i> <?= number_format($info['total'] ?? 0) ?> đ</div>
                            <?php if(!empty($b['notes'])): ?>
                                <div class="fst-italic mt-1 text-warning"><i class="bi bi-chat-quote me-1"></i>Note: <?= htmlspecialchars($b['notes']) ?></div>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <form action="<?= BASE_URL ?>booking/update-status" method="POST">
                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                            <select name="status" class="form-select form-select-sm border-0 fw-bold shadow-none" 
                                    onchange="this.form.submit()"
                                    style="width: 140px; background-color: <?= $b['status'] == 2 ? '#d1e7dd' : ($b['status'] == 3 ? '#cfe2ff' : '#fff3cd') ?>">
                                <option value="1" <?= $b['status'] == 1 ? 'selected' : '' ?>>Chờ duyệt</option>
                                <option value="2" <?= $b['status'] == 2 ? 'selected' : '' ?>>Đã cọc</option>
                                <option value="3" <?= $b['status'] == 3 ? 'selected' : '' ?>>Hoàn tất</option>
                                <option value="4" <?= $b['status'] == 4 ? 'selected' : '' ?>>Hủy đơn</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="<?= BASE_URL ?>booking/delete?id=<?= $b['id'] ?>" 
                           class="btn btn-outline-danger btn-sm"
                           onclick="return confirm('Bạn chắc chắn muốn xóa đơn này?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
$content = ob_get_clean();
view('layouts.AdminLayout', [
    'content' => $content, 
    'title' => 'Quản lý Booking',
    'pageTitle' => 'Danh sách Đơn hàng'
]); 
?>