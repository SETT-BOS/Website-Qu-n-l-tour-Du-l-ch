<?php ob_start(); ?>

<div class="row mb-4 align-items-center">
    <div class="col-6">
        <h3 class="mb-0 fw-bold text-uppercase">Quản lý & Bán Tour</h3>
    </div>
    <div class="col-6 text-end">
        <?php if (isAdmin()): ?>
        <a href="<?= BASE_URL ?>tours/form" class="btn btn-success">
            <i class="bi bi-plus-circle-fill me-1"></i> Thêm Tour Mới
        </a>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <?php foreach ($tours as $tour): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold text-primary mb-0 text-truncate" style="max-width: 80%;" title="<?= htmlspecialchars($tour['name']) ?>">
                        <?= htmlspecialchars($tour['name']) ?>
                    </h5>
                    
                    <?php if (isAdmin()): ?>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="<?= BASE_URL ?>tours/form?id=<?= $tour['id'] ?>">
                                    <i class="bi bi-pencil-square text-warning me-2"></i>Sửa thông tin
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="<?= BASE_URL ?>tours/delete?id=<?= $tour['id'] ?>" onclick="return confirm('Xóa tour này sẽ mất vĩnh viễn?')">
                                    <i class="bi bi-trash-fill me-2"></i>Xóa Tour
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>

                <h4 class="text-danger fw-bold mb-3"><?= number_format($tour['price']) ?> VNĐ</h4>
                
                <p class="text-muted small mb-4">
                    <?= mb_strimwidth(strip_tags($tour['description']), 0, 100, "...") ?>
                </p>
                
                <a href="<?= BASE_URL ?>tours/detail?id=<?= $tour['id'] ?>" class="btn btn-primary w-100 py-2">
                    <i class="bi bi-cart-plus-fill me-2"></i> Tạo Booking Khách
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php 
$content = ob_get_clean();
view('layouts.AdminLayout', ['content' => $content, 'title' => 'Quản lý & Bán Tour']); 
?>