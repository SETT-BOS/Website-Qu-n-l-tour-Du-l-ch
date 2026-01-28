<?php
require_once __DIR__ . '/../models/Booking.php';

class BookingController {
    // 1. Xử lý lưu đơn đặt hàng (Khi khách bấm đặt)
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $price = $_POST['price'];
            $people = $_POST['people'];
            
            $data = [
                'tour_id' => $_POST['tour_id'],
                'name' => $_POST['fullname'],
                'phone' => $_POST['phone'],
                'people' => $people,
                'total' => $price * $people,
                'start_date' => $_POST['start_date']
            ];

            $model = new Booking();
            $model->create($data);

            // Lưu xong quay về trang danh sách
            echo "<script>alert('Đặt thành công!'); window.location.href='" . BASE_URL . "admin/bookings';</script>";
        }
    }

    // 2. Hiển thị danh sách đơn hàng cho Admin
    public function index() {
        requireLogin();
        
        $model = new Booking();
        $bookings = $model->getAll();
        
        view('admin.bookings.index', [
            'bookings' => $bookings,
            'title' => 'Quản lý Booking - Website Quản Lý Tour',
            'pageTitle' => 'Danh sách Đơn hàng'
        ]);
    }

    // 3. Cập nhật trạng thái đơn (Duyệt/Hủy)
    public function updateStatus() {
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $model = new Booking();
            $model->updateStatus($_POST['id'], $_POST['status']);
        }
        header('Location: ' . BASE_URL . 'admin/bookings');
        exit;
    }

    // 4. Xóa đơn hàng
    public function delete() {
        if (isset($_GET['id'])) {
            $model = new Booking();
            $model->delete($_GET['id']);
        }
        header('Location: ' . BASE_URL . 'admin/bookings');
        exit;
    }

    // --- CÁC HÀM CŨ (giữ lại để tương thích) ---
    
    // Hiển thị danh sách khách hàng trong một tour
    public function danhSach($id) {
        requireLogin();
        $booking = [
            'id' => $id,
            'ma_booking' => 'BK00' . $id,
            'ten_tour' => 'Tour Hạ Long 3N2Đ',
            'ngay_khoi_hanh' => '2024-02-15',
            'ngay_ket_thuc' => '2024-02-17',
            'hdv' => 'Nguyễn Văn A'
        ];

        $khachHang = [
            [
                'id' => 1,
                'ho_ten' => 'Trần Văn Nam',
                'gioi_tinh' => 'Nam',
                'nam_sinh' => 1985,
                'so_cmnd' => '123456789',
                'dien_thoai' => '0901234567',
                'email' => 'nam@email.com',
                'trang_thai_tt' => 'Đã thanh toán',
                'yeu_cau' => 'Phòng đơn',
                'phong_ks' => 'P101',
                'check_in' => false
            ]
        ];

        view('booking.danhsach', compact('booking', 'khachHang'));
    }

    // In danh sách khách hàng
    public function inDanhSach($id) {
        requireLogin();
        $booking = [
            'ma_booking' => 'BK00' . $id,
            'ten_tour' => 'Tour Hạ Long 3N2Đ',
            'ngay_khoi_hanh' => '15/02/2024',
            'ngay_ket_thuc' => '17/02/2024',
            'hdv' => 'Nguyễn Văn A',
            'tai_xe' => 'Lê Văn C',
            'bien_so_xe' => '29A-12345'
        ];

        $khachHang = [
            ['stt' => 1, 'ho_ten' => 'Trần Văn Nam', 'gioi_tinh' => 'Nam', 'nam_sinh' => 1985, 'so_cmnd' => '123456789', 'dien_thoai' => '0901234567']
        ];

        view('booking.print', compact('booking', 'khachHang'));
    }

    // Phân phòng cho khách hàng
    public function phanPhong($id) {
        requireAdmin();
        $booking = [
            'id' => $id,
            'ma_booking' => 'BK00' . $id,
            'ten_tour' => 'Tour Hạ Long 3N2Đ',
            'khach_san' => 'Khách sạn Hạ Long Bay'
        ];

        $khachHang = [
            ['id' => 1, 'ho_ten' => 'Trần Văn Nam', 'gioi_tinh' => 'Nam', 'phong_hien_tai' => 'P101']
        ];

        $phongTrong = [
            ['so_phong' => 'P201', 'loai_phong' => 'Đơn', 'giuong' => '1 giường đơn']
        ];

        view('booking.phanphong', compact('booking', 'khachHang', 'phongTrong'));
    }
}