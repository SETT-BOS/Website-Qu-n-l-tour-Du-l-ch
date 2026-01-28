<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Yêu Cầu Đặc Biệt' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white p-3">
                <h5><i class="bi bi-person-badge"></i> HDV Panel</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= BASE_URL ?>hdv/lich-lam-viec">
                            <i class="bi bi-calendar-check"></i> Lịch Làm Việc
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= BASE_URL ?>hdv/diem-danh">
                            <i class="bi bi-check2-square"></i> Điểm Danh
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="<?= BASE_URL ?>hdv/yeu-cau-dac-biet">
                            <i class="bi bi-exclamation-triangle"></i> Yêu Cầu Đặc Biệt
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= BASE_URL ?>home">
                            <i class="bi bi-house"></i> Trang Chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= BASE_URL ?>logout">
                            <i class="bi bi-box-arrow-right"></i> Đăng Xuất
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-exclamation-triangle text-warning"></i> Yêu Cầu Đặc Biệt</h2>
                    <div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRequestModal">
                            <i class="bi bi-plus-circle"></i> Thêm Yêu Cầu
                        </button>
                    </div>
                </div>
                
                <!-- Thống kê nhanh -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <h5><i class="bi bi-list-ul"></i> Tổng Yêu Cầu</h5>
                                <h3><?= count($yeuCauDacBiet) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h5><i class="bi bi-clock"></i> Chờ Xử Lý</h5>
                                <h3><?= count(array_filter($yeuCauDacBiet, fn($item) => $item['trang_thai'] === 'pending')) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <h5><i class="bi bi-gear"></i> Đang Xử Lý</h5>
                                <h3><?= count(array_filter($yeuCauDacBiet, fn($item) => $item['trang_thai'] === 'processing')) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h5><i class="bi bi-check-circle"></i> Hoàn Thành</h5>
                                <h3><?= count(array_filter($yeuCauDacBiet, fn($item) => $item['trang_thai'] === 'completed')) ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Danh sách yêu cầu -->
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-list-check"></i> Danh Sách Yêu Cầu Đặc Biệt</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tour</th>
                                        <th>Khách Hàng</th>
                                        <th>Yêu Cầu</th>
                                        <th>Trạng Thái</th>
                                        <th>Ngày Tạo</th>
                                        <th>Ghi Chú</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($yeuCauDacBiet as $index => $yeuCau): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td>
                                            <strong><?= $yeuCau['tour_name'] ?></strong>
                                        </td>
                                        <td>
                                            <i class="bi bi-person"></i> <?= $yeuCau['khach_hang'] ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark"><?= $yeuCau['yeu_cau'] ?></span>
                                        </td>
                                        <td>
                                            <?php 
                                            $badgeClass = match($yeuCau['trang_thai']) {
                                                'pending' => 'bg-warning',
                                                'processing' => 'bg-primary',
                                                'completed' => 'bg-success',
                                                default => 'bg-secondary'
                                            };
                                            $statusText = match($yeuCau['trang_thai']) {
                                                'pending' => 'Chờ Xử Lý',
                                                'processing' => 'Đang Xử Lý',
                                                'completed' => 'Hoàn Thành',
                                                default => 'Không Xác Định'
                                            };
                                            ?>
                                            <span class="badge <?= $badgeClass ?>"><?= $statusText ?></span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?= date('d/m/Y', strtotime($yeuCau['ngay_tao'])) ?>
                                            </small>
                                        </td>
                                        <td><?= $yeuCau['ghi_chu'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-info" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#updateStatusModal"
                                                        data-id="<?= $yeuCau['id'] ?>"
                                                        data-status="<?= $yeuCau['trang_thai'] ?>"
                                                        data-note="<?= $yeuCau['ghi_chu'] ?>"
                                                        title="Cập nhật trạng thái">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Cập Nhật Trạng Thái -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập Nhật Trạng Thái Yêu Cầu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="<?= BASE_URL ?>hdv/cap-nhat-yeu-cau">
                    <div class="modal-body">
                        <input type="hidden" name="yeu_cau_id" id="yeuCauId">
                        
                        <div class="mb-3">
                            <label for="trangThai" class="form-label">Trạng Thái</label>
                            <select class="form-select" name="trang_thai" id="trangThai" required>
                                <option value="pending">Chờ Xử Lý</option>
                                <option value="processing">Đang Xử Lý</option>
                                <option value="completed">Hoàn Thành</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ghiChu" class="form-label">Ghi Chú</label>
                            <textarea class="form-control" name="ghi_chu" id="ghiChu" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Xử lý modal cập nhật trạng thái
        document.getElementById('updateStatusModal').addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const status = button.getAttribute('data-status');
            const note = button.getAttribute('data-note');
            
            document.getElementById('yeuCauId').value = id;
            document.getElementById('trangThai').value = status;
            document.getElementById('ghiChu').value = note;
        });
    </script>
</body>
</html>