<?php
require_once './models/ClientOrder.php';

class ClientOrderController {
    private $modelOrder;

    public function __construct() {
        $this->modelOrder = new ClientOrder();
    }

    // Bước 1: Xem giỏ hàng trước khi đặt
    public function checkout() {
        if (!isset($_SESSION['user'])) {
            echo "Bạn phải đăng nhập để thanh toán";
            return;
        }

        $cart = $this->modelOrder->getCartItems($_SESSION['user']['id']);
        $datas = $cart; 
        include "views/client/order/checkout.php";
    }

    // Bước 2: Nhận dữ liệu POST từ checkout
    public function process() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "<h2>Phương thức không hợp lệ!</h2>";
            return;
        }

        if (!isset($_SESSION['user'])) {
            echo "<h2>Bạn phải đăng nhập để thanh toán</h2>";
            return;
        }

        // Lưu đơn hàng tạm vào session
        $_SESSION['cart_order'] = $_POST;

        // ✅ chuyển sang trang nhập thông tin KH
        header("Location: index.php?page=order&action=info");
        exit;
    }

    // Bước 3: Hiển thị form nhập thông tin khách hàng
    public function info() {
        if (!isset($_SESSION['cart_order'])) {
            echo "Không có đơn hàng nào!";
            return;
        }

        include "views/client/order/info.php"; 
    }

    // Bước 4: Lưu vào DB
    public function save() {
        if (!isset($_SESSION['cart_order'])) {
            exit("Không có đơn hàng nào.");
        }

        if (!isset($_SESSION['user'])) {
            exit("Bạn phải đăng nhập để thanh toán.");
        }

        $cart = $_SESSION['cart_order'];
        $userId = $_SESSION['user']['id'];

        // Gọi model tạo order
        $orderId = $this->modelOrder->createOrder(
            $userId,
            $cart['total_price'] ?? 0,
            1, // trạng thái: mới đặt
            $cart['province'] ?? '',
            $cart['district'] ?? '',
            $cart['ward'] ?? '',
            $cart['street_address'] ?? ''
        );

        if ($orderId) {
            // Thêm sản phẩm vào order_items
            $selectedProducts = $cart['selected_products'] ?? [];
            $cartItems = $this->modelOrder->getCartItems($userId);

            foreach ($cartItems as $item) {
                if (in_array($item['product_id'], $selectedProducts)) {
                    $this->modelOrder->addOrderItem(
                        $orderId, 
                        $item['product_id'], 
                        $item['quantity'], 
                        $item['price']
                    );
                    $this->modelOrder->clearCartItem($userId, $item['product_id']);
                }
            }

            // Xóa session tạm
            unset($_SESSION['cart_order']);

            echo "<h2>Đặt hàng thành công!</h2>";
            echo "<p><a href='index.php'>Về trang chủ</a></p>";
        } else {
            echo "<h2>Có lỗi xảy ra, vui lòng thử lại.</h2>";
        }
    }
}
