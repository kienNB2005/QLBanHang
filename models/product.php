<?php

//use LDAP\Result;
    require_once "__DIR__ . /../../config/database.php";
    class Product{
        private $model;
        public function __construct(){
            $this->model= Database::connect();
        }
        public function getAll(){
            $result = $this->model->query("select * from products");
            return $result->fetchAll();
        }
        public function getById($id){
            $sql = "select * from products where id = ? ";
            $result = $this->model->prepare($sql);
            $result->execute([$id]);
            return $result->fetch();
        }
        public function store ($idDM,$name,$price,$image, $description){
            $sql = "INSERT INTO products (category_id ,name,price,images, description) values (?,?,?,?,?)";
            $result = $this -> model ->prepare($sql);
            return $result->execute([$idDM,$name,$price,$image, $description]);
        }
        public function update ($id,$idDM, $name, $price,$image, $description){
            $sql = "update products set category_id = ?, name = ?, price = ?,images = ?, description = ? where id = ?";
            $result = $this->model->prepare($sql);
            return $result->execute([$idDM,$name,$price,$image, $description, $id]);
        }

        public function delete ($id){
            $sql = "delete from products where id = ?";
            $result = $this->model->prepare($sql);
            return $result->execute([$id]);
        }

        public function getProducts($start, $limit,$keyword="") {
            // Ép kiểu để chắc chắn là số nguyên (tránh SQL Injection)
            if($keyword!=""){
            $start = (int)$start;
            $limit = (int)$limit;

            // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
            $sql = "SELECT * FROM products  where name like ? LIMIT $start, $limit";

            $stmt = $this->model->prepare($sql);
            $stmt->execute(["%$keyword%"]);
            return $stmt->fetchAll();
            }
            else{
            $start = (int)$start;
            $limit = (int)$limit;

            // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
            $sql = "SELECT * FROM products LIMIT $start, $limit";

            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
            }

        }
        public function TotalProducts ($keyword=""){
            if($keyword != ""){
                $sql = "select count(id) from products where name like ?";
                $result = $this->model->prepare($sql);
                $result->execute(["%$keyword%"]);
                return $result->fetchColumn();
            }
            else{
                $result = $this ->model->query("select count(id) from products");
                return $result ->fetchColumn();
            }
            
        }


    }