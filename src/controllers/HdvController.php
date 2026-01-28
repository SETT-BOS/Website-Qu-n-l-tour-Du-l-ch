<?php

class HdvController
{
    // Lịch làm việc của HDV
    public function lichLamViec()
    {
        requireLogin();
        
        // Dữ liệu mẫu lịch làm việc
        $lichLamViec = [
            [
                'id' => 1,
                'tour_name' => 'Tour Hà Nội - Hạ Long 3N2Đ',
                'ngay_khoi_hanh' => '2024-02-15',
                'ngay_ket_thuc' => '2024-02-17',
                'so_khach' => 25,
                'trang_thai' => 'confirmed',
                'ghi_chu' => 'Đoàn khách VIP'
            ],
            [
                'id' => 2,
                'tour_name' => 'Tour Sài Gòn - Đà Lạt 4N3Đ',
                'ngay_khoi_hanh' => '2024-02-20',
                'ngay_ket_thuc' => '2024-02-23',
                'so_khach' => 18,
                'trang_thai' => 'pending',
                'ghi_chu' => 'Chờ xác nhận'
            ],
            [
                'id' => 3,
                'tour_name' => 'Tour Hội An - Huế 5N4Đ',
                'ngay_khoi_hanh' => '2024-02-25',
                'ngay_ket_thuc' => '2024-02-29',
                'so_khach' => 30,
                'trang_thai' => 'confirmed',
                'ghi_chu' => 'Tour cao cấp'
            ]
        ];
        
        view('hdv.lich-lam-viec', [
            'title' => 'Lịch Làm Việc HDV',
            'lichLamViec' => $lichLamViec
        ]);
    }
    
    // Điểm danh khách hàng
    public function diemDanh()
    {
        requireLogin();
        
        $tourId = $_GET['tour_id'] ?? 1;
        
        // Dữ liệu mẫu danh sách khách hàng
        $danhSachKhach = [
            [
                'id' => 1,
                'ho_ten' => 'Nguyễn Văn A',
                'so_dien_thoai' => '0901234567',
                'email' => 'nguyenvana@email.com',
                'check_in' => true,
                'thoi_gian_check_in' => '2024-02-15 07:30:00',
                'ghi_chu' => 'Đã có mặt'
            ],
            [
                'id' => 2,
                'ho_ten' => 'Trần Thị B',
                'so_dien_thoai' => '0912345678',
                'email' => 'tranthib@email.com',
                'check_in' => false,
                'thoi_gian_check_in' => null,
                'ghi_chu' => 'Chưa có mặt'
            ],
            [
                'id' => 3,
                'ho_ten' => 'Lê Văn C',
                'so_dien_thoai' => '0923456789',
                'email' => 'levanc@email.com',
                'check_in' => true,
                'thoi_gian_check_in' => '2024-02-15 07:45:00',
                'ghi_chu' => 'Đã có mặt'
            ]
        ];
        
        view('hdv.diem-danh', [
            'title' => 'Điểm Danh Khách Hàng',
            'danhSachKhach' => $danhSachKhach,
            'tourId' => $tourId
        ]);
    }
    
    // Cập nhật check-in
    public function capNhatCheckIn()
    {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $khachId = $_POST['khach_id'] ?? 0;
            $checkIn = $_POST['check_in'] ?? 0;
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            
            // Giả lập cập nhật database
            // Trong thực tế sẽ update vào database
            
            header('Location: ' . BASE_URL . 'hdv/diem-danh?tour_id=' . ($_POST['tour_id'] ?? 1));
            exit;
        }
    }
    
    // Yêu cầu đặc biệt
    public function yeuCauDacBiet()
    {
        requireLogin();
        
        // Dữ liệu mẫu yêu cầu đặc biệt
        $yeuCauDacBiet = [
            [
                'id' => 1,
                'tour_name' => 'Tour Hà Nội - Hạ Long 3N2Đ',
                'khach_hang' => 'Nguyễn Văn A',
                'yeu_cau' => 'Phòng view biển',
                'trang_thai' => 'pending',
                'ngay_tao' => '2024-02-10',
                'ghi_chu' => 'Khách VIP'
            ],
            [
                'id' => 2,
                'tour_name' => 'Tour Sài Gòn - Đà Lạt 4N3Đ',
                'khach_hang' => 'Trần Thị B',
                'yeu_cau' => 'Suất ăn chay',
                'trang_thai' => 'completed',
                'ngay_tao' => '2024-02-12',
                'ghi_chu' => 'Đã xử lý'
            ],
            [
                'id' => 3,
                'tour_name' => 'Tour Hội An - Huế 5N4Đ',
                'khach_hang' => 'Lê Văn C',
                'yeu_cau' => 'Xe đưa đón riêng',
                'trang_thai' => 'processing',
                'ngay_tao' => '2024-02-14',
                'ghi_chu' => 'Đang xử lý'
            ]
        ];
        
        view('hdv.yeu-cau-dac-biet', [
            'title' => 'Yêu Cầu Đặc Biệt',
            'yeuCauDacBiet' => $yeuCauDacBiet
        ]);
    }
    
    // Cập nhật yêu cầu đặc biệt
    public function capNhatYeuCau()
    {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $yeuCauId = $_POST['yeu_cau_id'] ?? 0;
            $trangThai = $_POST['trang_thai'] ?? '';
            $ghiChu = $_POST['ghi_chu'] ?? '';
            
            // Giả lập cập nhật database
            
            header('Location: ' . BASE_URL . 'hdv/yeu-cau-dac-biet');
            exit;
        }
    }
    
    // Chi tiết tour
    public function chiTietTour()
    {
        requireLogin();
        
        $tourId = $_GET['id'] ?? 1;
        
        // Dữ liệu mẫu chi tiết tour
        $tourDetail = [
            'id' => $tourId,
            'ten_tour' => 'Tour Hà Nội - Hạ Long 3N2Đ',
            'ngay_khoi_hanh' => '2024-02-15',
            'ngay_ket_thuc' => '2024-02-17',
            'so_khach' => 25,
            'gia_tour' => 2500000,
            'chuong_trinh' => [
                'Ngày 1: Hà Nội - Hạ Long (Ăn trưa, tối)',
                'Ngày 2: Tham quan vịnh Hạ Long (Ăn sáng, trưa, tối)',
                'Ngày 3: Hạ Long - Hà Nội (Ăn sáng, trưa)'
            ],
            'dich_vu' => [
                'Xe du lịch đời mới',
                'Khách sạn 4 sao',
                'Hướng dẫn viên chuyên nghiệp',
                'Bảo hiểm du lịch'
            ],
            'luu_y' => [
                'Mang theo CMND/CCCD',
                'Mang theo thuốc cá nhân',
                'Tập trung đúng giờ'
            ]
        ];
        
        view('hdv.chi-tiet-tour', [
            'title' => 'Chi Tiết Tour',
            'tour' => $tourDetail
        ]);
    }
}