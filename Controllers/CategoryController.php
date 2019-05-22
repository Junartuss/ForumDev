<?php

namespace Controllers;

use Models\Repository\CategorieRepository;
use Models\Repository\PostRepository;

class CategoryController{
    public function index(){
        $categories = New CategorieRepository();
        $posts = New PostRepository();
        $categorieAll = $categories->createObjectDatabase();
        $postsAll = $posts->createObjectDatabase();
        var_dump($postsAll);
        $categorie = $categories->searchObject($_GET['category']);
        require_once 'Views/view-category.php';
    }
}