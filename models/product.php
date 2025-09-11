<?php

use LDAP\Result;

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
            $result->execute([$idDM,$name,$price,$image, $description]);
            return $this->model->lastInsertId();
        }
        public function update ($id,$idDM, $name, $price,$image, $description){
            $sql = "update products set category_id = ?, name = ?, price = ?,images = ?, description = ? where id = ?";
            $result = $this->model->prepare($sql);
            return $result->execute([$idDM,$name,$price,$image, $description, $id]);
        }

        public function delete ($id){
            $sql = "delete from products where id = ?";
            $result = $this->model->prepare($sql);
            $result2 = $this->model->prepare("delete from genre_product where product_id = ?");
            $result2 -> execute([$id]);
            return $result->execute([$id]);
        }
        public function deleteGenre_product ($id){
            $result = $this->model->prepare("delete from genre_product where product_id = ?");
            $result -> execute([$id]);
        }

        public function getProducts($start, $limit,$keyword="") {
            // Ép kiểu để chắc chắn là số nguyên (tránh SQL Injection)
            if($keyword!=""){
            $start = (int)$start;
            $limit = (int)$limit;

            // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
            $sql = "SELECT * FROM product_categoris_view  where name like ? LIMIT $start, $limit";

            $stmt = $this->model->prepare($sql);
            $stmt->execute(["%$keyword%"]);
            return $stmt->fetchAll();
            }
            else{
            $start = (int)$start;
            $limit = (int)$limit;

            // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
            $sql = "SELECT * FROM product_categoris_view LIMIT $start, $limit";

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

        public function getCategory (){
            $result = $this ->model->query("select * from categories");
            return $result ->fetchAll();
        }

        public function getGenre (){
            $result = $this ->model->query("select * from genres");
            return $result ->fetchAll();
        }

        public function storeProduct_genre ($genres_id, $product_id){
            if(!empty($genres_id)){
                for($i = 0; $i< count($genres_id);$i++){
                    $result = $this->model->prepare("INSERT INTO genre_product (product_id, genre_id) VALUES (?, ?)");
                    $result->execute([$product_id,$genres_id[$i]]);
                }
            }
        }
        
        public function getCurrentGenreById($id){
            $result = $this->model->prepare("select genre_id from genre_product where product_id = ?");
            $result -> execute([$id]);
            return $result->fetchAll(PDO::FETCH_COLUMN);
        }
    }