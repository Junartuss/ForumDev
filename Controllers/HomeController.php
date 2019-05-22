<?php

namespace Controllers;
use Models\Repository\CategorieRepository;

class HomeController{

    public function index(){
        $categories = New CategorieRepository();
        $categorie = $categories->createObjectDatabase();
        require_once 'Views/view-home.php';
    }
}