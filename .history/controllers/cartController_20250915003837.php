<?php 
require_once './models/cart.php';

class CartController {

    private $modelCart;
    public function __construct(){
        $this->modelCart = new Cart();
    }

    // Trang giỏ hàng
    function index(){
        $datas = $this->modelCart->getAll();
        include "views/client/cart/index.php";
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
}
