<?php 
    require_once './models/cart.php';
    class CartController {

        private $modelCart;
        public function __construct(){
            $this->modelCart = new Cart();
        }

        function index(){
            $datas = $this->modelCart->getAll();
            include "views/client/cart/index.php";
        }

        function addNew (){
            if (!isset($_SESSION['user'])) {
            echo "Bạn phai dang nhap";
            return;
            }
            $product_id = $_POST['product_id'];
            $productCart = $this->modelCart->getProductCart($product_id);
            if($productCart){
                $result = $this->modelCart->add($productCart['id']);
            }
            else{
                $result = $this->modelCart->store($product_id);
            }
            if($result){
                echo "đã thêm đơn hàng vào giỏ thành công";
            }
        }

        public function addOrSub() {
            $id = $_POST['id'];
            $op = $_POST['op'];

            if($op === 'increase') {
                $_SESSION['cart'][$id]['quantity']++;
            } elseif($op === 'decrease') {
                $_SESSION['cart'][$id]['quantity'] = max(1, $_SESSION['cart'][$id]['quantity']-1);
            }
            header("Location: index.php?page=cart&action=index");
        }

        public function delete() {
            $id = $_POST['id'];
            unset($_SESSION['cart'][$id]);
            header("Location: index.php?page=cart&action=index");
        }


    }