<?php

class QuanLyController
{
    public function index()
    {
        $thongKe = [
            'nhan_su' => ['tong' => 15, 'ranh' => 8, 'ban' => 5, 'nghi' => 2],
            'lich_khoi_hanh' => ['tong' => 12, 'chua_phan_bo' => 5, 'dang_thuc_hien' => 4, 'hoan_thanh' => 3],
            'booking' => ['tong' => 25, 'xac_nhan' => 18, 'cho_thanh_toan' => 7],
            'ghi_chu' => ['tong' => 35, 'rat_quan_trong' => 5, 'chua_xu_ly' => 8],
            'nhat_ky' => ['tong' => 15, 'su_co' => 8, 'danh_gia_tb' => 4.6]
        ];

        view('quanly.index', compact('thongKe'));
    }

    // Nhân sự
    public function nhanSu()
    {
        $hdvList = [
            ['id' => 1, 'ma_hdv' => 'HDV001', 'ho_ten' => 'Nguyễn Văn A', 'ngay_sinh' => '1985-03-15', 'ngon_ngu' => ['Tiếng Anh', 'Tiếng Nhật'], 'nhom_hdv' => 'Tour quốc tế', 'kinh_nghiem' => 8, 'trang_thai' => 'Rảnh', 'anh_dai_dien' => '', 'dien_thoai' => '0901234567'],
            ['id' => 2, 'ma_hdv' => 'HDV002', 'ho_ten' => 'Trần Thị B', 'ngay_sinh' => '1990-08-22', 'ngon_ngu' => ['Tiếng Anh', 'Tiếng Hàn'], 'nhom_hdv' => 'Tour nội địa', 'kinh_nghiem' => 5, 'trang_thai' => 'Bận', 'anh_dai_dien' => '', 'dien_thoai' => '0987654321']
        ];
        view('quanly.nhansu', compact('hdvList'));
    }

    // Lịch khởi hành
    public function lichKhoiHanh()
    {
        $lichKhoiHanh = [
            ['id' => 1, 'ma_lich' => 'LKH001', 'ten_tour' => 'Tour Hạ Long 3N2Đ', 'ngay_khoi_hanh' => '2024-02-15', 'gio_khoi_hanh' => '07:00', 'diem_tap_trung' => 'Số 1 Đinh Tiên Hoàng, Hoàn Kiếm, Hà Nội', 'ngay_ket_thuc' => '2024-02-17', 'so_khach' => 25, 'so_khach_toi_da' => 30, 'trang_thai' => 'Đã phân bổ'],
            ['id' => 2, 'ma_lich' => 'LKH002', 'ten_tour' => 'Tour Sapa 4N3Đ', 'ngay_khoi_hanh' => '2024-02-20', 'gio_khoi_hanh' => '06:30', 'diem_tap_trung' => 'Bến xe Mỹ Đình, Hà Nội', 'ngay_ket_thuc' => '2024-02-23', 'so_khach' => 18, 'so_khach_toi_da' => 25, 'trang_thai' => 'Chưa phân bổ']
        ];
        view('quanly.lich', compact('lichKhoiHanh'));
    }

    // Booking
    public function booking()
    {
        $bookings = [
            ['id' => 1, 'ma_booking' => 'BK001', 'ten_tour' => 'Tour Hạ Long 3N2Đ', 'ngay_khoi_hanh' => '2024-02-15', 'so_khach' => 4, 'tong_tien' => 12000000, 'da_thanh_toan' => 8000000, 'trang_thai' => 'Đã xác nhận'],
            ['id' => 2, 'ma_booking' => 'BK002', 'ten_tour' => 'Tour Sapa 4N3Đ', 'ngay_khoi_hanh' => '2024-02-20', 'so_khach' => 2, 'tong_tien' => 8000000, 'da_thanh_toan' => 8000000, 'trang_thai' => 'Hoàn thành']
        ];
        view('quanly.booking', compact('bookings'));
    }

    // Ghi chú
    public function ghiChu()
    {
        $ghiChuList = [
            ['id' => 1, 'ho_ten' => 'Trần Văn Nam', 'tour' => 'Tour Hạ Long 3N2Đ', 'loai_ghi_chu' => 'Ăn uống', 'noi_dung' => 'Ăn chay trường, không ăn hành tỏi', 'muc_do' => 'Quan trọng', 'ngay_tao' => '2024-02-10', 'trang_thai' => 'Đã xử lý'],
            ['id' => 2, 'ho_ten' => 'Nguyễn Thị Lan', 'tour' => 'Tour Hạ Long 3N2Đ', 'loai_ghi_chu' => 'Sức khỏe', 'noi_dung' => 'Dị ứng hải sản, có bệnh tim', 'muc_do' => 'Rất quan trọng', 'ngay_tao' => '2024-02-11', 'trang_thai' => 'Chưa xử lý']
        ];
        view('quanly.ghichu', compact('ghiChuList'));
    }

    // Nhật ký
    public function nhatKy()
    {
        $nhatKyList = [
            ['id' => 1, 'tour' => 'Tour Hạ Long 3N2Đ', 'ma_tour' => 'LKH001', 'hdv' => 'Nguyễn Văn A', 'ngay_bat_dau' => '2024-02-15', 'ngay_ket_thuc' => '2024-02-17', 'trang_thai' => 'Hoàn thành', 'so_su_co' => 2, 'danh_gia_tb' => 4.5],
            ['id' => 2, 'tour' => 'Tour Sapa 4N3Đ', 'ma_tour' => 'LKH002', 'hdv' => 'Trần Thị B', 'ngay_bat_dau' => '2024-02-20', 'ngay_ket_thuc' => '2024-02-23', 'trang_thai' => 'Đang thực hiện', 'so_su_co' => 0, 'danh_gia_tb' => null]
        ];
        view('quanly.nhatky', compact('nhatKyList'));
    }
}