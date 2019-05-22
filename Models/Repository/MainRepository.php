<?php
namespace Models\Repository;

abstract class MainRepository{

    public function connectDatabase(){
        $db = new \PDO('mysql:host=localhost;dbname=forum;charset=utf8;', 'root', '');
        return $db;
    }

    public function find($table, $id){
        $req = $this->connectDatabase()->prepare('SELECT * FROM ' . $table . ' WHERE id = :id');
        $req->execute(array(
            ':id' => $id
        ));
        $result = $req->fetch();
        return $result;
    }

    public function findAll($table){
        $req = $this->connectDatabase()->prepare('SELECT * FROM ' . $table);
        $req->execute();
        $result = $req->fetchAll();
        return $result;
    }

}