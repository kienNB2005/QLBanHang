<?php 
    require './models/category.php';
     class categoryController {
        private $categoryModel;
        
        function __construct(){
            $this ->categoryModel = new Category();
        }
        function index()  {
            $limit = 5; // số sản phẩm mỗi trang
            $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";
            if ($page < 1) $page = 1;
            $start = ($page - 1) * $limit;
            $totalRow = $this->categoryModel->TotalCategory($keyword);
            $totalPage = ceil($totalRow / $limit);
            $datas = $this -> categoryModel-> getCategory($start,$limit,$keyword);
            include "views/admin/categories/index.php";
        }
        function displayInfo(){
            include "views/admin/categories/create.php";
        }
        function create()  {
            if($_SERVER ['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $result = $this->categoryModel-> store($name,$description);
            }
            
            if ($result){
                echo "Thêm mới thành công 
                <a href='/QLBanHang/admin.php?page=category&action=index'>danh sách</a>
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
                $id = $_POST['id'];  
                $name = $_POST['name'];
                $description = $_POST['description'];

                $result = $this->categoryModel->update($id, $name, $description);

                if ($result) {
                    echo "Cập nhật thành công 
                        <a href='/QLBanHang/admin.php?page=category&action=index'>Danh sách</a>";
                    die;
                }
            } else {
                // lần đầu mở form
                $id = $_GET['id'];
                $data = $this->categoryModel->getById($id);
                include "views/admin/categories/edit.php";
            }
        }


        function delete()  {
            if ($_SESSION['user']['role_id'] != 1) {
            echo "Bạn không có quyền chỉnh sửa!";
            return;
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $result = $this->categoryModel->delete($id);

                if ($result) {
                    echo "Xóa thành công <a href='/QLBanHang/admin.php?page=category&action=index'>Danh sách</a>";
                    die;
                } else {
                    echo "Xóa thất bại!";
                }
                    }
        }    
     }