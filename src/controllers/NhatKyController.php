<?php

class NhatKyController
{
    public function index()
    {
        requireLogin();
        $nhatKyList = [
            [
                'id' => 1,
                'tour' => 'Tour Hạ Long 3N2Đ',
                'ma_tour' => 'LKH001',
                'hdv' => 'Nguyễn Văn A',
                'ngay_bat_dau' => '2024-02-15',
                'ngay_ket_thuc' => '2024-02-17',
                'trang_thai' => 'Hoàn thành',
                'so_su_co' => 2,
                'danh_gia_tb' => 4.5
            ],
            [
                'id' => 2,
                'tour' => 'Tour Sapa 4N3Đ',
                'ma_tour' => 'LKH002',
                'hdv' => 'Trần Thị B',
                'ngay_bat_dau' => '2024-02-20',
                'ngay_ket_thuc' => '2024-02-23',
                'trang_thai' => 'Đang thực hiện',
                'so_su_co' => 0,
                'danh_gia_tb' => null
            ]
        ];

        view('nhatky.index', compact('nhatKyList'));
    }

    public function view($id)
    {
        requireLogin();
        $nhatKy = [
            'id' => $id,
            'tour' => 'Tour Hạ Long 3N2Đ',
            'ma_tour' => 'LKH001',
            'hdv' => 'Nguyễn Văn A',
            'ngay_bat_dau' => '2024-02-15',
            'ngay_ket_thuc' => '2024-02-17',
            'trang_thai' => 'Hoàn thành'
        ];

        $dienBien = [
            [
                'id' => 1,
                'ngay' => '2024-02-15',
                'gio' => '08:30',
                'loai' => 'Thời tiết',
                'noi_dung' => 'Trời mưa nhẹ, độ ẩm cao',
                'nguoi_ghi' => 'HDV Nguyễn Văn A'
            ],
            [
                'id' => 2,
                'ngay' => '2024-02-15',
                'gio' => '14:00',
                'loai' => 'Sự cố',
                'noi_dung' => 'Khách Trần Văn Nam bị say sóng, đã hỗ trợ thuốc',
                'nguoi_ghi' => 'HDV Nguyễn Văn A'
            ]
        ];

        $phanHoi = [
            [
                'khach_hang' => 'Trần Văn Nam',
                'danh_gia' => 5,
                'noi_dung' => 'Tour rất tuyệt, HDV nhiệt tình',
                'ngay_danh_gia' => '2024-02-17'
            ],
            [
                'khach_hang' => 'Nguyễn Thị Lan',
                'danh_gia' => 4,
                'noi_dung' => 'Tốt nhưng thời gian hơi gấp',
                'ngay_danh_gia' => '2024-02-17'
            ]
        ];

        view('nhatky.view', compact('nhatKy', 'dienBien', 'phanHoi'));
    }

    public function create()
    {
        requireAdmin(); // Chỉ admin mới được tạo nhật ký
        $tourList = [
            ['id' => 1, 'ma_tour' => 'LKH001', 'ten_tour' => 'Tour Hạ Long 3N2Đ', 'hdv' => 'Nguyễn Văn A'],
            ['id' => 2, 'ma_tour' => 'LKH002', 'ten_tour' => 'Tour Sapa 4N3Đ', 'hdv' => 'Trần Thị B']
        ];

        view('nhatky.create', compact('tourList'));
    }

    public function themDienBien($id)
    {
        requireAdmin(); // Chỉ admin mới được thêm diễn biến
        $nhatKy = [
            'id' => $id,
            'tour' => 'Tour Hạ Long 3N2Đ',
            'ma_tour' => 'LKH001'
        ];

        view('nhatky.them-dien-bien', compact('nhatKy'));
    }

    public function danhGiaHdv($id)
    {
        requireLogin();
        $hdv = [
            'id' => $id,
            'ho_ten' => 'Nguyễn Văn A',
            'ma_hdv' => 'HDV001'
        ];

        $danhGiaList = [
            [
                'tour' => 'Tour Hạ Long 3N2Đ',
                'ngay' => '2024-02-17',
                'danh_gia_tb' => 4.5,
                'so_danh_gia' => 25,
                'nhan_xet' => 'HDV nhiệt tình, am hiểu'
            ],
            [
                'tour' => 'Tour Sapa 4N3Đ',
                'ngay' => '2024-01-20',
                'danh_gia_tb' => 4.8,
                'so_danh_gia' => 18,
                'nhan_xet' => 'Rất chuyên nghiệp'
            ]
        ];

        view('nhatky.danh-gia-hdv', compact('hdv', 'danhGiaList'));
    }
}