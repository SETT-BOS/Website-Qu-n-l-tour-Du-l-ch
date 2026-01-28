<?php

/*=========================================================
|  PATH FUNCTIONS
=========================================================*/

// Tạo path tuyệt đối tới file view
function view_path(string $view): string
{
    $normalized = str_replace('.', DIRECTORY_SEPARATOR, $view);
    return BASE_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $normalized . '.php';
}

// Tạo path tuyệt đối tới block layout
function block_path(string $block): string
{
    return BASE_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'blocks' . DIRECTORY_SEPARATOR . $block . '.php';
}


/*=========================================================
|  LAYOUT ENGINE (HỆ THỐNG GIAO DIỆN CHUẨN)
=========================================================*/

$GLOBALS['current_layout'] = null;
$GLOBALS['layout_data'] = [];

// Đăng ký layout trước khi render view
function layout(string $layoutName, array $data = []): void
{
    $GLOBALS['current_layout'] = $layoutName;
    $GLOBALS['layout_data'] = $data;
}

// Render view & nhét vào layout
function view(string $view, array $data = []): void
{
    $file = view_path($view);

    if (!file_exists($file)) {
        throw new RuntimeException("View '{$view}' not found at {$file}");
    }

    extract($data, EXTR_OVERWRITE);

    // Lấy nội dung view
    ob_start();
    include $file;
    $content = ob_get_clean();

    // Nếu có layout
    if ($GLOBALS['current_layout']) {

        $layoutFile = BASE_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $GLOBALS['current_layout'] . '.php';

        if (file_exists($layoutFile)) {
            $layoutData = array_merge($GLOBALS['layout_data'], ['content' => $content]);
            extract($layoutData, EXTR_OVERWRITE);
            include $layoutFile;
        } else {
            echo "Layout not found: " . $layoutFile;
            echo $content;
        }

        // Reset layout
        $GLOBALS['current_layout'] = null;
        $GLOBALS['layout_data'] = [];

    } else {
        echo $content;
    }
}

// Include 1 block trong layout
function block(string $block, array $data = []): void
{
    $file = block_path($block);
    if (!file_exists($file)) {
        throw new RuntimeException("Block '{$block}' not found at {$file}");
    }
    extract($data, EXTR_OVERWRITE);
    include $file;
}


/*=========================================================
|  ASSET
=========================================================*/

function asset(string $path): string
{
    return rtrim(BASE_URL, '/') . '/public/' . ltrim($path, '/');
}


/*=========================================================
|  SESSION + USER AUTH
=========================================================*/

function startSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function loginUser($user)
{
    startSession();
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_name'] = $user->name;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_role'] = $user->role;
}

function logoutUser()
{
    startSession();
    session_destroy();
}

function isLoggedIn()
{
    startSession();
    return isset($_SESSION['user_id']);
}

function getCurrentUser()
{
    if (!isLoggedIn()) return null;

    startSession();
    return new User([
        'id'    => $_SESSION['user_id'],
        'name'  => $_SESSION['user_name'],
        'email' => $_SESSION['user_email'],
        'role'  => $_SESSION['user_role']
    ]);
}

function isAdmin()
{
    $user = getCurrentUser();
    return $user && $user->isAdmin();
}

function isGuide()
{
    $user = getCurrentUser();
    return $user && $user->isGuide();
}

// Kiểm tra user thường (hướng dẫn viên)
function isUser()
{
    $user = getCurrentUser();
    return $user && $user->role === 'huong_dan_vien';
}

function getUserType()
{
    if (isAdmin()) return 'admin';
    if (isUser()) return 'user';
    return 'guest';
}

function getUserTypeLabel()
{
    return [
        'admin' => 'Quản trị viên',
        'user'  => 'Hướng dẫn viên',
        'guest' => 'Khách'
    ][getUserType()];
}

// Lấy chữ cái cuối để làm avatar chữ cái
function getLastNameInitial($fullName)
{
    $words = explode(' ', trim($fullName));
    return strtoupper(substr(end($words), 0, 1));
}

// Avatar (admin dùng ảnh, user dùng chữ cái)
function getUserAvatarHtml($user, $size = 40, $classes = '')
{
    if ($user->role === 'admin') {
        $avatarSrc = $_SESSION['user_avatar_' . $user->id] ?? asset('dist/assets/img/user2-160x160.jpg');
        return '<img src="' . $avatarSrc . '" class="' . $classes . '" style="width:' . $size . 'px;height:' . $size . 'px;object-fit:cover;">';
    }

    $initial = getLastNameInitial($user->name);
    return '<div class="' . $classes . '" style="width:' . $size . 'px;height:' . $size . 'px;background:linear-gradient(135deg,#007bff,#0056b3);color:white;display:flex;align-items:center;justify-content:center;font-size:' . ($size * 0.4) . 'px;font-weight:bold;">' . $initial . '</div>';
}


/*=========================================================
|  PERMISSION
=========================================================*/

function requireLogin($redirectUrl = null)
{
    if (!isLoggedIn()) {
        $redirect = $redirectUrl ?: $_SERVER['REQUEST_URI'];
        header('Location: ' . BASE_URL . '?act=login&redirect=' . urlencode($redirect));
        exit;
    }
}

function requireAdmin()
{
    requireLogin();
    if (!isAdmin()) {
        header("Location: " . BASE_URL);
        exit;
    }
}

function requireGuideOrAdmin()
{
    requireLogin();
    if (!isGuide() && !isAdmin()) {
        header("Location: " . BASE_URL);
        exit;
    }
}


/*=========================================================
|  BÁO CÁO VẬN HÀNH
=========================================================*/

function getTourCount()
{
    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT COUNT(*) FROM tours WHERE status = 1");
        $stmt->execute();
        return $stmt->fetchColumn();
    } catch (Exception $e) {
        return 0;
    }
}

function getBookingCount()
{
    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT COUNT(*) FROM bookings");
        $stmt->execute();
        return $stmt->fetchColumn();
    } catch (Exception $e) {
        return 0;
    }
}

function getNhanSuCount()
{
    return 4; // hoặc query DB nếu bạn muốn
}

