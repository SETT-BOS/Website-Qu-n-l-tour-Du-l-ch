<?php
require_once __DIR__ . '/../helpers/database.php';

class Tour {
    // 1. Lấy tất cả tour
    public function getAll() {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM tours ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 2. Lấy 1 tour theo ID
    public function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM tours WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // 3. Thêm tour mới
    public function create($data) {
        $db = getDB();
        $sql = "INSERT INTO tours (name, price, description, status) VALUES (:name, :price, :desc, 1)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
            'desc' => $data['description']
        ]);
    }

    // 4. Cập nhật tour
    public function update($id, $data) {
        $db = getDB();
        $sql = "UPDATE tours SET name = :name, price = :price, description = :desc WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
            'desc' => $data['description'],
            'id' => $id
        ]);
    }

    // 5. Xóa tour
    public function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM tours WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
     public function count()
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM tours");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }

public function getPopularTours($limit = 5)
    {
        $db = getDB();
        $sql = "SELECT t.*, COUNT(b.id) as booking_count 
                FROM tours t
                LEFT JOIN bookings b ON t.id = b.tour_id
                GROUP BY t.id 
                ORDER BY booking_count DESC 
                LIMIT ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTourPerformance($thang)
    {
        $db = getDB();
        $sql = "SELECT t.*, COUNT(b.id) as total_bookings
                FROM tours t
                LEFT JOIN bookings b ON t.id = b.tour_id AND DATE_FORMAT(b.created_at, '%Y-%m') = ?
                GROUP BY t.id
                ORDER BY total_bookings DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute([$thang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    }
