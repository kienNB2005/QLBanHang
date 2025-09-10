<?php
     require_once "__DIR__ . /../../config/database.php";
    class Dashboard{
        private $modelDashboard;
        public function __construct(){
            $this ->modelDashboard = Database::connect();
        }
        public function TotalProducts (){
            $result = $this ->modelDashboard->query("select count(id) from products");
            return $result ->fetchColumn();
        }
        public function TotalUser (){
            $result = $this->modelDashboard -> query("select count(id) from users ");
            return $result->fetchColumn();
        }
        public function TotalOrder(){
            $result = $this->modelDashboard->query("select count(*) from orders");
            return $result->fetchColumn();
        }
        
    }