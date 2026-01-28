<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách đoàn - <?= htmlspecialchars($booking['ma_booking']) ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .company { font-weight: bold; font-size: 16px; }
        .title { font-size: 14px; font-weight: bold; margin: 10px 0; }
        .info-table { width: 100%; margin-bottom: 15px; }
        .info-table td { padding: 3px 5px; }
        .main-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .main-table th, .main-table td { border: 1px solid #000; padding: 5px; text-align: center; }
        .main-table th { background-color: #f0f0f0; font-weight: bold; }
        .signature { margin-top: 30px; }
        .signature-box { display: inline-block; width: 200px; text-align: center; margin: 0 50px; }
        @media print { body { margin: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <div class="company">CÔNG TY DU LỊCH ABC</div>
        <div>Địa chỉ: 123 Đường ABC, Quận 1, TP.HCM</div>
        <div>Điện thoại: 028.1234.5678 - Email: info@dulichabc.com</div>
        <div class="title">DANH SÁCH ĐOÀN KHÁCH DU LỊCH</div>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Mã đoàn:</strong> <?= htmlspecialchars($booking['ma_booking']) ?></td>
            <td><strong>Tên tour:</strong> <?= htmlspecialchars($booking['ten_tour']) ?></td>
        </tr>
        <tr>
            <td><strong>Ngày khởi hành:</strong> <?= htmlspecialchars($booking['ngay_khoi_hanh']) ?></td>
            <td><strong>Ngày kết thúc:</strong> <?= htmlspecialchars($booking['ngay_ket_thuc']) ?></td>
        </tr>
        <tr>
            <td><strong>Hướng dẫn viên:</strong> <?= htmlspecialchars($booking['hdv']) ?></td>
            <td><strong>Tài xế:</strong> <?= htmlspecialchars($booking['tai_xe']) ?> - <?= htmlspecialchars($booking['bien_so_xe']) ?></td>
        </tr>
        <tr>
            <td><strong>Tổng số khách:</strong> <?= count($khachHang) ?> người</td>
            <td><strong>Ngày in:</strong> <?= date('d/m/Y H:i') ?></td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th width="25%">Họ và tên</th>
                <th width="8%">Giới tính</th>
                <th width="10%">Năm sinh</th>
                <th width="15%">CMND/CCCD</th>
                <th width="15%">Điện thoại</th>
                <th width="22%">Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($khachHang as $khach): ?>
                <tr>
                    <td><?= $khach['stt'] ?></td>
                    <td style="text-align: left;"><?= htmlspecialchars($khach['ho_ten']) ?></td>
                    <td><?= htmlspecialchars($khach['gioi_tinh']) ?></td>
                    <td><?= $khach['nam_sinh'] ?></td>
                    <td><?= htmlspecialchars($khach['so_cmnd']) ?></td>
                    <td><?= htmlspecialchars($khach['dien_thoai']) ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="signature">
        <div class="signature-box">
            <div><strong>HƯỚNG DẪN VIÊN</strong></div>
            <div style="margin-top: 60px;">................................</div>
            <div><?= htmlspecialchars($booking['hdv']) ?></div>
        </div>
        <div class="signature-box">
            <div><strong>TÀI XẾ</strong></div>
            <div style="margin-top: 60px;">................................</div>
            <div><?= htmlspecialchars($booking['tai_xe']) ?></div>
        </div>
        <div class="signature-box">
            <div><strong>TRƯỞNG ĐOÀN</strong></div>
            <div style="margin-top: 60px;">................................</div>
            <div>(Ký và ghi rõ họ tên)</div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>