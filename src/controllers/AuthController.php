<?php

// Controller xử lý các chức năng liên quan đến xác thực (đăng nhập, đăng xuất)
class AuthController
{
    
    // Hiển thị form đăng nhập cho user
    public function login()
    {
        // Nếu đã đăng nhập rồi thì chuyển về trang home
        if (isLoggedIn()) {
            header('Location: ' . BASE_URL . 'home');
            exit;   
        }

        // Lấy URL redirect nếu có (để quay lại trang đang xem sau khi đăng nhập)
        // Mặc định redirect về trang home
        $redirect = $_GET['redirect'] ?? BASE_URL . 'home';
        
        // Xóa avatar cũ khi đăng nhập lại
        unset($_SESSION['user_avatar']);

        // Hiển thị view login
        view('auth.login', [
            'title' => 'Đăng nhập hệ thống',
            'redirect' => $redirect,
        ]);
    }

    // Hiển thị form đăng nhập cho admin
    public function adminLogin()
    {
        // Nếu đã đăng nhập rồi thì chuyển về trang home
        if (isLoggedIn()) {
            header('Location: ' . BASE_URL . 'home');
            exit;   
        }

        // Lấy URL redirect nếu có
        $redirect = $_GET['redirect'] ?? BASE_URL . 'home';

        // Hiển thị view admin login
        view('auth.admin-login', [
            'title' => 'Đăng nhập Admin',
            'redirect' => $redirect,
        ]);
    }

    // Xử lý đăng nhập chung (nhận dữ liệu từ form POST)
    public function checkLogin()
    {
        // Chỉ xử lý khi là POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        // Lấy dữ liệu từ form
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $redirect = $_POST['redirect'] ?? BASE_URL . 'home';

        // Danh sách 4 tài khoản admin được phép
        $validAdmins = [
            'PH59005' => ['name' => 'Nhật Linh', 'password' => '10032006'],
            'PH59186' => ['name' => 'Văn Tuân', 'password' => '12345678'],
            'PH58731' => ['name' => 'Văn Công', 'password' => '12345678'],
            'PH59195' => ['name' => 'Quốc Tùng', 'password' => '12345678'],
        ];

        // Validate dữ liệu đầu vào
        $errors = [];

        if (empty($email)) {
            $errors[] = 'Vui lòng nhập tài khoản';
        }

        if (empty($password)) {
            $errors[] = 'Vui lòng nhập mật khẩu';
        }

        // Nếu có lỗi validation thì quay lại form login
        if (!empty($errors)) {
            view('auth.login', [
                'title' => 'Đăng nhập hệ thống',
                'errors' => $errors,
                'email' => $email,
                'redirect' => $redirect,
            ]);
            return;
        }

        // Kiểm tra xem có phải admin không
        if (isset($validAdmins[$email]) && $validAdmins[$email]['password'] === $password) {
            // Đăng nhập với quyền admin
            $user = new User([
                'id' => 999,
                'name' => $validAdmins[$email]['name'],
                'email' => $email,
                'role' => 'admin',
                'status' => 1,
            ]);
        } else {
            // Đăng nhập với quyền user thông thường (không kiểm tra mật khẩu)
            $user = new User([
                'id' => 1,
                'name' => 'Hướng dẫn viên',
                'email' => $email,
                'role' => 'huong_dan_vien',
                'status' => 1,
            ]);
        }

        // Đăng nhập thành công: lưu vào session
        loginUser($user);

        // Chuyển hướng về trang được yêu cầu hoặc trang chủ
        header('Location: ' . $redirect);
        exit;
    }

    // Xử lý đăng nhập cho admin
    public function checkAdminLogin()
    {
        // Chỉ xử lý khi là POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'admin/login');
            exit;
        }

        // Lấy dữ liệu từ form
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $redirect = $_POST['redirect'] ?? BASE_URL . 'home';

        // Danh sách 4 tài khoản admin được phép
        $validAdmins = [
            'PH59005' => ['name' => 'Nhật Linh', 'password' => '10032006'],
            'PH59186' => ['name' => 'Văn Tuân', 'password' => '12345678'],
            'PH58731' => ['name' => 'Văn Công', 'password' => '12345678'],
            'PH59195' => ['name' => 'Quốc Tùng', 'password' => '12345678'],
        ];

        // Validate dữ liệu đầu vào
        $errors = [];

        if (empty($email)) {
            $errors[] = 'Vui lòng nhập tài khoản admin';
        }

        if (empty($password)) {
            $errors[] = 'Vui lòng nhập mật khẩu admin';
        }

        // Kiểm tra tài khoản có trong danh sách được phép không
        if (!empty($email) && !empty($password)) {
            if (!isset($validAdmins[$email]) || $validAdmins[$email]['password'] !== $password) {
                $errors[] = 'Tài khoản hoặc mật khẩu không đúng';
            }
        }

        // Nếu có lỗi validation thì quay lại form admin login
        if (!empty($errors)) {
            view('auth.admin-login', [
                'title' => 'Đăng nhập Admin',
                'errors' => $errors,
                'email' => $email,
                'redirect' => $redirect,
            ]);
            return;
        }

        // Tạo admin với thông tin thực
        $admin = new User([
            'id' => 999,
            'name' => $validAdmins[$email]['name'],
            'email' => $email,
            'role' => 'admin',
            'status' => 1,
        ]);

        // Đăng nhập thành công: lưu vào session
        loginUser($admin);

        // Chuyển hướng về trang được yêu cầu hoặc trang chủ
        header('Location: ' . $redirect);
        exit;
    }

    // Hiển thị trang thông tin tài khoản
    public function profile()
    {
        // Yêu cầu đăng nhập
        requireLogin();

        // Hiển thị view profile
        view('auth.profile', [
            'title' => 'Thông tin tài khoản',
        ]);
    }

    // Xử lý đăng xuất
    public function logout()
    {
        // Xóa session và đăng xuất
        logoutUser();

        // Chuyển hướng về trang welcome
        header('Location: ' . BASE_URL . 'welcome');
        exit;
    }

    // Xử lý upload avatar
    public function uploadAvatar()
    {
        // Yêu cầu đăng nhập
        requireLogin();
        
        // Chỉ xử lý POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            exit;
        }
        
        // Lấy dữ liệu JSON
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (isset($input['avatar'])) {
            // Lưu ảnh vào session theo user ID
            $userId = getCurrentUser()->id;
            $_SESSION['user_avatar_' . $userId] = $input['avatar'];
            
            echo json_encode(['success' => true, 'message' => 'Avatar uploaded successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No avatar data received']);
        }
        exit;
    }
}

