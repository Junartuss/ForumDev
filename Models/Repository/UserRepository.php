<?php

namespace Models\Repository;
use Models\Entity\User;

class UserRepository extends MainRepository{
    public function insertDatabase(User $user){
        $passwordCrypt = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $req = $this->connectDatabase()->prepare('INSERT INTO users(nom, prenom, mail, password, isAdmin) VALUES(:nom, :prenom, :mail, :password, 0)');
        $req->execute(array(
            ':nom' => $user->getNom(),
            ':prenom' => $user->getPrenom(),
            ':mail' => $user->getMail(),
            ':password' => $passwordCrypt
        ));
    }

    public function checkMailUse(User $user){
        $users = $this->findAll("users");
        $result = true;
        foreach($users as $unUser){
            if($unUser['mail'] == $user->getMail()){
                $result = false;
            }
        }
        return $result;
    }

    public function connectUser($mail, $password){
        $array = [];
        $req = $this->connectDatabase()->prepare('SELECT * FROM users WHERE mail = :mail');
        $req->execute(array(':mail' => $mail));
        $result = $req->fetch();

        if(password_verify($password, $result['password'])){
            $array['password'] = true;
            $array['user'] = new User($result['id'], $result['nom'], $result['prenom'], $result['mail'], $password, $result['isAdmin']);
        } else {
            $array['password'] = false;
        }

        return $array;
    }

    public function updateDatabase(User $user){
        $req = $this->connectDatabase()->prepare('UPDATE users SET nom = :nom, prenom = :prenom, mail = :mail WHERE id = :id');
        $req->execute(array(
            ':nom' => $user->getNom(),
            ':prenom' => $user->getPrenom(),
            ':mail' => $user->getMail(),
            ':id' => $user->getId()
        ));
        return $this;
    }

    public function updatePasswordDatabase(User $user){
        $passwordCrypt = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $req = $this->connectDatabase()->prepare('UPDATE users SET password = :password WHERE id = :id');
        $req->execute(array(
            ':password' => $passwordCrypt,
            ':id' => $user->getId()
        ));
        return $this;
    }

    public function deleteDatabase(User $user){
        $req = $this->connectDatabase()->prepare('DELETE FROM users WHERE id = :id');
        $req->execute(array(':id' => $user->getId()));
        return $this;
    }

    public function searchUser($id){
        $req = $this->connectDatabase()->prepare('SELECT * FROM users WHERE id = :id');
        $req->execute(array(':id' => $id));
        $result = $req->fetch();

        $user = new User($result['id'], $result['nom'], $result['prenom'], $result['mail'], $result['password'], $result['isAdmin']);
        return $user;
    }
}