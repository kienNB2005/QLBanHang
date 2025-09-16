<?php
require_once './models/ClientOrder.php';

class ClientOrderController {
    private $modelOrder;

    public function __construct() {
        $this->modelOrder = new ClientOrder();
    }

    // Trang checkout
    public function checkout() {
        if (!isset($_SESSION['user'])) {
            echo "Bạn phải đăng nhập để thanh toán";
            return;
        }

        $cart = $this->modelOrder->getCartItems($_SESSION['user']['id']);
        $datas = $cart; // gửi sang view
        include "views/client/order/checkout.php";
    }

    // Xử lý đặt hàng
    public function process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $total = $_POST['total_price'] ?? 0;

            $selectedProducts = $_POST['selected_products'] ?? [];

            if(empty($selectedProducts)) {
                echo "<h2>Bạn chưa chọn sản phẩm nào để thanh toán!</h2>";
                echo "<p><a href='index.php?page=cart&action=index'>Quay lại giỏ hàng</a></p>";
                return;
            }

            // Tạo đơn hàng
            $orderId = $this->modelOrder->createOrder($userId, $name, $phone, $address, $total);

            if ($orderId) {
                // Lưu chi tiết sản phẩm đã chọn
                $cartItems = $this->modelOrder->getCartItems($userId);
                foreach ($cartItems as $item) {
                    if(in_array($item['product_id'], $selectedProducts)) {
                        $this->modelOrder->addOrderItem($orderId, $item['product_id'], $item['quantity'], $item['price']);
                        $this->modelOrder->clearCartItem($userId, $item['product_id']);
                    }
                }

                echo "<h2>Đặt hàng thành công!</h2>";
                echo "<p><a href='index.php'>Về trang chủ</a></p>";
            } else {
                echo "Có lỗi xảy ra, vui lòng thử lại.";
            }
        }
    }
}
