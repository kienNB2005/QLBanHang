<?php 
session_start();
//truyền tệp từ controller
require_once "controllers/dashboardController.php";
require_once "controllers/categoryController.php";
require_once "controllers/productController.php";
require_once "controllers/userController.php";
require_once "controllers/orderController.php";
//tham số truy vấn lần 1 trên url
$page = $_GET['page'] ?? 'dashboard';
//tham số truy vấn lần 2 trên url
$action = $_GET['action']??'index';
//khởi tạo biến controller
$controller = null;
//kiểm tra tham số truy vấn lần 1
if(!isset($_SESSION['user'])&&!($page ==='user' && ($action === 'login' || $action === 'displayLogin'))){
    header("Location: admin.php?page=user&action=displayLogin");
    exit;
}
if (isset($_SESSION['user']) && !in_array($_SESSION['user']['role_id'], [1, 2])) {
    echo "Bạn không có quyền truy cập vào trang admin!";
    exit;
}
switch($page) {
    case "dashboard":
        //Gọi đối tượng vào
        $controller = new dashboardController();
        //kiểm tra tham số truy vấn lần 2
        switch($action){
            case 'index':
                //Gọi phương thức ra bên ngoài
                $controller->index();
                break;
            default:
            echo "Action Không tồn tại! ";
        }
        break;
    case "category":
        $controller = new categoryController();
        switch ($action){
            case 'index':
                $controller->index();
                break;
            case 'displayInfo':
                $controller->displayInfo();
                break;
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
            echo "Action Không tồn tại! ";
        }
        break;
    case "product":
        $controller = new ProductController();
        switch ($action){
            case 'index':
                $controller->index();
                break;
            case 'displayInfo':
                $controller->displayInfo();
                break;
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
            echo "Action Không tồn tại! ";
        }
        break;
        case "user":
        $controller = new UserController();
        switch ($action){
            case 'index':
                $controller->index();
                break;
            case 'displayInfo':
                $controller->displayInfo();
                break;
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            case 'displayLogin':
                $controller->displayLogin();
                break;
            case 'login':
                $controller->login();
                break;
            case 'logout':
                $controller->logout();
                break;
            default:
            echo "Action Không tồn tại! ";
        }
        break;
        case "order":
        $controller = new orderController();
        switch ($action){
            case 'index':
                $controller->index();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
            echo "Action Không tồn tại! ";
        }
        break;
        default:
        echo "404 trang không tìm thấy!";
}