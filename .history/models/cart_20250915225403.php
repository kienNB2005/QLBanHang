<?php
require_once "./config/database.php";

class Cart {
    private $model;

    function __construct(){
        $this->model = Database::connect();
    }

    // Lấy toàn bộ giỏ hàng của user hiện tại
    public function getAll(){
            $result = $this->model->prepare("SELECT * FROM qlbanhang.cart_product where user_id = ?");
            $result->execute([$_SESSION['user']['id']]);
            return $result->fetchAll();
    }

    public function countCartByUser($userId) {
        $sql = "SELECT SUM(quantity) as total FROM carts WHERE user_id = ?";
        $stmt = $this->model->prepare($sql);
        $stmt->execute([$userId]);
        $row = $stmt->fetch();
        return $row ? (int)$row['total'] : 0;
    }
    // Thêm sản phẩm vào giỏ
    function store($product_id, $quantity = 1){
        $sql = "INSERT INTO carts (product_id, user_id, quantity) VALUES (?,?,?)";
        $result = $this->model->prepare($sql);
        return $result->execute([$product_id, $_SESSION['user']['id'], $quantity]);
    }

    // Lấy 1 sản phẩm trong giỏ theo product_id
    function getProductCart($product_id){
        $sql = "SELECT * FROM carts WHERE product_id = ? AND user_id = ?";
        $result = $this->model->prepare($sql); 
        $result->execute([$product_id, $_SESSION['user']['id']]);
        return $result->fetch();
    }

    // Tăng quantity thêm 1
    function add($id){
        $sql = "UPDATE carts SET quantity = quantity + 1 WHERE id = ?";
        $result = $this->model->prepare($sql); 
        return $result->execute([$id]); 
    }

    // Giảm quantity bớt 1
    function sub($id){
        $sql = "UPDATE carts SET quantity = GREATEST(quantity - 1, 1) WHERE id = ?";
        $result = $this->model->prepare($sql); 
        return $result->execute([$id]);
    }

    // Cập nhật quantity bất kỳ
    public function updateQuantity($productId, $quantity){
        $sql = "UPDATE carts SET quantity = ? WHERE product_id = ? AND user_id = ?";
        $stmt = $this->model->prepare($sql);
        return $stmt->execute([$quantity, $productId, $_SESSION['user']['id']]);
    }

    // Xóa sản phẩm khỏi giỏ
    // Xóa sản phẩm khỏi giỏ theo ID của carts
    public function deleteItem($id){
        $sql = "DELETE FROM carts WHERE id = ? AND user_id = ?";
        $stmt = $this->model->prepare($sql);
        return $stmt->execute([$id, $_SESSION['user']['id']]);
    }

}
