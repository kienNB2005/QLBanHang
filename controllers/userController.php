<?php
    require './models/user.php';
    class UserController{
        private $modelUser;
        function __construct(){
            $this->modelUser = new User();
        }

        function index(){
            $limit = 5; // số sản phẩm mỗi trang
            $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";
            $role = isset($_GET['role']) ? $_GET['role'] : "";
            if ($page < 1) $page = 1;
            $start = ($page - 1) * $limit;
            // $products = $this->modelProducts-> getProducts($start, $limit, $keyword);
            $totalRow = $this->modelUser->TotalUser($keyword, $role);
            $totalPage = ceil($totalRow / $limit);
            $datas = $this -> modelUser-> getUser($start,$limit,$keyword, $role);
            include "views/admin/users/index.php";
        }

        function displayInfo(){
            include "views/admin/users/create.php";
        }

        function create (){
            if ($_SESSION['user']['role_id'] != 1) {
            echo "Bạn không có quyền chỉnh sửa!";
            return;
            }
            if($_SERVER ['REQUEST_METHOD'] == 'POST'){
                $fullName = $_POST['fullname'];
                $userName = $_POST['username'];
                $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $role = $_POST['role'];

                $result = $this->modelUser-> store ($fullName, $userName,
                 $pass, $phone,$email, $gender, $role);
                if ($result){
                echo "Thêm mới thành công 
                <a href='/QLBanHang/admin.php?page=user&action=index'>danh sách</a>
                ";
                die;
            }
            }
        }

        function edit (){
            if ($_SESSION['user']['role_id'] != 1) {
            echo "Bạn không có quyền chỉnh sửa!";
            return;
            }
            if($_SERVER ['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $fullName = $_POST['fullname'];
                $userName = $_POST['username'];
                $pass =  $_POST['pass'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $role = $_POST['role'];


                if(!empty($_POST['pass'])){
                    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                } else {
                    // Lấy mật khẩu cũ từ database
                    $user = $this->modelUser->getId($id);
                    $pass = $user['password'];
                }
                $result = $this->modelUser->update($id,$fullName, $userName,
                 $pass, $phone,$email, $gender, $role);
                if ($result){
                echo "Thêm mới thành công 
                <a href='/QLBanHang/admin.php?page=user&action=index'>danh sách</a>
                ";
                die;
            }
            }
            else {
                // lần đầu mở form
                $id = $_GET['id'];
                $data = $this->modelUser->getId($id);
                include "views/admin/users/edit.php";
            }
        }

        function delete()  {
            if ($_SESSION['user']['role_id'] != 1) {
            echo "Bạn không có quyền chỉnh sửa!";
            return;
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $result = $this->modelUser->delete($id);

                if ($result) {
                    echo "Xóa thành công <a href='/QLBanHang/admin.php?page=user&action=index'>Danh sách</a>";
                    die;
                } else {
                    echo "Xóa thất bại!";
                }
                    }
        }

        function displayLogin(){
            include "views/admin/auth/login.php";
        }
        function login (){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userName = $_POST['userName'];
            $pass = $_POST['pass'];

            $user = $this->modelUser->getUserName($userName);
            if($user && password_verify($pass,$user['password'])){
                if($user['role_id']== 1|| $user['role_id']=='2'){
                    $_SESSION['user'] = $user;
                    
                    header("Location: admin.php?page=dashboard&action=index");
                    exit;
                }
                else {
                    $error="Bạn không có quyền truy cập website này!";
                    include "views/admin/auth/login.php";
                }
            } 
            else {
                $error = "Sai tài khoản hoặc mật khẩu!";
                include "views/admin/auth/login.php";
            }
        }
    }
    function logout() {
    unset($_SESSION['user']);
    session_destroy();
    header("Location: admin.php?page=user&action=displayLogin");
    exit;
}
}