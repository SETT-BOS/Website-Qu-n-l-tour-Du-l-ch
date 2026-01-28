<?php

class NhanSuController {
    public function index(): void {
        requireLogin();
        $hdvList = $_SESSION['hdv_list'] ?? [];
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['success']);
        view('nhansu/index', ['hdvList' => $hdvList, 'success' => $success]);
    }

    public function create(): void {
        requireAdmin(); // Chỉ admin mới được tạo mới
        $errors = $_SESSION['errors'] ?? [];
        $oldData = $_SESSION['old_data'] ?? [];
        unset($_SESSION['errors'], $_SESSION['old_data']);
        view('nhansu/create', ['errors' => $errors, 'oldData' => $oldData]);
    }

    public function store(): void {
        requireAdmin(); // Chỉ admin mới được lưu
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'nhansu');
            return;
        }
        
        // Validate required fields
        $errors = [];
        if (empty($_POST['ho_ten'])) {
            $errors[] = 'Họ tên là bắt buộc';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;
            header('Location: ' . BASE_URL . 'nhansu/create');
            return;
        }
        
        // Process form data
        $hdvData = [
            'ho_ten' => $_POST['ho_ten'] ?? '',
            'ngay_sinh' => $_POST['ngay_sinh'] ?? '',
            'gioi_tinh' => $_POST['gioi_tinh'] ?? 'Nam',
            'dien_thoai' => $_POST['dien_thoai'] ?? '',
            'email' => $_POST['email'] ?? '',
            'dia_chi' => $_POST['dia_chi'] ?? '',
            'nhom_hdv' => $_POST['nhom_hdv'] ?? 'noi_dia',
            'ngon_ngu' => $_POST['ngon_ngu'] ?? [],
            'kinh_nghiem' => $_POST['kinh_nghiem'] ?? 0,
            'chung_chi' => $_POST['chung_chi'] ?? '',
            'suc_khoe' => $_POST['suc_khoe'] ?? 'tot',
            'trang_thai' => $_POST['trang_thai'] ?? 'ranh',
            'ghi_chu' => $_POST['ghi_chu'] ?? ''
        ];
        
        // Handle file upload
        if (isset($_FILES['anh_dai_dien']) && $_FILES['anh_dai_dien']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'public/uploads/hdv/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = time() . '_' . $_FILES['anh_dai_dien']['name'];
            $uploadPath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['anh_dai_dien']['tmp_name'], $uploadPath)) {
                $hdvData['anh_dai_dien'] = 'uploads/hdv/' . $fileName;
            }
        }
        
        // Save to session (simulate database save)
        if (!isset($_SESSION['hdv_list'])) {
            $_SESSION['hdv_list'] = [];
        }
        $hdvData['id'] = count($_SESSION['hdv_list']) + 1;
        $hdvData['ma_hdv'] = 'HDV' . str_pad($hdvData['id'], 3, '0', STR_PAD_LEFT);
        $_SESSION['hdv_list'][] = $hdvData;
        
        $_SESSION['success'] = 'Thêm HDV thành công!';
        header('Location: ' . BASE_URL . 'nhansu');
    }

    public function view(): void {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $hdv = null;
        
        // Find HDV by ID in session
        if (isset($_SESSION['hdv_list'])) {
            foreach ($_SESSION['hdv_list'] as $item) {
                if ($item['id'] == $id) {
                    $hdv = $item;
                    break;
                }
            }
        }
        
        // If not found in session, use default data
        if (!$hdv) {
            $hdv = [
                'id' => $id,
                'ma_hdv' => 'HDV' . str_pad($id, 3, '0', STR_PAD_LEFT),
                'ho_ten' => 'Nguyễn Văn A',
                'ngay_sinh' => '15/03/1985',
                'gioi_tinh' => 'Nam',
                'dien_thoai' => '0901234567',
                'email' => 'nguyenvana@email.com',
                'dia_chi' => 'Hà Nội, Việt Nam',
                'nhom_hdv' => 'Tour quốc tế',
                'ngon_ngu' => ['Tiếng Anh', 'Tiếng Nhật'],
                'kinh_nghiem' => '8',
                'chung_chi' => 'Chứng chỉ HDV quốc tế, TOEIC 850',
                'suc_khoe' => 'Tốt',
                'trang_thai' => 'Rảnh',
                'ghi_chu' => 'HDV có kinh nghiệm dẫn tour châu Âu'
            ];
        }
        
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['success']);
        
        view('nhansu/view', ['hdv' => $hdv, 'success' => $success]);
    }

    public function edit(): void {
        requireAdmin(); // Chỉ admin mới được sửa
        $id = (int)($_GET['id'] ?? 0);
        $hdv = null;
        
        // Find HDV by ID in session
        if (isset($_SESSION['hdv_list'])) {
            foreach ($_SESSION['hdv_list'] as $item) {
                if ($item['id'] == $id) {
                    $hdv = $item;
                    break;
                }
            }
        }
        
        // If not found in session, use default data
        if (!$hdv) {
            $hdv = [
                'id' => $id,
                'ho_ten' => 'Nguyễn Văn A',
                'ngay_sinh' => '1985-03-15',
                'gioi_tinh' => 'Nam',
                'dien_thoai' => '0901234567',
                'email' => 'nguyenvana@email.com',
                'dia_chi' => 'Hà Nội, Việt Nam',
                'nhom_hdv' => 'quoc_te',
                'ngon_ngu' => ['tieng_anh', 'tieng_nhat', 'tieng_phap'],
                'kinh_nghiem' => '8',
                'chung_chi' => 'Chứng chỉ HDV quốc tế\nTOEIC 850\nChứng chỉ sơ cấp cứu',
                'suc_khoe' => 'tot',
                'trang_thai' => 'ranh',
                'ghi_chu' => 'HDV có kinh nghiệm dẫn tour châu Âu'
            ];
        }
        
        $errors = $_SESSION['errors'] ?? [];
        unset($_SESSION['errors']);
        view('nhansu/edit', ['hdv' => $hdv, 'errors' => $errors]);
    }

    public function update(): void {
        requireAdmin(); // Chỉ admin mới được cập nhật
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'nhansu');
            return;
        }
        
        $id = (int)($_POST['id'] ?? 0);
        
        // Validate required fields
        $errors = [];
        if (empty($_POST['ho_ten'])) {
            $errors[] = 'Họ tên là bắt buộc';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ' . BASE_URL . 'nhansu/edit/' . $id);
            return;
        }
        
        // Handle file upload for update
        if (isset($_FILES['anh_dai_dien']) && $_FILES['anh_dai_dien']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'public/uploads/hdv/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = time() . '_' . $_FILES['anh_dai_dien']['name'];
            $uploadPath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES['anh_dai_dien']['tmp_name'], $uploadPath)) {
                $newAvatar = 'uploads/hdv/' . $fileName;
            }
        }
        
        // Update HDV data in session
        if (isset($_SESSION['hdv_list'])) {
            foreach ($_SESSION['hdv_list'] as &$hdv) {
                if ($hdv['id'] == $id) {
                    $hdv['ho_ten'] = $_POST['ho_ten'] ?? $hdv['ho_ten'];
                    $hdv['ngay_sinh'] = $_POST['ngay_sinh'] ?? $hdv['ngay_sinh'];
                    $hdv['gioi_tinh'] = $_POST['gioi_tinh'] ?? $hdv['gioi_tinh'];
                    $hdv['dien_thoai'] = $_POST['dien_thoai'] ?? $hdv['dien_thoai'];
                    $hdv['email'] = $_POST['email'] ?? $hdv['email'];
                    $hdv['dia_chi'] = $_POST['dia_chi'] ?? $hdv['dia_chi'];
                    $hdv['nhom_hdv'] = $_POST['nhom_hdv'] ?? $hdv['nhom_hdv'];
                    $hdv['ngon_ngu'] = $_POST['ngon_ngu'] ?? $hdv['ngon_ngu'];
                    $hdv['kinh_nghiem'] = $_POST['kinh_nghiem'] ?? $hdv['kinh_nghiem'];
                    $hdv['chung_chi'] = $_POST['chung_chi'] ?? $hdv['chung_chi'];
                    $hdv['suc_khoe'] = $_POST['suc_khoe'] ?? $hdv['suc_khoe'];
                    $hdv['trang_thai'] = $_POST['trang_thai'] ?? $hdv['trang_thai'];
                    $hdv['ghi_chu'] = $_POST['ghi_chu'] ?? $hdv['ghi_chu'];
                    if (isset($newAvatar)) {
                        $hdv['anh_dai_dien'] = $newAvatar;
                    }
                    break;
                }
            }
        }
        
        $_SESSION['success'] = 'Cập nhật thông tin HDV thành công!';
        header('Location: ' . BASE_URL . 'nhansu/view/' . $id);
    }

    public function history(): void {
        $id = (int)($_GET['id'] ?? 0);
        view('nhansu/history', ['id' => $id]);
    }

    public function assign(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'nhansu');
            return;
        }
        header('Location: ' . BASE_URL . 'nhansu');
    }
}