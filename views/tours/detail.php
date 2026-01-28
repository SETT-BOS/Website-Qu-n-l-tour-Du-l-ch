<?php ob_start(); ?>

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h4><?= htmlspecialchars($tour['name']) ?></h4>
                <h5 class="text-danger"><?= number_format($tour['price']) ?> VNĐ</h5>
                <hr>
                <p><?= htmlspecialchars($tour['description']) ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Thông tin khách hàng</h3>
            </div>
            <form action="<?= BASE_URL ?>booking/store" method="POST">
                <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">
                <input type="hidden" name="price" value="<?= $tour['price'] ?>">
                
                <div class="card-body">
                    <div class="mb-3">
                        <label>Tên khách hàng</label>
                        <input type="text" name="fullname" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label>Ngày đi</label>
                            <input type="date" name="start_date" class="form-control" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label>Số người</label>
                            <input type="number" name="people" class="form-control" value="1" min="1">
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-success fw-bold">Xác nhận Đặt</button>
                    <a href="<?= BASE_URL ?>tours" class="btn btn-secondary float-end">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
view('layouts.AdminLayout', ['content' => $content, 'title' => 'Đặt chỗ']); 
?>