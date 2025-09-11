<?php 
    require './models/order.php';
    class OrderController{
        private $orderModel;
        public function __construct(){
            $this->orderModel = new Order();
        }
        public function index (){
            $limit = 5;
            $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";
            if ($page < 1) $page = 1;
            $start = ($page - 1) * $limit;
            $totalRow = $this->orderModel->TotalOrder($keyword);
            $totalPage = ceil($totalRow / $limit);
            $datas = $this->orderModel->getAll($start, $limit,$keyword);
            $status = $this->orderModel->getStatus();
            include "views/admin/orders/index.php"; 
        }
        public function edit(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $status_id = $_POST['status_id'];
                $result = $this->orderModel->update($id,$status_id);
                if ($result) {
                    echo "Cập nhật thành công 
                        <a href='/QLBanHang/admin.php?page=order&action=index'>Danh sách</a>";
                    die;
                }
            }
        }
        function delete()  {
            if ($_SESSION['user']['role_id'] != 1) {
            echo "Bạn không có quyền chỉnh sửa!";
            return;
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $result = $this->orderModel->delete($id);

                if ($result) {
                    echo "Xóa thành công <a href='/QLBanHang/admin.php?page=order&action=index'>Danh sách</a>";
                    die;
                } else {
                    echo "Xóa thất bại!";
                }
                    }
        } 
        
    }