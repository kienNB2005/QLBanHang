<?php 
require_once './models/cart.php';

class CartController {

    private $modelCart;
    public function __construct(){
        $this->modelCart = new Cart();
    }

    // Trang giỏ hàng
    function index(){
        if(!isset($_SESSION['user'])){
            echo "bạn phải đăng nhập";
            return;
        }
        $datas = $this->modelCart->getAll();
        include "views/client/cart/index.php";
    }

    function addNew (){
        if(!isset($_SESSION['user'])){
            echo "bạn phải đăng nhập";
            return;
        }
            $product_id = $_POST['product_id'];
            $productCart = $this->modelCart->getProductCart($product_id);
            if($productCart){
                $result = $this->modelCart-> add($productCart['id']);
            }
            else{
                $result = $this->modelCart->store($product_id);
            }
            if($result){
                echo "đã thêm đơn hàng vào giỏ thành công";
            }
        }

    // Tăng/giảm số lượng
    public function addOrSub() {
        $id = intval($_POST['id']);
        $op = $_POST['op'];

        if ($op === 'increase') {
            $this->modelCart->add($id);
        } elseif ($op === 'decrease') {
            $this->modelCart->sub($id);
        }
        header("Location: index.php?page=cart&action=index");
        exit;
    }

    // Xóa sản phẩm
    public function delete() {
        $id = intval($_POST['id']);
        $this->modelCart->deleteItem($id);
        header("Location: index.php?page=cart&action=index");
        exit;
    }
    public function remove() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }
    header("Location: index.php?controller=cart&action=index");
    exit();
}

}
