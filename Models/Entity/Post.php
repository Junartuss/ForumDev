<?php

namespace Models\Entity;

class Post{
    private $id;
    private $titre;
    private $contenu;
    private $date;
    private $user;
    private $categorie;

    public function __construct($id, $titre, $contenu, $date, $user, $categorie)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->date = $date;
        $this->user = $user;
        $this->categorie = $categorie;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function setTitre($titre){
        $this->titre = $titre;
        return $this;
    }

    public function getContenu(){
        return $this->contenu;
    }

    public function setContenu($contenu){
        $this->contenu = $contenu;
        return $this;
    }

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
        return $this;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    public function getCateg(){
        return $this->categorie;
    }

    public function setCateg($categ){
        $this->categorie = $categ;
        return $this;
    }

    public function getDateFormat(){
        $date = new \DateTime($this->date);
        return $date->format('d/m/Y');
    }
}