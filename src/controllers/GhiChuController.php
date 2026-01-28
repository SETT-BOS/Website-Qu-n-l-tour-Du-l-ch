<?php

class GhiChuController
{
    public function index()
    {
        requireLogin();
        $ghiChuList = [
            [
                'id' => 1,
                'khach_hang_id' => 1,
                'ho_ten' => 'Trần Văn Nam',
                'tour' => 'Tour Hạ Long 3N2Đ',
                'loai_ghi_chu' => 'Ăn uống',
                'noi_dung' => 'Ăn chay trường, không ăn hành tỏi',
                'muc_do' => 'Quan trọng',
                'ngay_tao' => '2024-02-10',
                'trang_thai' => 'Đã xử lý'
            ],
            [
                'id' => 2,
                'khach_hang_id' => 2,
                'ho_ten' => 'Nguyễn Thị Lan',
                'tour' => 'Tour Hạ Long 3N2Đ',
                'loai_ghi_chu' => 'Sức khỏe',
                'noi_dung' => 'Dị ứng hải sản, có bệnh tim',
                'muc_do' => 'Rất quan trọng',
                'ngay_tao' => '2024-02-11',
                'trang_thai' => 'Chưa xử lý'
            ],
            [
                'id' => 3,
                'khach_hang_id' => 3,
                'ho_ten' => 'Lê Minh Tuấn',
                'tour' => 'Tour Sapa 4N3Đ',
                'loai_ghi_chu' => 'Phòng nghỉ',
                'noi_dung' => 'Yêu cầu phòng tầng thấp, sợ độ cao',
                'muc_do' => 'Bình thường',
                'ngay_tao' => '2024-02-12',
                'trang_thai' => 'Đã xử lý'
            ]
        ];

        view('ghichu.index', compact('ghiChuList'));
    }

    public function create()
    {
        requireAdmin(); // Chỉ admin mới được tạo ghi chú
        $khachHangList = [
            ['id' => 1, 'ho_ten' => 'Trần Văn Nam', 'tour' => 'Tour Hạ Long 3N2Đ'],
            ['id' => 2, 'ho_ten' => 'Nguyễn Thị Lan', 'tour' => 'Tour Hạ Long 3N2Đ'],
            ['id' => 3, 'ho_ten' => 'Lê Minh Tuấn', 'tour' => 'Tour Sapa 4N3Đ']
        ];

        view('ghichu.create', compact('khachHangList'));
    }

    public function view($id)
    {
        requireLogin();
        $ghiChu = [
            'id' => $id,
            'khach_hang_id' => 1,
            'ho_ten' => 'Trần Văn Nam',
            'tour' => 'Tour Hạ Long 3N2Đ',
            'loai_ghi_chu' => 'Ăn uống',
            'noi_dung' => 'Ăn chay trường, không ăn hành tỏi. Khách có thể ăn trứng và sữa.',
            'muc_do' => 'Quan trọng',
            'ngay_tao' => '2024-02-10',
            'nguoi_tao' => 'Admin',
            'trang_thai' => 'Đã xử lý',
            'ghi_chu_xu_ly' => 'Đã thông báo bếp và HDV'
        ];

        view('ghichu.view', compact('ghiChu'));
    }

    public function khachHang($khachId)
    {
        requireLogin();
        $khachHang = [
            'id' => $khachId,
            'ho_ten' => 'Trần Văn Nam',
            'tour' => 'Tour Hạ Long 3N2Đ',
            'dien_thoai' => '0901234567'
        ];

        $ghiChuList = [
            [
                'id' => 1,
                'loai_ghi_chu' => 'Ăn uống',
                'noi_dung' => 'Ăn chay trường, không ăn hành tỏi',
                'muc_do' => 'Quan trọng',
                'ngay_tao' => '2024-02-10',
                'trang_thai' => 'Đã xử lý'
            ],
            [
                'id' => 4,
                'loai_ghi_chu' => 'Di chuyển',
                'noi_dung' => 'Cần ghế ngồi gần cửa sổ, say xe',
                'muc_do' => 'Bình thường',
                'ngay_tao' => '2024-02-11',
                'trang_thai' => 'Chưa xử lý'
            ]
        ];

        view('ghichu.khachhang', compact('khachHang', 'ghiChuList'));
    }
}