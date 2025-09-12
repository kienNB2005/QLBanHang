<?php 
   require './models/genre.php';
     class genreController {
        private $genreModel;
        
        function __construct(){
            $this ->genreModel = new genre();
        }
        function index()  {
            $limit = 5; // số sản phẩm mỗi trang
            $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";
            if ($page < 1) $page = 1;
            $start = ($page - 1) * $limit;
            $totalRow = $this->genreModel->Totalgenre($keyword);
            $totalPage = ceil($totalRow / $limit);
            $datas = $this -> genreModel-> getgenre($start,$limit,$keyword);
            include "views/admin/genre/index.php";
        }
        function displayInfo(){
            include "views/admin/genre/create.php";
        }
        function create()  {
            if($_SERVER ['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $result = $this->genreModel-> store($name,$description);
            }
            
            if ($result){
                echo "Thêm mới thành công 
                <a href='/QLBanHang/admin.php?page=genre&action=index'>danh sách</a>
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

                $result = $this->genreModel->update($id, $name, $description);

                if ($result) {
                    echo "Cập nhật thành công 
                        <a href='/QLBanHang/admin.php?page=genre&action=index'>Danh sách</a>";
                    die;
                }
            } else {
                // lần đầu mở form
                $id = $_GET['id'];
                $data = $this->genreModel->getById($id);
                include "views/admin/genre/edit.php";
            }
        }


        function delete()  {
            if ($_SESSION['user']['role_id'] != 1) {
            echo "Bạn không có quyền chỉnh sửa!";
            return;
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $result = $this->genreModel->delete($id);

                if ($result) {
                    echo "Xóa thành công <a href='/QLBanHang/admin.php?page=genre&action=index'>Danh sách</a>";
                    die;
                } else {
                    echo "Xóa thất bại!";
                }
                    }
        }    
     }