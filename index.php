<?php 
    require_once "controllers/clientController.php";
    $page = $_GET['page'] ?? 'client';
    //tham số truy vấn lần 2 trên url
    $action = $_GET['action']??'index';
    //khởi tạo biến controller
    $controller = null;
    switch($page) {
    case "client":
        //Gọi đối tượng vào
        $controller = new ClientController();
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
        default:
        echo "404 trang không tìm thấy!";
    }