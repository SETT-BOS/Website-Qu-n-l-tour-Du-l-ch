<?php
// Khởi tạo session ngay đầu
session_start();

// Định nghĩa BASE_PATH
define('BASE_PATH', __DIR__);

// Nạp cấu hình chung của ứng dụng
$config = require __DIR__ . '/config/config.php';

// Nạp các file chứa hàm trợ giúp
require_once __DIR__ . '/src/helpers/helpers.php';
require_once __DIR__ . '/src/helpers/database.php';

// Nạp các file chứa model
require_once __DIR__ . '/src/models/User.php';
require_once __DIR__ . '/src/models/Category.php';

// Nạp các file chứa controller
require_once __DIR__ . '/src/controllers/HomeController.php';
require_once __DIR__ . '/src/controllers/AuthController.php';
require_once __DIR__ . '/src/controllers/NhanSuController.php';
require_once __DIR__ . '/src/controllers/LichKhoiHanhController.php';
require_once __DIR__ . '/src/controllers/BookingController.php';
require_once __DIR__ . '/src/controllers/GhiChuController.php';
require_once __DIR__ . '/src/controllers/NhatKyController.php';
require_once __DIR__ . '/src/controllers/QuanLyController.php';
require_once __DIR__ . '/src/controllers/HdvController.php';
require_once __DIR__ . '/src/controllers/TourController.php';
require_once __DIR__ . '/src/controllers/BaoCaoVanHanhController.php';
require_once __DIR__ . '/src/controllers/CategoryController.php';

// Khởi tạo các controller
$homeController = new HomeController();
$authController = new AuthController();
$nhansuController = new NhanSuController();
$lichKhoiHanhController = new LichKhoiHanhController();
$bookingController = new BookingController();
$ghiChuController = new GhiChuController();
$nhatKyController = new NhatKyController();
$quanLyController = new QuanLyController();
$hdvController = new HdvController();
$tourController = new TourController();
$baoCaoVanHanhController = new BaoCaoVanHanhController();
$categoryController = new CategoryController();


// Xác định route dựa trên tham số act (mặc định là trang chủ '/')
$act = $_GET['act'] ?? '/';

