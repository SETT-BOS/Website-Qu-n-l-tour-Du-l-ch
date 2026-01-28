<?php layout('AdminLayout', ['title' => 'Báo cáo khách hàng']); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Thống kê khách hàng</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>?act=baocao">Báo cáo</a></li>
                    <li class="breadcrumb-item active">Khách hàng</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Thống kê tổng quan khách hàng -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Tổng khách hàng</h5>
                    <h3>1,234</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Khách hàng mới</h5>
                    <h3>89</h3>
                    <small>Tháng này</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Khách hàng VIP</h5>
                    <h3>156</h3>
                    <small>Đặt >3 tour</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Tỷ lệ quay lại</h5>
                    <h3>23%</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Phân tích hành vi khách hàng -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Phân bố theo độ tuổi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>18-25 tuổi</span>
                            <span>25%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: 25%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>26-35 tuổi</span>
                            <span>40%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 40%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>36-50 tuổi</span>
                            <span>25%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 25%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Trên 50 tuổi</span>
                            <span>10%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 10%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Tour được ưa thích theo nhóm tuổi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nhóm tuổi</th>
                                    <th>Tour ưa thích</th>
                                    <th>Tỷ lệ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>18-25</td>
                                    <td>Tour phiêu lưu</td>
                                    <td>45%</td>
                                </tr>
                                <tr>
                                    <td>26-35</td>
                                    <td>Tour nghỉ dưỡng</td>
                                    <td>38%</td>
                                </tr>
                                <tr>
                                    <td>36-50</td>
                                    <td>Tour gia đình</td>
                                    <td>52%</td>
                                </tr>
                                <tr>
                                    <td>Trên 50</td>
                                    <td>Tour văn hóa</td>
                                    <td>67%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top khách hàng VIP -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Top 10 khách hàng VIP</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tên khách hàng</th>
                                    <th>Số tour đã đặt</th>
                                    <th>Tổng chi tiêu</th>
                                    <th>Lần cuối đặt</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nguyễn Văn A</td>
                                    <td>12</td>
                                    <td>45,000,000 VNĐ</td>
                                    <td>15/01/2024</td>
                                    <td><span class="badge badge-success">VIP Gold</span></td>
                                </tr>
                                <tr>
                                    <td>Trần Thị B</td>
                                    <td>8</td>
                                    <td>28,500,000 VNĐ</td>
                                    <td>10/01/2024</td>
                                    <td><span class="badge badge-warning">VIP Silver</span></td>
                                </tr>
                                <tr>
                                    <td>Lê Văn C</td>
                                    <td>6</td>
                                    <td>22,000,000 VNĐ</td>
                                    <td>08/01/2024</td>
                                    <td><span class="badge badge-info">VIP Bronze</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>