<?php ob_start(); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 fw-bold"><?= $title ?></h4>
            </div>
            <form action="<?= BASE_URL ?>tours/save" method="POST">
                <input type="hidden" name="id" value="<?= $tour['id'] ?? '' ?>">

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên Tour <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" 
                               value="<?= $tour['name'] ?? '' ?>" 
                               placeholder="Ví dụ: Tour Đà Nẵng 3 ngày 2 đêm" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Giá tiền (VNĐ) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control" 
                               value="<?= $tour['price'] ?? '' ?>" 
                               placeholder="Nhập số tiền..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="5" 
                                  placeholder="Mô tả lịch trình tour..."><?= $tour['description'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="card-footer bg-white text-end py-3">
                    <a href="<?= BASE_URL ?>tours" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary fw-bold">
                        <i class="bi bi-save"></i> Lưu dữ liệu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
view('layouts.AdminLayout', ['content' => $content, 'title' => $title]); 
?>