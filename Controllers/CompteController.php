<?php

namespace Controllers;
use Models\Repository\CategorieRepository;
use Models\Entity\User;
use Models\Repository\UserRepository;

class CompteController{

    public function index(){
        $categories = New CategorieRepository();
        $user = new UserRepository();
        $categorieAll = $categories->createObjectDatabase();
        require_once 'Views/view-compte.php';

        if(isset($_POST['validEditAccount'])){
            if(!empty($_POST['editAccountNom']) && !empty($_POST['editAccountPrenom']) && !empty($_POST['editAccountMail'])){
                $oldUser = clone $_SESSION['user'];
                $_SESSION['user']->setNom($_POST['editAccountNom']);
                $_SESSION['user']->setPrenom($_POST['editAccountPrenom']);
                $_SESSION['user']->setMail($_POST['editAccountMail']);
                if($user->checkMailUse($_SESSION['user']) == true){
                    $user->updateDatabase($_SESSION['user']);
                    $_SESSION['success'] = "Les informations ont bien été modifié";
                    echo "<script>window.location='?p=compte'</script>";
                } else {
                    $_SESSION['user'] = $oldUser;
                    $_SESSION['error'] = "Le mail est déjà utilisé !";
                    echo "<script>window.location='?p=compte'</script>";
                }
            } else {
                $_SESSION['error'] = "Veuillez remplir tous les champs !";
                echo "<script>window.location='?p=compte'</script>";
            }
        }

        if(isset($_POST['validChangePassword'])){
            if(!empty($_POST['editPasswordOldPassword']) && !empty($_POST['editPasswordNewPassword']) && !empty($_POST['editPasswordConfirmPassword'])){
                if($_POST['editPasswordOldPassword'] == $_SESSION['user']->getPassword()){
                    if($_POST['editPasswordNewPassword'] == $_POST['editPasswordConfirmPassword']){
                        if($_POST['editPasswordNewPassword'] != $_SESSION['user']->getPassword()){
                            $_SESSION['user']->setPassword($_POST['editPasswordNewPassword']);
                            $user->updatePasswordDatabase($_SESSION['user']);
                            $_SESSION['success'] = "Le mot de passe a été changer avec succès";
                            echo "<script>window.location='?p=compte'</script>";
                        } else {
                            $_SESSION['error'] = "Vous ne pouvez pas reprendre le même mot de passe";
                            echo "<script>window.location='?p=compte'</script>";
                        }
                    } else {
                        $_SESSION['error'] = "Les mots de passes ne correspondent pas";
                        echo "<script>window.location='?p=compte'</script>";
                    }
                } else {
                    $_SESSION['error'] = "L'ancien mot de passe ne correspond pas";
                    echo "<script>window.location='?p=compte'</script>";
                }
            } else {
                $_SESSION['error'] = "Veuillez remplir tous les champs !";
                echo "<script>window.location='?p=compte'</script>";
            }
        }
    }

    public function deleteAccount(){
        $user = new UserRepository();
        $user->deleteDatabase($_SESSION['user']);
        unset($_SESSION['user']);
        header('Location: ?p=login');
    }

}