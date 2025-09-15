<?php
require_once './models/ClientOrder.php';

class ClientOrderController {
    private $modelOrder;

    public function __construct() {
        $this->modelOrder = new ClientOrder();
    }

    public function checkout() {
        if (!isset($_SESSION['user'])) {
            echo "Bạn phải đăng nhập để thanh toán";
            return;
        }

        $cart = $this->modelOrder->getCartItems($_SESSION['user']['id']);
        $datas = $cart; // gửi sang view
        include "views/client/order/checkout.php";
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $selectedProducts = $_POST['selected_products'] ?? [];
            $totalPrice = $_POST['total_price'] ?? 0;

            // Các thông tin địa chỉ (nếu muốn)
            $province = $_POST['province'] ?? '';
            $district = $_POST['district'] ?? '';
            $ward = $_POST['ward'] ?? '';
            $street_address = $_POST['street_address'] ?? '';

            if(empty($selectedProducts)) {
                echo "<h2>Bạn chưa chọn sản phẩm nào để thanh toán!</h2>";
                echo "<p><a href='index.php?page=cart&action=index'>Quay lại giỏ hàng</a></p>";
                return;
            }

            // Tạo đơn hàng
            $orderId = $this->modelOrder->createOrder($userId, $totalPrice, 1, $province, $district, $ward, $street_address);

            if ($orderId) {
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
