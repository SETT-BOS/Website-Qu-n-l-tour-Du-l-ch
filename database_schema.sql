-- Database schema for website_quan_ly_tour
-- Run this script to create the necessary tables

CREATE DATABASE IF NOT EXISTS website_ql_tour CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE website_ql_tour;

-- Bảng danh mục tour
CREATE TABLE IF NOT EXISTS tour_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng nhà cung cấp
CREATE TABLE IF NOT EXISTS suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type ENUM('hotel', 'transport', 'restaurant', 'guide', 'other') NOT NULL,
    contact_person VARCHAR(255),
    phone VARCHAR(20),
    email VARCHAR(255),
    address TEXT,
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng tours
CREATE TABLE IF NOT EXISTS tours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(50) UNIQUE,
    description TEXT,
    duration_days INT NOT NULL,
    duration_nights INT NOT NULL,
    departure_location VARCHAR(255),
    destination VARCHAR(255),
    max_participants INT,
    min_participants INT DEFAULT 1,
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    FOREIGN KEY (category_id) REFERENCES tour_categories(id)
);

-- Bảng giá tour
CREATE TABLE IF NOT EXISTS tour_prices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    price_type ENUM('adult', 'child', 'infant', 'senior') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    valid_from DATE,
    valid_to DATE,
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Bảng hình ảnh tour
CREATE TABLE IF NOT EXISTS tour_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    image_path VARCHAR(500) NOT NULL,
    alt_text VARCHAR(255),
    is_primary TINYINT DEFAULT 0,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Bảng lịch trình tour
CREATE TABLE IF NOT EXISTS tour_itinerary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    day_number INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    activities JSON,
    meals VARCHAR(255),
    accommodation VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Bảng chính sách tour
CREATE TABLE IF NOT EXISTS tour_policies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    policy_type ENUM('booking', 'cancellation', 'refund', 'change', 'terms') NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Bảng liên kết tour - nhà cung cấp
CREATE TABLE IF NOT EXISTS tour_suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    supplier_id INT NOT NULL,
    service_type VARCHAR(100),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);

