<?php
require_once __DIR__ . '/../helpers/database.php';

class Booking {
    // 1. Tạo đơn hàng mới
    public function create($data) {
        $db = getDB();
        
        // Đóng gói thông tin khách
        $info = json_encode([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? '',
            'people' => $data['people'],
            'total' => $data['total']
        ], JSON_UNESCAPED_UNICODE);

        // Lưu vào cột service_detail
        $sql = "INSERT INTO bookings (tour_id, start_date, service_detail, notes, status, created_at) 
                VALUES (:tour_id, :start_date, :info, :notes, 1, NOW())";
        
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'tour_id' => $data['tour_id'],
            'start_date' => $data['start_date'],
            'info' => $info,
            'notes' => $data['request'] ?? ''
        ]);
    }

    // 2. Lấy danh sách đơn hàng
    public function getAll() {
        $db = getDB();
        $sql = "SELECT b.*, t.name as tour_name, s.name as status_name 
                FROM bookings b 
                LEFT JOIN tours t ON b.tour_id = t.id 
                LEFT JOIN tour_statuses s ON b.status = s.id 
                ORDER BY b.created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 3. Cập nhật trạng thái
    public function updateStatus($id, $status) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    // 4. Xóa đơn hàng
    public function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM bookings WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
        public function count() {
        $db = getDB();
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM bookings");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    // 6. Lấy doanh thu theo tháng
    public function getRevenueByMonth($thang) {
        $db = getDB();
        $sql = "SELECT COUNT(*) as total FROM bookings WHERE DATE_FORMAT(created_at, '%Y-%m') = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$thang]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    // 7. Lấy doanh thu trong khoảng thời gian
    public function getRevenueReport($tuNgay, $denNgay) {
        $db = getDB();
        $sql = "SELECT COUNT(*) as total FROM bookings WHERE created_at BETWEEN ? AND ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$tuNgay, $denNgay]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    // 8. Lấy doanh thu chi tiết theo tour
    public function getRevenueByTour($tuNgay, $denNgay) {
        $db = getDB();
        $sql = "SELECT t.*, COUNT(b.id) as total_bookings
                FROM tours t
                LEFT JOIN bookings b ON t.id = b.tour_id AND b.created_at BETWEEN ? AND ?
                GROUP BY t.id
                ORDER BY total_bookings DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute([$tuNgay, $denNgay]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}