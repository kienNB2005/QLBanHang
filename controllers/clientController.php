<?php 
    require_once './models/category.php';
    require_once './models/genre.php';
    class ClientController{
        private $modelCategory;
        private $modelGenre;
        function __construct(){
            $this->modelCategory = new category();
            $this->modelGenre = new genre();
        }
        public function index(){
            $dataCategory = $this->modelCategory->getAll();
            $dataGenre = $this->modelGenre->getAll();
            include "views/client/home.php";
        }
    }