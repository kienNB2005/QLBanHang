<?php

    require_once "./config/database.php";
    class Payment{
        private $model;
        public function __construct(){
            $this ->model = Database::connect();
        }
    }