<?php

use LDAP\Result;
require_once "./config/database.php";
    class User {
        private $model;
        function __construct(){
            $this->model = Database::connect();
        }

        function getAll(){
            $result = $this->model->query("select * from users");
            return $result->fetchAll();
        }

        function getId($id){
            $sql = "select * from users where id = ?";
            $result = $this ->model->prepare($sql);
            $result->execute([$id]);
            return $result->fetch();
        }

        function store($fullName, $userName, $pass, $phone, $email, $gender, $role_id){
            $sql = "INSERT INTO users (full_name, user_name, password, phone, email, gender, role_id) VALUES(?,?,?,?,?,?,?)";
            $result = $this->model->prepare($sql);
            return $result ->execute([$fullName, $userName, $pass, $phone, $email, $gender, $role_id]);
        }

        function update($id,$fullName, $userName, $pass, $phone, $email, $gender, $role_id){
            $sql = "update users set full_name = ?, user_name= ?, password = ?, phone = ?, email = ?, gender = ?, role_id = ? where id =?";
            $result = $this->model->prepare($sql);
            return $result->execute([$fullName, $userName, $pass, $phone, $email, $gender, $role_id, $id]);
        }

        public function delete ($id){
            $sql = "delete from users where id = ?";
            $result = $this->model->prepare($sql);
            return $result->execute([$id]);
        }

         public function getUser($start, $limit,$keyword="",$role="") {
            $start = (int)$start;
            $limit = (int)$limit;
            // Ép kiểu để chắc chắn là số nguyên (tránh SQL Injection)
            if ($keyword!=""&&$role!=""){
            // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
            $sql = "SELECT * FROM user_role_view  where full_name like ? and role_name = ? LIMIT $start, $limit";
            $stmt = $this->model->prepare($sql);
            $stmt->execute(["%$keyword%",$role]);
            return $stmt->fetchAll();
            }
            else if($role != ""){
            // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
            $sql = "SELECT * FROM user_role_view where role_name = ?  LIMIT $start, $limit";
            $stmt = $this->model->prepare($sql);
            $stmt->execute([$role]);
            return $stmt->fetchAll();
            }
            else if($keyword!=""){
            // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
            $sql = "SELECT * FROM user_role_view  where full_name like ?  LIMIT $start, $limit";
            $stmt = $this->model->prepare($sql);
            $stmt->execute(["%$keyword%"]);
            return $stmt->fetchAll();
            }
            else{
            // Chèn thẳng số vào LIMIT (MySQL không hỗ trợ bind LIMIT)
            $sql = "SELECT * FROM user_role_view LIMIT $start, $limit";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
            }

        }
        public function TotalUser ($keyword="", $role=""){
            if($keyword != ""&& $role!=""){
                $sql = "select count(id) from user_role_view where full_name like ? and role_name = ?";
                $result = $this->model->prepare($sql);
                $result->execute(["%$keyword%",$role]);
                return $result->fetchColumn();
            }
            else if($keyword !=""){
                $sql = "select count(id) from user_role_view where full_name like ?";
                $result = $this->model->prepare($sql);
                $result->execute(["%$keyword%"]);
                return $result->fetchColumn();
            }
            else if($role != ""){
                $sql = "select count(id) from user_role_view where role_name = ?";
                $result = $this->model->prepare($sql);
                $result->execute([$role]);
                return $result->fetchColumn();
            }
            else{
                $result = $this ->model->prepare("select count(id) from user_role_view");
                return $result ->fetchColumn();
            }
            
        }

        public function getUserName($userName){
            $sql= "select * from users where user_name = ?";
            $result = $this->model->prepare($sql);
            $result->execute([$userName]);
            return $result->fetch();
        }

        

    }