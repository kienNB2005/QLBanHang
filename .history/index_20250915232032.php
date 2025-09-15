<?php
session_start();

require_once "controllers/clientController.php";
require_once "controllers/cartController.php";
require_once "controllers/paymentController.php";

$page = $_GET['page'] ?? 'client';
$action = $_GET['action'] ?? 'index';
$controller = null;

switch ($page) {
    case 'client':
        $controller = new ClientController();
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'displayLogin':
                $controller->displayLogin();
                break;
            case 'displayRegister':
                $controller->displayRegister();
                break;
            case 'register':
                $controller->register();
                break;
            case 'login':
                $controller->login();
                break;
            case 'logout':
                $controller->logout();
                break;
            default:
                echo "Action Không tồn tại!";
                break;
        }
        break;

    case 'cart':
        $controller = new CartController(); // instantiate controller
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'addNew':
                $controller->addNew();
                break;
            case 'addOrSub':
                $controller->addOrSub();
                break;
            case 'delete':              // form nên submit ?page=cart&action=delete
                $controller->delete();  // gọi method delete() trong controller
                break;
            default:
                echo "Action Không tồn tại!";
                break;
        }
        break;
    case 'order':
        $controller = new ClientOrderController();
        switch ($action) {
            case 'checkout':
                $controller->checkout();
                break;
            case 'process':
                $controller->process();
                break;
            default:
                echo "Action Không tồn tại!";
                break;
        }
        break;

    // case 'payment':
    //     $controller = new PaymentController();
    //     switch ($action) {
    //         case 'index':
    //             $controller->index();
    //             break;
    //         case 'addNew':
    //             $controller->addNew();
    //             break;
    //         case 'addOrSub':
    //             $controller->addOrSub();
    //             break;
    //         default:
    //             echo "Action Không tồn tại!";
    //             break;
    //     }
    //     break;

    default:
        echo "404 trang không tìm thấy!";
        break;

}
