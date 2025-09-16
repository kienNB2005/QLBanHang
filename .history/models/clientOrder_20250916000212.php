<?php
require_once "./config/database.php";

class clientOrder {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Lấy sản phẩm trong giỏ
    public function getCartItems($userId) {
        $sql = "SELECT c.product_id, c.quantity, p.name, p.price, p.images 
                FROM carts c 
                JOIN products p ON c.product_id = p.id 
                WHERE c.user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    // Tạo đơn hàng
    public function createOrder($userId, $name, $phone, $address, $total) {
        $sql = "INSERT INTO orders (user_id, name, phone, address, total_price, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $name, $phone, $address, $total]);
        return $this->db->lastInsertId();
    }

    // Thêm sản phẩm vào order_items
    public function addOrderItem($orderId, $productId, $quantity, $price) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$orderId, $productId, $quantity, $price]);
    }

    // Xóa toàn bộ giỏ hàng
    public function clearCart($userId) {
        $sql = "DELETE FROM carts WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId]);
    }

    // Xóa từng sản phẩm khỏi giỏ
    public function clearCartItem($userId, $productId) {
        $sql = "DELETE FROM carts WHERE user_id = ? AND product_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId, $productId]);
    }
}
