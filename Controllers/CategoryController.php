<?php

namespace Controllers;

use Models\Repository\CategorieRepository;
use Models\Repository\PostRepository;

class CategoryController{
    public function index(){
        $categories = New CategorieRepository();
        $posts = New PostRepository();
        $categorieAll = $categories->createObjectDatabase();

        $listPost = $posts->searchPostCategorie($_GET['category']);


        $categorie = $categories->searchObject($_GET['category']);
        require_once 'Views/view-category.php';
    }
}