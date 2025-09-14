<?php
    require_once "./config/database.php";
    class Cart {
        private $model;
        function __construct(){
            $this->model = Database::connect();
        }
        public function getAll(){
            $result = $this->model->prepare("SELECT * FROM qlbanhang.cart_product where user_id = ?");
            $result->execute([$_SESSION['user']['id']]);
            return $result->fetchAll();
        }

        function store ($product_id,$quantity = 1){
            // if (!isset($_SESSION['user'])) {
            // $sql = "INSERT INTO carts (product_id, session_id,quantity) values (?,?,?)";
            // $result = $this -> model ->prepare($sql);
            // return $result->execute([$product_id, $_SESSION['cart_session'] ,$quantity  ]);
            // }
            // else{
            $sql = "INSERT INTO carts (product_id, user_id,quantity) values (?,?,?)";
            $result = $this -> model ->prepare($sql);
            return $result->execute([$product_id, $_SESSION['user']['id'],$quantity]);
            // }
        }
        function getProductCart($product_id){
            // if (!isset($_SESSION['user'])){
            //     $sql = "SELECT * FROM carts WHERE product_id = ? AND session_id = ?";
            //     $result = $this->model->prepare($sql); 
            //     $result->execute([$product_id, $_SESSION['cart_session']]);
            //     return $result->fetch();
            // }
            // else{
                $sql = "SELECT * FROM carts WHERE product_id = ? AND user_id = ?";
                $result = $this->model->prepare($sql); 
                $result->execute([$product_id, $_SESSION['user']['id']]);
                return $result->fetch();
            // }
        }

        function add ($id){
                $sql = "update carts set quantity = quantity + 1 WHERE id = ? ";
                $result = $this->model->prepare($sql); 
                return $result->execute([$id]); 
        }

        function sub ($id){
            $sql = "update carts set quantity = quantity - 1 WHERE id = ? ";
            $result = $this->model->prepare($sql); 
            return $result->execute([$id]);
        }

        // function mergeCart($user_id) {

        //     //// Lấy tất cả sản phẩm của session
        //     $sql = "SELECT * FROM carts WHERE session_id = ?";
        //     $stmt = $this->model->prepare($sql);
        //     $stmt->execute([$_SESSION['cart_session']]);
        //     $sessionItems = $stmt->fetchAll();

        //     foreach ($sessionItems as $item) {
        //         //// Kiểm tra user đã có sản phẩm chưa
        //         $sqlCheck = "SELECT id, quantity FROM carts WHERE product_id = ? AND user_id = ?";
        //         $stmtCheck = $this->model->prepare($sqlCheck);
        //         $stmtCheck->execute([$item['product_id'], $user_id]);
        //         $userItem = $stmtCheck->fetch();

        //         if ($userItem) {
        //             //// Nếu đã có -> cộng quantity
        //             $sqlUpdate = "UPDATE carts SET quantity = quantity + ? WHERE id = ?";
        //             $stmtUpdate = $this->model->prepare($sqlUpdate);
        //             $stmtUpdate->execute([$item['quantity'], $userItem['id']]);
        //         } else {
        //             //// Nếu chưa có -> update user_id và xóa session_id
        //             $sqlUpdate = "UPDATE carts SET user_id = ?, session_id = NULL WHERE id = ?";
        //             $stmtUpdate = $this->model->prepare($sqlUpdate);
        //             $stmtUpdate->execute([$user_id, $item['id']]);
        //         }
        //     }
        //     $sqlDelete = $this->model->prepare("delete from carts where session_id = ?");
        //     $sqlDelete->execute([$_SESSION['cart_session']]);
        // }

}