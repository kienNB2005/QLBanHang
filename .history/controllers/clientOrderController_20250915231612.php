<?php
require_once './models/ClientOrder.php';

class ClientOrderController {
    private $modelOrder;

    public function __construct() {
        $this->modelOrder = new Order();
    }

    // Trang checkout
    public function checkout() {
        if (!isset($_SESSION['user'])) {
            echo "Bạn phải đăng nhập để thanh toán";
            return;
        }

        // Lấy sản phẩm trong giỏ hàng user
        $cart = $this->modelOrder->getCartItems($_SESSION['user']['id']);
        include "views/client/order/checkout.php";
    }

    // Xử lý đặt hàng
    public function process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $total = $_POST['total_price'];
            $userId = $_SESSION['user']['id'];

            // Tạo đơn hàng
            $orderId = $this->modelOrder->createOrder($userId, $name, $phone, $address, $total);

            if ($orderId) {
                // Lưu chi tiết sản phẩm
                $cartItems = $this->modelOrder->getCartItems($userId);
                foreach ($cartItems as $item) {
                    $this->modelOrder->addOrderItem($orderId, $item['product_id'], $item['quantity'], $item['price']);
                }

                // Xóa giỏ hàng
                $this->modelOrder->clearCart($userId);

                echo "<h2>Đặt hàng thành công!</h2>";
                echo "<p><a href='index.php'>Về trang chủ</a></p>";
            } else {
                echo "Có lỗi xảy ra, vui lòng thử lại.";
            }
        }
    }
}
