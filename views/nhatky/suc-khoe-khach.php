<?php ob_start(); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="bi bi-heart-pulse"></i> Theo dõi sức khỏe khách hàng</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>/nhatky/store">
                    <input type="hidden" name="loai_su_kien" value="suc_khoe">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Chọn Tour <span class="text-danger">*</span></label>
                                <select name="tour_id" class="form-select" required>
                                    <option value="">-- Chọn tour --</option>
                                    <?php if (!empty($tourList)): ?>
                                        <?php foreach ($tourList as $tour): ?>
                                            <option value="<?= $tour['id'] ?>">
                                                <?= htmlspecialchars($tour['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tình trạng <span class="text-danger">*</span></label>
                                <select name="muc_do_nghiem_trong" class="form-select" required>
                                    <option value="binh_thuong">Bình thường</option>
                                    <option value="luu_y">Cần lưu ý</option>
                                    <option value="quan_trong">Cần theo dõi</option>
                                    <option value="nghiem_trong">Cấp cứu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tên khách hàng <span class="text-danger">*</span></label>
                        <input type="text" name="tieu_de" class="form-control" required placeholder="Họ tên khách hàng">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Triệu chứng/Tình trạng <span class="text-danger">*</span></label>
                        <textarea name="noi_dung" class="form-control" rows="3" required placeholder="Mô tả triệu chứng, tình trạng sức khỏe..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Biện pháp xử lý</label>
                        <textarea name="ghi_chu" class="form-control" rows="3" placeholder="Cách xử lý, thuốc đã dùng, liên hệ y tế..."></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Ngày <span class="text-danger">*</span></label>
                                <input type="date" name="ngay_dien_bien" class="form-control" required value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Giờ</label>
                                <input type="time" name="gio_dien_bien" class="form-control" value="<?= date('H:i') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        <strong>Lưu ý:</strong> Với các trường hợp nghiêm trọng, hãy liên hệ ngay với cơ sở y tế gần nhất và thông báo cho quản lý.
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-heart-pulse"></i> Ghi nhận tình trạng
                        </button>
                        <a href="<?= BASE_URL ?>/nhatky" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Theo dõi sức khỏe khách - Website Quản Lý Tour',
    'pageTitle' => 'Theo dõi sức khỏe khách hàng',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Nhật ký Tour', 'url' => BASE_URL . 'nhatky'],
        ['label' => 'Sức khỏe khách', 'active' => true],
    ],
]);
?>