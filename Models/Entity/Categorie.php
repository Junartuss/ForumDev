<?php

namespace Models\Entity;

class Categorie{
    private $id;
    private $name;
    private $created_at;
    private $parent = null;

    public function __construct($id, $name, $created_at, $parent = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->created_at = $created_at;
        $this->parent = $parent;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    public function setCreatedAt($createdAt){
        $this->created_at = $createdAt;
        return $this;
    }

    public function getParent(){
        return $this->parent;
    }

    public function setParent($parent){
        $this->parent = $parent;
        return $this;
    }
}