<?php
require_once __DIR__ . '/src/helpers/database.php';

$db = getDB();

if ($db) {
    try {
        // Tạo bảng nhat_ky
        $sql = "CREATE TABLE IF NOT EXISTS `nhat_ky` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `tour_id` int(11) DEFAULT NULL,
          `tieu_de` varchar(255) NOT NULL,
          `noi_dung` text NOT NULL,
          `ngay_dien_bien` date NOT NULL,
          `gio_dien_bien` time DEFAULT NULL,
          `dia_diem` varchar(255) DEFAULT NULL,
          `ghi_chu` text DEFAULT NULL,
          `loai_su_kien` enum('dien_bien','su_co','phan_hoi_khach','danh_gia_hdv','suc_khoe') DEFAULT 'dien_bien',
          `muc_do_nghiem_trong` enum('binh_thuong','luu_y','quan_trong','nghiem_trong') DEFAULT 'binh_thuong',
          `nguoi_ghi` int(11) DEFAULT NULL,
          `phan_hoi_khach` text DEFAULT NULL,
          `danh_gia_hdv` json DEFAULT NULL,
          `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
          `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`),
          KEY `idx_tour_id` (`tour_id`),
          KEY `idx_loai_su_kien` (`loai_su_kien`),
          KEY `idx_ngay_dien_bien` (`ngay_dien_bien`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $db->exec($sql);
        echo "Tạo bảng nhat_ky thành công!<br>";
        
        // Thêm dữ liệu mẫu
        $insertSql = "INSERT INTO `nhat_ky` (`tour_id`, `tieu_de`, `noi_dung`, `ngay_dien_bien`, `gio_dien_bien`, `dia_diem`, `ghi_chu`, `loai_su_kien`, `muc_do_nghiem_trong`, `nguoi_ghi`, `phan_hoi_khach`, `danh_gia_hdv`) VALUES
        (1, 'Khởi hành từ Hà Nội', 'Đoàn khởi hành đúng giờ 7:00 sáng từ Hà Nội. Thời tiết thuận lợi, khách hàng có mặt đầy đủ.', '2024-01-15', '07:00:00', 'Hà Nội', 'Tất cả khách đều có mặt đúng giờ', 'dien_bien', 'binh_thuong', 1, NULL, NULL),
        (1, 'Sự cố xe hỏng', 'Xe gặp sự cố hỏng lốp trên đường. Đã liên hệ xe dự phòng và xử lý trong 45 phút.', '2024-01-15', '11:15:00', 'Cao tốc Nội Bài - Lào Cai', 'Đã thay lốp dự phòng, xe hoạt động bình thường', 'su_co', 'quan_trong', 1, NULL, NULL),
        (1, 'Nguyễn Văn Nam', 'HDV rất nhiệt tình, am hiểu về lịch sử và văn hóa địa phương. Cách xử lý sự cố xe hỏng rất chuyên nghiệp.', '2024-01-15', '20:00:00', 'Sapa', 'Khách hàng rất hài lòng với dịch vụ', 'phan_hoi_khach', 'binh_thuong', 1, 'HDV rất nhiệt tình, am hiểu về lịch sử và văn hóa địa phương. Cách xử lý sự cố xe hỏng rất chuyên nghiệp.', NULL),
        (1, 'Lê Minh Tuấn bị say xe', 'Khách Lê Minh Tuấn bị say xe nghiêm trọng trên đoạn đường cua. Đã cho uống thuốc và nghỉ ngơi.', '2024-01-15', '10:30:00', 'Đường lên Sapa', 'Đã hỗ trợ thuốc say xe, khách đã ổn định', 'suc_khoe', 'luu_y', 1, NULL, NULL),
        (1, 'Đánh giá HDV Nguyễn Văn A', 'Đánh giá tổng thể về HDV Nguyễn Văn A sau khi kết thúc tour 3 ngày 2 đêm Sapa.', '2024-01-17', '18:00:00', 'Sapa', 'HDV thể hiện tốt, cần cải thiện kỹ năng quản lý thời gian', 'danh_gia_hdv', 'binh_thuong', 1, NULL, '{\"chuyen_mon\": 5, \"thai_do\": 4, \"giao_tiep\": 4, \"xu_ly_tinh_huong\": 5}')";
        
        $db->exec($insertSql);
        echo "Thêm dữ liệu mẫu thành công!<br>";
        echo "<a href='/website_quan_ly_tour/nhatky'>Xem nhật ký tour</a>";
        
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
} else {
    echo "Không thể kết nối database!";
}
?>