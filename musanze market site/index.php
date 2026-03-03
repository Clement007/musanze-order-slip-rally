<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$base = dirname(__DIR__);

// Dynamic BASE_URL - works perfectly on InfinityFree
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
define('BASE_URL', $protocol . '://' . $host . '/');

require_once $base . '/config/database.php';
require_once $base . '/app/models/User.php';
require_once $base . '/app/models/Supplier.php';
require_once $base . '/app/models/Order.php';
require_once $base . '/app/controllers/AuthController.php';
require_once $base . '/app/controllers/SupplierController.php';
require_once $base . '/app/controllers/OrderController.php';
require_once $base . '/app/controllers/DashboardController.php';

function requireAuth(): void {
    if (empty($_SESSION['user_id'])) {
        header('Location: /public/index.php?route=login');
        exit;
    }
}

$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'login':
        (new AuthController())->login();
        break;
    case 'logout':
        (new AuthController())->logout();
        break;
    case 'home':
    case 'dashboard':
        requireAuth();
        (new DashboardController())->index();
        break;
    case 'suppliers':
        requireAuth();
        (new SupplierController())->index();
        break;
    case 'suppliers/create':
        requireAuth();
        (new SupplierController())->create();
        break;
    case 'suppliers/edit':
        requireAuth();
        (new SupplierController())->edit((int)($_GET['id'] ?? 0));
        break;
    case 'suppliers/delete':
        requireAuth();
        (new SupplierController())->delete((int)($_GET['id'] ?? 0));
        break;
    case 'orders':
        requireAuth();
        (new OrderController())->index();
        break;
    case 'orders/create':
        requireAuth();
        (new OrderController())->create();
        break;
    case 'orders/view':
        requireAuth();
        (new OrderController())->view((int)($_GET['id'] ?? 0));
        break;
    case 'orders/edit':
        requireAuth();
        (new OrderController())->edit((int)($_GET['id'] ?? 0));
        break;
    case 'orders/delete':
        requireAuth();
        (new OrderController())->delete((int)($_GET['id'] ?? 0));
        break;
    case 'orders/receipt':
        requireAuth();
        (new OrderController())->receipt((int)($_GET['id'] ?? 0));
        break;
    default:
        http_response_code(404);
        require $base . '/app/views/partials/header.php';
        echo '<main class="container"><div class="alert alert--danger" style="margin-top:2rem"><h2>404 - Not Found</h2><a href="/public/index.php?route=dashboard" class="btn btn--primary">Go Home</a></div></main>';
        require $base . '/app/views/partials/footer.php';
        break;
}
