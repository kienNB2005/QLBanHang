<?php 
    require './models/product.php';
    class ProductController{
        private $modelProducts;
        function __construct(){
            $this->modelProducts = new Product();
        }
        function index (){
            $limit = 5; // số sản phẩm mỗi trang
            $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";
            if ($page < 1) $page = 1;
            $start = ($page - 1) * $limit;
            // $products = $this->modelProducts-> getProducts($start, $limit, $keyword);
            $totalRow = $this->modelProducts->TotalProducts($keyword);
            $totalPage = ceil($totalRow / $limit);
            $datas = $this -> modelProducts-> getProducts($start,$limit,$keyword);
            include "views/admin/products/index.php";
        }

        function displayInfo(){
            include "views/admin/products/create.php";
        }
        function create()  {
            if($_SERVER ['REQUEST_METHOD'] == 'POST') {
                $idDM = $_POST['idDM'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $description = $_POST['description'];

                $target_dir = "uploads/";
                $target_file = $target_dir .basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $result = $this->modelProducts->store($idDM,$name, $price,$target_file,$description);
            }
            
            if ($result){
                echo "Thêm mới thành công 
                <a href='/QLBanHang/admin.php?page=product&action=index'>danh sách</a>
                ";
                die;
            }
        }
        function edit() {
            if ($_SESSION['user']['role_id'] != 1) {
            echo "Bạn không có quyền chỉnh sửa!";
            return;
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // lấy id từ POST 
                $id = $_POST['id'];
                $idDM = $_POST ['idDM'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $description = $_POST['description'];

                $target_dir = "uploads/";
                $target_file = $target_dir .basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                $result = $this->modelProducts->update($id, $idDM,$name, $price,$target_file,$description);

                if ($result) {
                    echo "Cập nhật thành công 
                        <a href='/QLBanHang/admin.php?page=product&action=index'>Danh sách</a>";
                    die;
                }
            } else {
                // lần đầu mở form
                $id = $_GET['id'];
                $data = $this->modelProducts-> getById($id);
                include "views/admin/products/edit.php";
            }
        }


        function delete()  {
            if ($_SESSION['user']['role_id'] != 1) {
            echo "Bạn không có quyền chỉnh sửa!";
            return;
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $result = $this->modelProducts->delete($id);

                if ($result) {
                    echo "Xóa thành công <a href='/QLBanHang/admin.php?page=product&action=index'>Danh sách</a>";
                    die;
                } else {
                    echo "Xóa thất bại!";
                }
                    }
        }     
        
    }