// Handle dynamic routes
if (preg_match('/^nhansu\/view\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'nhansu/view';
} elseif (preg_match('/^nhansu\/edit\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'nhansu/edit';
} elseif (preg_match('/^lichkhoihanh\/phanbo\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'lichkhoihanh/phanbo';
} elseif (preg_match('/^lichkhoihanh\/dichvu\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'lichkhoihanh/dichvu';
} elseif (preg_match('/^lichkhoihanh\/edit\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'lichkhoihanh/edit';
} elseif (preg_match('/^booking\/danhsach\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'booking/danhsach';
} elseif (preg_match('/^booking\/print\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'booking/print';
} elseif (preg_match('/^booking\/phanphong\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'booking/phanphong';
} elseif (preg_match('/^ghichu\/view\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'ghichu/view';
} elseif (preg_match('/^ghichu\/khachhang\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'ghichu/khachhang';
} elseif (preg_match('/^nhatky\/view\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'nhatky/view';
} elseif (preg_match('/^nhatky\/them-dien-bien\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'nhatky/them-dien-bien';
} elseif (preg_match('/^nhatky\/danh-gia-hdv\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'nhatky/danh-gia-hdv';
} elseif (preg_match('/^nhatky\/storeDienBien\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'nhatky/storeDienBien';
} elseif (preg_match('/^hdv\/chi-tiet-tour\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'hdv/chi-tiet-tour';
} elseif (preg_match('/^tours\/detail\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'tours/detail';
} elseif (preg_match('/^tours\/form\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'tours/form';
} elseif (preg_match('/^tours\/delete\/(\d+)$/', $act, $matches)) {
    $_GET['id'] = $matches[1];
    $act = 'tours/delete';
}

// Match đảm bảo chỉ một action tương ứng được gọi
match ($act) {
    // Trang welcome (cho người chưa đăng nhập) - mặc định khi truy cập '/'
    '/', 'welcome' => $homeController->welcome(),

    // Trang home (cho người đã đăng nhập)
    'home' => $homeController->home(),

    // Đường dẫn đăng nhập, đăng xuất
    'login' => $authController->login(),
    'check-login' => $authController->checkLogin(),
    'admin/login' => $authController->adminLogin(),
    'admin/check-login' => $authController->checkAdminLogin(),
    'profile' => $authController->profile(),
    'upload-avatar' => $authController->uploadAvatar(),
    'logout' => $authController->logout(),

    // HDV Management routes
    'nhansu' => $nhansuController->index(),
    'nhansu/create' => $nhansuController->create(),
    'nhansu/store' => $nhansuController->store(),
    'nhansu/view' => $nhansuController->view(),
    'nhansu/edit' => $nhansuController->edit(),
    'nhansu/update' => $nhansuController->update(),
    'nhansu/history' => $nhansuController->history(),

    // Lịch khởi hành Management routes
    'lich', 'lichkhoihanh' => $lichKhoiHanhController->index(),
    'lichkhoihanh/create' => $lichKhoiHanhController->create(),
    // 'lichkhoihanh/store' => $lichKhoiHanhController->store(),
    // 'lichkhoihanh/edit' => $lichKhoiHanhController->edit(),
    // 'lichkhoihanh/update' => $lichKhoiHanhController->update(),
    'lichkhoihanh/phanbo' => $lichKhoiHanhController->phanBo($_GET['id'] ?? null),
    'lichkhoihanh/dichvu' => $lichKhoiHanhController->dichVu($_GET['id'] ?? null),

    // Booking Management routes
    'booking' => $bookingController->index(),
    // 'booking/form' => $bookingController->form(),
    'booking/store' => $bookingController->store(),
    'booking/update-status' => $bookingController->updateStatus(),
    'booking/delete' => $bookingController->delete(),
    'booking/danhsach' => $bookingController->danhSach($_GET['id'] ?? null),
    'booking/print' => $bookingController->inDanhSach($_GET['id'] ?? null),
    'booking/phanphong' => $bookingController->phanPhong($_GET['id'] ?? null),
    'admin/bookings' => $bookingController->index(),

    // Ghi chú đặc biệt routes
    'ghichu' => $ghiChuController->index(),
    'ghichu/create' => $ghiChuController->create(),
    'ghichu/view' => $ghiChuController->view($_GET['id'] ?? null),
    'ghichu/khachhang' => $ghiChuController->khachHang($_GET['id'] ?? null),

    // Nhật ký tour routes
    'nhatky' => $nhatKyController->index(),
    'nhatky/them' => $nhatKyController->create(),
    'nhatky/create' => $nhatKyController->create(),
    // 'nhatky/store' => $nhatKyController->store(),
    // 'nhatky/storePhanHoi' => $nhatKyController->storePhanHoi(),
    // 'nhatky/storeDanhGia' => $nhatKyController->storeDanhGia(),
    // 'nhatky/storeDienBien' => $nhatKyController->storeDienBien($_GET['id'] ?? null),
    'nhatky/view' => $nhatKyController->view($_GET['id'] ?? null),
    'nhatky/them-dien-bien' => $nhatKyController->themDienBien($_GET['id'] ?? null),
    'nhatky/danh-gia-hdv' => $nhatKyController->danhGiaHdv($_GET['id'] ?? null),

    // Quản lý tổng hợp routes
    'quanly' => $quanLyController->index(),
    'quanly/nhansu' => $quanLyController->nhanSu(),
    'quanly/lich' => $quanLyController->lichKhoiHanh(),
    'quanly/booking' => $quanLyController->booking(),
    'quanly/ghichu' => $quanLyController->ghiChu(),
    'quanly/nhatky' => $quanLyController->nhatKy(),

    // HDV routes
    'hdv/lich-lam-viec' => $hdvController->lichLamViec(),
    'hdv/diem-danh' => $hdvController->diemDanh(),
    'hdv/cap-nhat-check-in' => $hdvController->capNhatCheckIn(),
    'hdv/yeu-cau-dac-biet' => $hdvController->yeuCauDacBiet(),
    'hdv/cap-nhat-yeu-cau' => $hdvController->capNhatYeuCau(),
    'hdv/chi-tiet-tour' => $hdvController->chiTietTour(),

    // Tour Management routes
    'tours' => $tourController->index(),
    'tours/detail' => $tourController->detail(),
    'tours/form' => $tourController->form(),
    'tours/save' => $tourController->save(),
    'tours/delete' => $tourController->delete(),

    // Báo cáo vận hành routes
    'baocao' => $baoCaoVanHanhController->index(),
    'baocao/doanhthu' => $baoCaoVanHanhController->doanhThu(),
    'baocao/khachhang' => $baoCaoVanHanhController->khachHang(),
    'baocao/hieuquatour' => $baoCaoVanHanhController->hieuQuaTour(),


    // đường dẫn quản lý danh mục tour
    'Category' => $categoryController->index(),





    // Đường dẫn không tồn tại
      default => $homeController->notFound(),
};
?>
