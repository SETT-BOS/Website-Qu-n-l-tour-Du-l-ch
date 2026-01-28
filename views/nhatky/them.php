<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm diễn biến - Website Quản lý Tour</title>
    <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Thêm diễn biến mới</h2>
        
        <form method="POST" class="mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tour_id" class="form-label">Tour *</label>
                        <select class="form-select" id="tour_id" name="tour_id" required>
                            <option value="">Chọn tour</option>
                            <?php foreach ($tours as $tour): ?>
                            <option value="<?= $tour['id'] ?>"><?= htmlspecialchars($tour['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tieu_de" class="form-label">Tiêu đề *</label>
                        <input type="text" class="form-control" id="tieu_de" name="tieu_de" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="noi_dung" class="form-label">Nội dung *</label>
                <textarea class="form-control" id="noi_dung" name="noi_dung" rows="4" required></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="ngay_dien_bien" class="form-label">Ngày diễn biến *</label>
                        <input type="date" class="form-control" id="ngay_dien_bien" name="ngay_dien_bien" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="gio_dien_bien" class="form-label">Giờ diễn biến</label>
                        <input type="time" class="form-control" id="gio_dien_bien" name="gio_dien_bien">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="dia_diem" class="form-label">Địa điểm</label>
                        <input type="text" class="form-control" id="dia_diem" name="dia_diem">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="ghi_chu" class="form-label">Ghi chú</label>
                <textarea class="form-control" id="ghi_chu" name="ghi_chu" rows="3"></textarea>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Lưu diễn biến</button>
                <a href="/website_quan_ly_tour/nhatky" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
    
    <script src="<?= asset('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>