-- Bảng bookings
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    booking_date DATE NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Bảng users (nếu cần lưu trong database thay vì hardcode)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'huong_dan_vien') DEFAULT 'huong_dan_vien',
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng nhật ký diễn biến
CREATE TABLE IF NOT EXISTS nhat_ky (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    tieu_de VARCHAR(255) NOT NULL,
    noi_dung TEXT NOT NULL,
    ngay_dien_bien DATE NOT NULL,
    gio_dien_bien TIME,
    dia_diem VARCHAR(255),
    ghi_chu TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Thêm dữ liệu mẫu cho danh mục tour
INSERT INTO tour_categories (name, description) VALUES
('Tour trong nước', 'Tour tham quan, du lịch các địa điểm trong nước'),
('Tour quốc tế', 'Tour tham quan, du lịch các nước ngoài'),
('Tour theo yêu cầu', 'Tour thiết kế riêng dựa trên yêu cầu cụ thể của khách hàng');

-- Thêm dữ liệu mẫu cho nhà cung cấp
INSERT INTO suppliers (name, type, contact_person, phone, email) VALUES
('Khách sạn Hạ Long Bay', 'hotel', 'Nguyễn Văn A', '0243123456', 'info@halongbayhotel.com'),
('Công ty vận tải ABC', 'transport', 'Trần Thị B', '0912345678', 'contact@abctransport.com'),
('Nhà hàng Hương Biển', 'restaurant', 'Lê Văn C', '0923456789', 'huongbien@restaurant.com'),
('Hướng dẫn viên Minh', 'guide', 'Phạm Văn Minh', '0934567890', 'minh.guide@email.com');

-- Thêm dữ liệu mẫu cho tours
INSERT INTO tours (category_id, name, code, description, duration_days, duration_nights, departure_location, destination, max_participants) VALUES
(1, 'Tour Hà Nội - Hạ Long 3N2Đ', 'HN-HL-001', 'Tour khám phá vịnh Hạ Long với 3 ngày 2 đêm', 3, 2, 'Hà Nội', 'Hạ Long', 30),
(1, 'Tour Sài Gòn - Đà Lạt 4N3Đ', 'SG-DL-001', 'Tour nghỉ dưỡng tại thành phố ngàn hoa', 4, 3, 'TP.HCM', 'Đà Lạt', 25),
(1, 'Tour Hội An - Huế 5N4Đ', 'HA-HUE-001', 'Tour khám phá di sản văn hóa miền Trung', 5, 4, 'Đà Nẵng', 'Hội An - Huế', 20),
(2, 'Tour Singapore - Malaysia 7N6Đ', 'SG-MY-001', 'Tour khám phá Singapore và Malaysia', 7, 6, 'TP.HCM', 'Singapore - Malaysia', 15);

-- Thêm dữ liệu mẫu cho giá tour
INSERT INTO tour_prices (tour_id, price_type, price, valid_from, valid_to) VALUES
(1, 'adult', 2500000, '2024-01-01', '2024-12-31'),
(1, 'child', 1800000, '2024-01-01', '2024-12-31'),
(2, 'adult', 3200000, '2024-01-01', '2024-12-31'),
(2, 'child', 2400000, '2024-01-01', '2024-12-31'),
(3, 'adult', 4500000, '2024-01-01', '2024-12-31'),
(4, 'adult', 8500000, '2024-01-01', '2024-12-31');

-- Thêm dữ liệu mẫu cho lịch trình
INSERT INTO tour_itinerary (tour_id, day_number, title, description, activities, meals, accommodation) VALUES
(1, 1, 'Hà Nội - Hạ Long', 'Khởi hành từ Hà Nội, di chuyển đến Hạ Long', '["07:00 - Khởi hành từ Hà Nội", "10:30 - Đến bến tàu Hạ Long", "11:00 - Lên du thuyền", "12:00 - Ăn trưa trên thuyền"]', 'Trưa, Tối', 'Du thuyền Hạ Long'),
(1, 2, 'Khám phá vịnh Hạ Long', 'Tham quan các hang động và đảo đá', '["08:00 - Ăn sáng", "09:00 - Thăm hang Sửng Sốt", "14:00 - Kayak tại Titop", "16:00 - Ngắm hoàng hôn"]', 'Sáng, Trưa, Tối', 'Du thuyền Hạ Long'),
(1, 3, 'Hạ Long - Hà Nội', 'Trở về Hà Nội', '["08:00 - Ăn sáng", "09:00 - Rời du thuyền", "12:00 - Về đến Hà Nội"]', 'Sáng', 'Không');

-- Thêm dữ liệu mẫu cho chính sách
INSERT INTO tour_policies (tour_id, policy_type, title, content) VALUES
(1, 'booking', 'Chính sách đặt tour', 'Khách hàng cần đặt cọc 30% giá tour để giữ chỗ. Thanh toán đầy đủ trước 7 ngày khởi hành.'),
(1, 'cancellation', 'Chính sách hủy tour', 'Hủy trước 15 ngày: hoàn 80%. Hủy trước 7 ngày: hoàn 50%. Hủy trong 7 ngày: không hoàn tiền.'),
(1, 'refund', 'Chính sách hoàn tiền', 'Hoàn tiền trong vòng 7-10 ngày làm việc sau khi xử lý hủy tour.');

-- Thêm dữ liệu mẫu cho tour-suppliers
INSERT INTO tour_suppliers (tour_id, supplier_id, service_type, notes) VALUES
(1, 1, 'Accommodation', 'Khách sạn 4 sao tại Hạ Long'),
(1, 2, 'Transportation', 'Xe 45 chỗ đời mới'),
(1, 3, 'Meals', 'Nhà hàng hải sản'),
(1, 4, 'Guide', 'Hướng dẫn viên có kinh nghiệm');

-- Thêm dữ liệu mẫu cho bookings
INSERT INTO bookings (tour_id, customer_name, customer_email, customer_phone, booking_date, status) VALUES
(1, 'Nguyễn Văn A', 'nguyenvana@email.com', '0901234567', '2024-02-15', 'confirmed'),
(2, 'Trần Thị B', 'tranthib@email.com', '0912345678', '2024-02-20', 'pending'),
(3, 'Lê Văn C', 'levanc@email.com', '0923456789', '2024-02-25', 'confirmed'),
(4, 'Phạm Thị D', 'phamthid@email.com', '0934567890', '2024-03-01', 'pending');

-- Thêm dữ liệu mẫu cho nhật ký
INSERT INTO nhat_ky (tour_id, tieu_de, noi_dung, ngay_dien_bien, gio_dien_bien, dia_diem) VALUES
(1, 'Khởi hành từ Hà Nội', 'Xe khởi hành từ Hà Nội đi Hạ Long, hành khách đầy đủ', '2024-02-15', '07:00:00', 'Hà Nội'),
(1, 'Đến bến tàu Hạ Long', 'Nhóm đã đến bến tàu, chuẩn bị lên du thuyền', '2024-02-15', '10:30:00', 'Bến tàu Hạ Long'),
(2, 'Khởi hành từ Sài Gòn', 'Chuyến bay VN123 khởi hành đúng giờ', '2024-02-20', '06:30:00', 'Sân bay Tân Sơn Nhất'),
(3, 'Tham quan phố cổ Hội An', 'Hành khách tham quan phố cổ, chụp ảnh lưu niệm', '2024-02-25', '15:00:00', 'Phố cổ Hội An');