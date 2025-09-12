<?php 
    require_once './models/category.php';
    require_once './models/genre.php';
    class ClientController{
        private $modelCategory;
        private $modelGenre;
        function __construct(){
            $this->modelCategory = new categoryController();
            $this->modelGenre = new genreController();
        }
        public function index(){
        }
    }