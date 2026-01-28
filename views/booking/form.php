<?php ob_start(); ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Đặt Tour Mới</h3>
            </div>
            <div class="card-body">
                <form action="<?= BASE_URL ?>booking/store" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tour_id" class="form-label">Chọn Tour</label>
                                <select class="form-select" id="tour_id" name="tour_id" required>
                                    <option value="">-- Chọn tour --</option>
                                    <option value="1">Tour Hạ Long 3N2Đ - 2,500,000 VNĐ</option>
                                    <option value="2">Tour Đà Lạt 4N3Đ - 3,200,000 VNĐ</option>
                                    <option value="3">Tour Hội An - Huế 5N4Đ - 4,500,000 VNĐ</option>
                                    <option value="4">Tour Phú Quốc 6N5Đ - 5,800,000 VNĐ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="booking_date" class="form-label">Ngày khởi hành</label>
                                <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Họ tên khách hàng</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="customer_phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="customer_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Ghi chú</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= BASE_URL ?>booking" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Đặt Tour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thông tin Tour</h5>
            </div>
            <div class="card-body">
                <div id="tour-info">
                    <p class="text-muted">Vui lòng chọn tour để xem thông tin chi tiết</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('tour_id').addEventListener('change', function() {
    const tourInfo = document.getElementById('tour-info');
    const tourId = this.value;
    
    const tours = {
        '1': {
            name: 'Tour Hạ Long 3N2Đ',
            price: '2,500,000 VNĐ',
            description: 'Tour khám phá vịnh Hạ Long với 3 ngày 2 đêm'
        },
        '2': {
            name: 'Tour Đà Lạt 4N3Đ', 
            price: '3,200,000 VNĐ',
            description: 'Tour nghỉ dưỡng tại thành phố ngàn hoa'
        },
        '3': {
            name: 'Tour Hội An - Huế 5N4Đ',
            price: '4,500,000 VNĐ', 
            description: 'Tour khám phá di sản văn hóa miền Trung'
        },
        '4': {
            name: 'Tour Phú Quốc 6N5Đ',
            price: '5,800,000 VNĐ',
            description: 'Tour nghỉ dưỡng biển đảo ngọc Phú Quốc'
        }
    };
    
    if (tourId && tours[tourId]) {
        const tour = tours[tourId];
        tourInfo.innerHTML = `
            <h6>${tour.name}</h6>
            <p class="text-success fw-bold">${tour.price}</p>
            <p class="small text-muted">${tour.description}</p>
        `;
    } else {
        tourInfo.innerHTML = '<p class="text-muted">Vui lòng chọn tour để xem thông tin chi tiết</p>';
    }
});
</script>

<?php
$content = ob_get_clean();

view('layouts.AdminLayout', [
    'title' => 'Đặt Tour Mới - Website Quản Lý Tour',
    'pageTitle' => 'Đặt Tour Mới',
    'content' => $content,
    'breadcrumb' => [
        ['label' => 'Booking', 'url' => BASE_URL . 'booking'],
        ['label' => 'Đặt mới', 'active' => true],
    ],
]);
?>