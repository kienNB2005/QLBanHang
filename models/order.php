<?php

use LDAP\Result;
    require_once "__DIR__ . /../../config/database.php";
    class Order{
        private $model;
        function __construct(){
            $this->model = Database::connect();
        }
        public function getAll($start, $limit,$keyword)  {
            if($keyword !=""){
                $start = (int)$start;
                $limit = (int)$limit;


                $sql = "SELECT * FROM order_management_view  where user_name like ? LIMIT $start, $limit";
                $result = $this->model->prepare($sql);
                $result->execute(["%$keyword%"]);
                return $result->fetchAll();
                }
                else{
                $start = (int)$start;
                $limit = (int)$limit;

                $sql = "SELECT * FROM order_management_view LIMIT $start, $limit";
                $result = $this->model->prepare($sql);
                $result->execute();
                return $result->fetchAll();
            }
        }
        public function TotalOrder($keyword =""){
            if($keyword != ""){
                $sql = "select count(id) from order_management_view where user_name like ?";
                $result = $this->model->prepare($sql);
                $result->execute(["%$keyword%"]);
                return $result->fetchColumn();
            }
            $result = $this->model->query("select count(*) from  order_management_view");
            return $result ->fetchColumn();
        }
        public function getStatus(){
            $result = $this->model->query("select * from order_status order by id asc");
            return $result->fetchAll();
        }
        public function update($id, $status_id){
            $sql = "update orders set status_id = ? where id = ? ";
            $result = $this->model->prepare($sql);
            return $result->execute([$status_id, $id]);
        }

        public function delete ($id){
            $sql = "delete from orders where id = ?";
            $result = $this->model->prepare($sql);
            return $result->execute([$id]);
        }
    }