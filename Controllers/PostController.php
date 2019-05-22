<?php

namespace Controllers;

use Models\Repository\CategorieRepository;
use Models\Repository\UserRepository;
use Models\Repository\PostRepository;

Class PostController{
    public function index(){
        $categories = New CategorieRepository();
        $posts = New PostRepository();
        $categorieAll = $categories->createObjectDatabase();

        $post = $posts->searchPostId($_GET['post']);
        require_once 'Views/view-post.php';
    }
}