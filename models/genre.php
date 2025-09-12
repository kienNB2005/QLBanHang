<?php
    require_once "./config/database.php";
    class Genre {
        private $model;
        public function __construct(){
            $this->model = Database::connect();
        }
        public function getAll (){
            $result = $this ->model->query("select * from genres");
            return $result ->fetchAll();
        }
        public function getById ($id = 0){
            $sql = "select * from genres where id = ?";
            $result = $this->model->prepare($sql);
            $result -> execute([$id]);
            return $result->fetch();
        }
        public function store ($name, $description){
            $sql = "INSERT INTO genres (name, description) values (?,?)";
            $result = $this -> model ->prepare($sql);
            return $result->execute([$name, $description]);
        }
        public function update ($id, $name, $description){
            $sql = "update genres set genre_name = ?, description = ? where id = ?";
            $result = $this->model->prepare($sql);
            return $result->execute([$name, $description, $id]);
        }
        public function delete ($id){
            $sql = "delete from genres where id = ?";
            $result = $this->model->prepare($sql);
            return $result->execute([$id]);
        }
        public function getGenre($start, $limit,$keyword=""){
            if($keyword !=""){
                $start = (int)$start;
                $limit = (int)$limit;

                // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
                $sql = "SELECT * FROM genres  where genre_name like ? LIMIT $start, $limit";

                $stmt = $this->model->prepare($sql);
                $stmt->execute(["%$keyword%"]);
                return $stmt->fetchAll();
                }
                else{
                $start = (int)$start;
                $limit = (int)$limit;

                // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
                $sql = "SELECT * FROM genres LIMIT $start, $limit";

                $stmt = $this->model->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll();
            }
        }

        public function TotalGenre ($keyword=""){
            if($keyword != ""){
                $sql = "select count(id) from genres where genre_name like ?";
                $result = $this->model->prepare($sql);
                $result->execute(["%$keyword%"]);
                return $result->fetchColumn();
            }
            else{
                $result = $this ->model->query("select count(id) from genres");
                return $result ->fetchColumn();
            }
            
        }
    }
            
    