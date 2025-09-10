<?php
    require_once "__DIR__ . /../../config/database.php";
    class Category {
        private $model;
        public function __construct(){
            $this->model = Database::connect();
        }
        public function getAll (){
            $result = $this ->model->query("select * from categories");
            return $result ->fetchAll();
        }
        public function getById ($id = 0){
            $sql = "select * from categories where id = ?";
            $result = $this->model->prepare($sql);
            $result -> execute([$id]);
            return $result->fetch();
        }
        public function store ($name, $description){
            $sql = "INSERT INTO categories (name, description) values (?,?)";
            $result = $this -> model ->prepare($sql);
            return $result->execute([$name, $description]);
        }
        public function update ($id, $name, $description){
            $sql = "update categories set name = ?, description = ? where id = ?";
            $result = $this->model->prepare($sql);
            return $result->execute([$name, $description, $id]);
        }
        public function delete ($id){
            $sql = "delete from categories where id = ?";
            $result = $this->model->prepare($sql);
            return $result->execute([$id]);
        }
        public function getCategory($start, $limit,$keyword=""){
            if($keyword !=""){
                $start = (int)$start;
                $limit = (int)$limit;

                // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
                $sql = "SELECT * FROM categories  where name like ? LIMIT $start, $limit";

                $stmt = $this->model->prepare($sql);
                $stmt->execute(["%$keyword%"]);
                return $stmt->fetchAll();
                }
                else{
                $start = (int)$start;
                $limit = (int)$limit;

                // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
                $sql = "SELECT * FROM categories LIMIT $start, $limit";

                $stmt = $this->model->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll();
            }
        }

        public function TotalCategory ($keyword=""){
            if($keyword != ""){
                $sql = "select count(id) from categories where name like ?";
                $result = $this->model->prepare($sql);
                $result->execute(["%$keyword%"]);
                return $result->fetchColumn();
            }
            else{
                $result = $this ->model->query("select count(id) from categories");
                return $result ->fetchColumn();
            }
            
        }
    }
            
    