<?php 
    require_once './models/category.php';
    require_once './models/genre.php';
    require_once './models/user.php';
    require_once './models/product.php';
    require_once './models/cart.php';
    class ClientController{
        private $modelCategory;
        private $modelGenre;
        private $modelUser;
        private $modelproduct;
        private $modelCart;
        function __construct(){
            $this->modelCategory = new category();
            $this->modelGenre = new genre();
            $this->modelUser = new User();
            $this->modelproduct = new Product();
            $this->modelCart = new Cart();
        }
        public function index(){
            $categoryId = isset($_GET['c']) ? $_GET['c'] : "";
            $genre      = isset($_GET['genre']) ? $_GET['genre'] : "";
            $price      = isset($_GET['price']) ? $_GET['price'] : "";
            // Gọi model lấy sản phẩm, truyền thêm điều kiện lọc
            $dataProduct  = $this->modelproduct->getAll($categoryId, $price, $genre);
            $dataCategory = $this->modelCategory->getAll();
            $dataGenre    = $this->modelGenre->getAll();
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
                // $this->modelCart->mergeCart($user['id']);
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

        public function register(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $fullName = $_POST['full_name'];
                $userName = trim($_POST['user_name']);
                $pass = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));
                $phone = $_POST['phone'];
                $email = trim($_POST['email']);
                $gender = $_POST['gender'];
                if($this->modelUser->getUserName($userName)&&$this->modelUser->getEmail($email)){
                    $error = "Tên đăng nhập và email đã tồn tại";
                    $email ="";
                    $userName="";
                    include "views/client/auth/register.php";
                }
                else if($this->modelUser->getUserName($userName)){
                    $error = "Tên đăng nhập đã tồn tại";
                    $userName = "";
                    include "views/client/auth/register.php";
                }
                else if($this->modelUser->getEmail($email)){
                    $error = "Email đã tồn tại";;
                    $email = "";
                    include "views/client/auth/register.php";
                }
                else{
                    $result = $this->modelUser->store($fullName,$userName,$pass,$phone,$email,$gender);
                    $error = "Đăng ký thành công!";
                    include "views/client/auth/register.php";
                    echo "
                    <script>
                        setTimeout(() => {
                            window.location.href = 'index.php?page=client&action=index';
                        }, 2000);
                    </script>
                    ";
                    exit;
                }
            }
        }
        function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php?page=client&action=index");
        exit;
        }
}