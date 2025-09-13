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
    }