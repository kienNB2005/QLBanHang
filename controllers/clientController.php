<?php 
    require_once './models/category.php';
    require_once './models/genre.php';
    require_once './models/user.php';
    class ClientController{
        private $modelCategory;
        private $modelGenre;
        private $modelUser;
        function __construct(){
            $this->modelCategory = new category();
            $this->modelGenre = new genre();
            $this->modelUser = new User();
        }
        public function index(){
            $dataCategory = $this->modelCategory->getAll();
            $dataGenre = $this->modelGenre->getAll();
            include "views/client/home.php";
        }
        public function displayLogin(){
            include "views/client/auth/login.php";
        }
        public function login(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $userName = $_POST['userName'];
            $pass = $_POST['pass'];
            $user = $this->modelUser->getUserName($userName);
            if ($user && password_verify($pass,$user['password'])){
                $_SESSION['user'] = $user;
                    header("Location: index.php?page=client&action=index");
                    exit;
            }
            else {
                $error = "sai tên đăng nhập hoặc mật khẩu";
                include "views/client/auth/login.php";
            }
        }
        }

        public function displayRegister(){
            include "views/client/auth/register.php";
        }

        function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php?page=client&action=index");
        exit;
        }


}