<?php
require_once __DIR__ . '/../models/Tour.php';
require_once __DIR__ . '/../models/Booking.php';

class BaoCaoVanHanhController {
    
    // Hiển thị trang báo cáo tổng quan
    public function index() {
        requireLogin();
        
        // Lấy dữ liệu thống kê cơ bản
        $tourModel = new Tour();
        $bookingModel = new Booking();
        
        $tongTour = $tourModel->count();
        $tongBooking = $bookingModel->count();
        $doanhThuThang = $bookingModel->getRevenueByMonth(date('Y-m'));
        $tourPhoBien = $tourModel->getPopularTours(5);
        
        view('baocaovanhanh.index', [
            'title' => 'Báo cáo vận hành',
            'tongTour' => $tongTour,
            'tongBooking' => $tongBooking,
            'doanhThuThang' => $doanhThuThang,
            'tourPhoBien' => $tourPhoBien
        ]);
    }
    
    // Báo cáo doanh thu theo thời gian
    public function doanhThu() {
        requireLogin();
        
        $tuNgay = $_GET['tu_ngay'] ?? date('Y-m-01');
        $denNgay = $_GET['den_ngay'] ?? date('Y-m-t');
        
        $bookingModel = new Booking();
        $doanhThu = $bookingModel->getRevenueReport($tuNgay, $denNgay);
        $chiTietTour = $bookingModel->getRevenueByTour($tuNgay, $denNgay);
        
        view('baocaovanhanh.doanhthu', [
            'title' => 'Báo cáo doanh thu',
            'tuNgay' => $tuNgay,
            'denNgay' => $denNgay,
            'doanhThu' => $doanhThu,
            'chiTietTour' => $chiTietTour
        ]);
    }
    
    // Báo cáo hiệu quả tour
    public function hieuQuaTour() {
        requireLogin();
        
        $tourModel = new Tour();
        $bookingModel = new Booking();
        
        $thang = $_GET['thang'] ?? date('Y-m');
        $tourStats = $tourModel->getTourPerformance($thang);
        
        view('baocaovanhanh.hieuquatour', [
            'title' => 'Báo cáo hiệu quả tour',
            'thang' => $thang,
            'tourStats' => $tourStats
        ]);
    }
    
    // Báo cáo khách hàng
    public function khachHang() {
        requireLogin();
        
        view('baocaovanhanh.khachhang', [
            'title' => 'Báo cáo khách hàng'
        ]);
    }
}