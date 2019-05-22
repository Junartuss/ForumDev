<?php

namespace Models\Repository;
use Models\Repository\CategorieRepository;
use Models\Repository\UserRepository;
use Models\Entity\Categorie;
use Models\Entity\User;

class PostRepository extends MainRepository {

    public function createObjectDatabase(){
        $categRepository = new CategorieRepository();
        $userRepository = new UserRepository();

        $listPost = [];
        $posts = $this->findAll('posts');
        foreach ($posts as $post){
            $categ = $categRepository->searchSubCategorie($post['idCategorie']);
            $user = $userRepository->searchUser($post['idUser']);
        }

        return $user;
    }

}