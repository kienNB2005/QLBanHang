<?php
require_once "./config/database.php";

class Cart {
    private $model;

    function __construct(){
        $this->model = Database::connect();
    }

    // Lấy toàn bộ giỏ hàng của user hiện tại
    public function getAll(){
        $sql = "SELECT c.*, p.name, p.price, p.images 
                FROM carts c
                JOIN products p ON c.product_id = p.id
                WHERE c.user_id = ?";
        $result = $this->model->prepare($sql);
        $result->execute([$_SESSION['user']['id']]);
        return $result->fetchAll();
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
    public function deleteItem($productId){
        $sql = "DELETE FROM carts WHERE product_id = ? AND user_id = ?";
        $stmt = $this->model->prepare($sql);
        return $stmt->execute([$productId, $_SESSION['user']['id']]);
    }
}
