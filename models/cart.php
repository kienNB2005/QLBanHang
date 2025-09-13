<?php
    require_once "./config/database.php";
    class Cart {
        private $model;
        function __construct(){
            $this->model = Database::connect();
        }
        public function getAll(){
            $result = $this->model->query("SELECT * FROM qlbanhang.cart_product");
            $result->execute();
            return $result->fetchAll();
        }
    }