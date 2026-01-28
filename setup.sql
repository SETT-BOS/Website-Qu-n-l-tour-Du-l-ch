-- Tạo database và bảng mẫu cho dự án
CREATE DATABASE IF NOT EXISTS tourdulich CHARACTER SET utf8 COLLATE utf8_general_ci;

USE tourdulich;

-- Bảng users mẫu
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng tours mẫu  
CREATE TABLE IF NOT EXISTS tours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    duration INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng bookings
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    start_date DATE NOT NULL,
    people INT NOT NULL DEFAULT 1,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'deposited', 'completed', 'cancelled') DEFAULT 'pending',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id)
);

-- Bảng lịch sử thay đổi trạng thái
CREATE TABLE IF NOT EXISTS booking_status_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    old_status ENUM('pending', 'confirmed', 'deposited', 'completed', 'cancelled'),
    new_status ENUM('pending', 'confirmed', 'deposited', 'completed', 'cancelled') NOT NULL,
    changed_by VARCHAR(100),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

-- Dữ liệu mẫu
INSERT INTO tours (name, description, price, duration) VALUES
('Tour Hà Nội - Hạ Long', 'Khám phá vịnh Hạ Long tuyệt đẹp', 2500000, 3),
('Tour Sài Gòn - Đà Lạt', 'Thành phố ngàn hoa', 1800000, 2),
('Tour Phú Quốc', 'Đảo ngọc thiên đường', 3200000, 4);

-- Dữ liệu booking mẫu
INSERT INTO bookings (tour_id, customer_name, customer_phone, start_date, people, total_amount, status) VALUES
(1, 'Nguyễn Văn A', '0901234567', '2024-02-15', 2, 5000000, 'pending'),
(2, 'Trần Thị B', '0987654321', '2024-02-20', 4, 7200000, 'confirmed'),
(3, 'Lê Văn C', '0912345678', '2024-03-01', 1, 3200000, 'deposited');