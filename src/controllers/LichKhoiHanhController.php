<?php

require_once __DIR__ . '/../helpers/helpers.php';

class LichKhoiHanhController
{
    public function index()
    {
        requireLogin();
        $lichKhoiHanh = [
            [
                'id' => 1,
                'ma_lich' => 'LKH001',
                'tour_id' => 1,
                'ten_tour' => 'Tour Hạ Long 3N2Đ',
                'ngay_khoi_hanh' => '2024-02-15',
                'gio_khoi_hanh' => '07:00',
                'diem_tap_trung' => 'Số 1 Đinh Tiên Hoàng, Hoàn Kiếm, Hà Nội',
                'ngay_ket_thuc' => '2024-02-17',
                'so_khach' => 25,
                'so_khach_toi_da' => 30,
                'trang_thai' => 'Đã phân bổ',
                'hdv_id' => 1,
                'tai_xe_id' => 1,
                'xe_id' => 1
            ],
            [
                'id' => 2,
                'ma_lich' => 'LKH002',
                'tour_id' => 2,
                'ten_tour' => 'Tour Sapa 4N3Đ',
                'ngay_khoi_hanh' => '2024-02-20',
                'gio_khoi_hanh' => '06:30',
                'diem_tap_trung' => 'Bến xe Mỹ Đình, Hà Nội',
                'ngay_ket_thuc' => '2024-02-23',
                'so_khach' => 18,
                'so_khach_toi_da' => 25,
                'trang_thai' => 'Chưa phân bổ',
                'hdv_id' => null,
                'tai_xe_id' => null,
                'xe_id' => null
            ]
        ];

        view('lich.index', compact('lichKhoiHanh'));
    }

    public function create()
    {
        requireAdmin(); // Chỉ admin mới được tạo lịch
        $tours = [
            ['id' => 1, 'ten_tour' => 'Tour Hạ Long 3N2Đ'],
            ['id' => 2, 'ten_tour' => 'Tour Sapa 4N3Đ'],
            ['id' => 3, 'ten_tour' => 'Tour Phú Quốc 5N4Đ']
        ];

        view('lich.create', compact('tours'));
    }

    public function phanBo($id)
    {
        requireAdmin(); // Chỉ admin mới được phân bổ
        // Lấy thông tin lịch khởi hành
        $lichKhoiHanh = [
            'id' => $id,
            'ma_lich' => 'LKH00' . $id,
            'ten_tour' => 'Tour Hạ Long 3N2Đ',
            'ngay_khoi_hanh' => '2024-02-15',
            'so_khach' => 25
        ];

        // Danh sách HDV rảnh
        $hdvList = [
            ['id' => 1, 'ma_hdv' => 'HDV001', 'ho_ten' => 'Nguyễn Văn A', 'ngon_ngu' => ['Tiếng Anh', 'Tiếng Nhật']],
            ['id' => 2, 'ma_hdv' => 'HDV002', 'ho_ten' => 'Trần Thị B', 'ngon_ngu' => ['Tiếng Anh', 'Tiếng Hàn']]
        ];

        // Danh sách tài xế rảnh
        $taiXeList = [
            ['id' => 1, 'ma_tai_xe' => 'TX001', 'ho_ten' => 'Lê Văn C', 'bang_lai' => 'B2'],
            ['id' => 2, 'ma_tai_xe' => 'TX002', 'ho_ten' => 'Phạm Văn D', 'bang_lai' => 'D']
        ];

        // Danh sách xe có sẵn
        $xeList = [
            ['id' => 1, 'bien_so' => '29A-12345', 'loai_xe' => 'Xe 29 chỗ', 'so_cho' => 29],
            ['id' => 2, 'bien_so' => '30B-67890', 'loai_xe' => 'Xe 45 chỗ', 'so_cho' => 45]
        ];

        // Danh sách khách sạn
        $khachSanList = [
            ['id' => 1, 'ten_ks' => 'Khách sạn Hạ Long Bay', 'dia_chi' => 'Hạ Long, Quảng Ninh', 'so_phong_trong' => 15],
            ['id' => 2, 'ten_ks' => 'Novotel Hạ Long', 'dia_chi' => 'Hạ Long, Quảng Ninh', 'so_phong_trong' => 8]
        ];

        view('lich.phanbo', compact('lichKhoiHanh', 'hdvList', 'taiXeList', 'xeList', 'khachSanList'));
    }

    public function dichVu($id)
    {
        requireAdmin(); // Chỉ admin mới được quản lý dịch vụ
        $lichKhoiHanh = [
            'id' => $id,
            'ma_lich' => 'LKH00' . $id,
            'ten_tour' => 'Tour Hạ Long 3N2Đ',
            'ngay_khoi_hanh' => '2024-02-15',
            'ngay_ket_thuc' => '2024-02-17',
            'so_khach' => 25
        ];

        $dichVuDaDat = [
            [
                'loai' => 'Khách sạn',
                'ten' => 'Khách sạn Hạ Long Bay',
                'ngay' => '2024-02-15',
                'so_luong' => '12 phòng',
                'trang_thai' => 'Đã đặt'
            ],
            [
                'loai' => 'Nhà hàng',
                'ten' => 'Nhà hàng Hải sản Hạ Long',
                'ngay' => '2024-02-15',
                'so_luong' => '25 suất',
                'trang_thai' => 'Chờ xác nhận'
            ]
        ];

        view('lich.dichvu', compact('lichKhoiHanh', 'dichVuDaDat'));
    }
}