<?php

namespace Models\Entity;

class User{
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $password;
    private $isAdmin;

    public function __construct($id, $nom, $prenom, $mail, $password, $isAdmin)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getNom(){
        return $this->nom;
    }

    public function setNom($nom){
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
        return $this;
    }

    public function getMail(){
        return $this->mail;
    }

    public function setMail($mail){
        $this->mail  = $mail;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function getIsAdmin(){
        return $this->isAdmin;
    }

    public function setIdAdmin($isAdmin){
        $this->isAdmin = $isAdmin;
        return $this;
    }
}