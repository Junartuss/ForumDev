<?php

namespace Models\Repository;
use Models\Entity\Categorie;

class CategorieRepository extends MainRepository{

    public function findAllByParent($id){
        $req = $this->connectDatabase()->prepare('SELECT * FROM sub_categories WHERE id_parent = :id');
        $req->execute(array(':id' => $id));
        $result = $req->fetchAll();
        return $result;
    }

    public function createObjectDatabase(){
        $listeCategorieParent = [];
        $categories = $this->findAll("categories");

        $compteur = 0;
        foreach($categories as $parent){
            $parent = new Categorie($parent['id'], $parent['name'], $parent['created_at']);
            $listeCategorieParent[$compteur]['parent'] = $parent;
            $compteur++;
        }


        foreach($listeCategorieParent as $k => $v){
            $sub_categories = $this->findAllByParent($v['parent']->getId());
            $compteur = 0;
            foreach($sub_categories as $uneCategorie){
                $sub_categorie = new Categorie($uneCategorie['id'], $uneCategorie['name'], $uneCategorie['created_at'], $v['parent']);
                $listeCategorieParent[$k]['enfant'][$compteur] = [];
                array_push($listeCategorieParent[$k]['enfant'][$compteur], $sub_categorie);
                $compteur++;
            }
        }
        return $listeCategorieParent;
    }

    public function searchObject($id){
        $array = $this->createObjectDatabase();
        foreach($array as $parentCategorie){
            foreach($parentCategorie['enfant'] as $sub_category){
                if($sub_category[0]->getId() == $id){
                    return $sub_category[0];
                }
            }
        }
    }

    public function searchSubCategorie($id){
        $req = $this->connectDatabase()->prepare('SELECT * FROM sub_categories WHERE id = :id');
        $req->execute(array(':id' => $id));
        $result = $req->fetch();

        $categ = new Categorie($result['id'], $result['name'], $result['created_at']);
        return $categ;
    }
}