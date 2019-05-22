<?php

namespace Models\Repository;
use Models\Repository\CategorieRepository;
use Models\Repository\UserRepository;
use Models\Entity\Categorie;
use Models\Entity\User;
use Models\Entity\Post;

class PostRepository extends MainRepository {

    public function createObjectDatabase(){
        $categRepository = new CategorieRepository();
        $userRepository = new UserRepository();

        $listPost = [];
        $posts = $this->findAll('posts');
        foreach ($posts as $post){
            $categ = $categRepository->searchSubCategorie($post['idCategorie']);
            $user = $userRepository->searchUser($post['idUser']);

            $objectPost = new Post($post['id'], $post['titre'], $post['contenu'], $post['date'], $user, $categ);
            array_push($listPost, $objectPost);
        }
        return $listPost;
    }

    public function searchPostCategorie($idCategorie){
        $listPost = $this->createObjectDatabase();
        $result = [];

        foreach ($listPost as $unPost){
            if($unPost->getCateg()->getId() == $idCategorie){
                array_push($result, $unPost);
            }
        }
        return $result;
    }

    public function getNbPostCategorie($idCategorie){
        $req = $this->connectDatabase()->prepare('SELECT COUNT(*) as NbPosts FROM posts WHERE idCategorie = :idCategorie');
        $req->execute(array(':idCategorie' => $idCategorie));
        $result = $req->fetch();

        return $result;
    }

    public function selectLastPostCategorie($idCategorie){
        $listPost = $this->searchPostCategorie($idCategorie);
        return end($listPost);
    }

    public function searchPostId($idPost){
        foreach ($this->createObjectDatabase() as $unPost){
            if($unPost->getId() == $idPost){
                return $unPost;
            }
        }
    }

}