<?php
require_once __DIR__ . '/../models/Tour.php'; 

class TourController {
    // 1. Hiển thị danh sách tour
    public function index() {
        $tourModel = new Tour(); 
        $tours = $tourModel->getAll();
        view('tours.index', ['tours' => $tours, 'title' => 'Quản lý & Bán Tour']);
    }

    // 2. Hiển thị trang đặt chỗ (booking)
    public function detail() {
        $id = $_GET['id'] ?? 0;
        $tour = (new Tour())->getById($id);
        view('tours.detail', ['tour' => $tour, 'title' => 'Đặt Tour']);
    }

    // 3. Hiển thị form Thêm/Sửa
    public function form() {
        $id = $_GET['id'] ?? null;
        $tour = null;
        $title = 'Thêm Tour Mới';

        if ($id) {
            $tour = (new Tour())->getById($id);
            $title = 'Cập nhật Tour';
        }
        view('tours.form', ['tour' => $tour, 'title' => $title]);
    }

    // 4. Lưu dữ liệu (Thêm hoặc Sửa)
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new Tour();
            $data = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'description' => $_POST['description']
            ];

            if (!empty($_POST['id'])) {
                $model->update($_POST['id'], $data); // Sửa
            } else {
                $model->create($data); // Thêm mới
            }
            
            header('Location: ' . BASE_URL . 'tours');
            exit;
        }
    }

    // 5. Xóa Tour (Hàm bạn đang thiếu/lỗi)
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            (new Tour())->delete($id);
        }
        header('Location: ' . BASE_URL . 'tours');
        exit;
    }
}