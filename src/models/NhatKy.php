<?php

class NhatKy {
    private $db;
    
    public function __construct($database) {
        $this->db = $database;
    }
    
    public function getAll() {
        try {
            $stmt = $this->db->prepare("SELECT nk.*, t.name as tour_name FROM nhat_ky nk LEFT JOIN tours t ON nk.tour_id = t.id ORDER BY nk.ngay_dien_bien DESC, nk.gio_dien_bien DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Nếu bảng chưa tồn tại, trả về mảng rỗng
            return [];
        }
    }
    
    public function getByTourId($tourId) {
        $stmt = $this->db->prepare("SELECT * FROM nhat_ky WHERE tour_id = ? ORDER BY ngay_dien_bien DESC, gio_dien_bien DESC");
        $stmt->execute([$tourId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO nhat_ky (tour_id, tieu_de, noi_dung, ngay_dien_bien, gio_dien_bien, dia_diem, ghi_chu, loai_su_kien, muc_do_nghiem_trong, nguoi_ghi, phan_hoi_khach, danh_gia_hdv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['tour_id'],
            $data['tieu_de'],
            $data['noi_dung'],
            $data['ngay_dien_bien'],
            $data['gio_dien_bien'],
            $data['dia_diem'] ?? null,
            $data['ghi_chu'] ?? null,
            $data['loai_su_kien'] ?? 'dien_bien',
            $data['muc_do_nghiem_trong'] ?? 'binh_thuong',
            $data['nguoi_ghi'] ?? null,
            $data['phan_hoi_khach'] ?? null,
            $data['danh_gia_hdv'] ?? null
        ]);
    }
    
    public function createSuCo($data) {
        $data['loai_su_kien'] = 'su_co';
        return $this->create($data);
    }
    
    public function createPhanHoi($data) {
        $data['loai_su_kien'] = 'phan_hoi_khach';
        return $this->create($data);
    }
    
    public function createDanhGiaHDV($data) {
        $data['loai_su_kien'] = 'danh_gia_hdv';
        return $this->create($data);
    }
    
    public function getTours() {
        $stmt = $this->db->prepare("SELECT id, name FROM tours WHERE status = 1 ORDER BY name");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}