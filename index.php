<?php 
    session_start();
    require_once "controllers/clientController.php";
    require_once "controllers/cartController.php";
    require_once "controllers/paymentController.php";
//     if (!isset($_SESSION['user'])) {
//     if (!isset($_SESSION['cart_session'])) {
//         $_SESSION['cart_session'] = session_id();
//     }
// }
    $page = $_GET['page'] ?? 'client';
    //tham số truy vấn lần 2 trên url
    $action = $_GET['action']??'index';
    //khởi tạo biến controller
    $controller = null;
    switch($page) {
    case "client":
        
        $controller = new ClientController();
     
        switch($action){
            case 'index':
                //Gọi phương thức ra bên ngoài
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
            echo "Action Không tồn tại! ";
        }
        break;
        case "cart":
        $controller = new cartController();
        switch($action){
            case 'index':
                $controller->index();
                break;
            case 'addNew':
                $controller->addNew();
                break;
            case 'addOrSub':
                $controller->addOrSub();
                break;
            default:
            echo "Action Không tồn tại! ";
        }
        break;
        case "payment":
        $controller = new paymentController();
        switch($action){
            case 'index':
                $controller->index();
                break;
            case 'addNew':
                $controller->addNew();
                break;
            case 'addOrSub':
                $controller->addOrSub();
                break;
            default:
            echo "Action Không tồn tại! ";
        }
        break;
        default:
        echo "404 trang không tìm thấy!";
    }