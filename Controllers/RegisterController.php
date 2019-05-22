<?php

namespace Controllers;
use Models\Repository\CategorieRepository;
use Models\Repository\UserRepository;
use Models\Entity\User;


class RegisterController{
    public function index(){
        $categories = New CategorieRepository();
        $categorieAll = $categories->createObjectDatabase();
        require_once 'Views/view-register.php';
        if(isset($_POST['validRegister'])){
            if(!empty($_POST['registerNom']) && !empty($_POST['registerPrenom']) && !empty($_POST['registerMail']) && !empty($_POST['registerPassword']) && !empty($_POST['registerConfirmPassword'])){
                if($_POST['registerPassword'] == $_POST['registerConfirmPassword']){
                    $user = new User(0, htmlspecialchars($_POST['registerNom']), htmlspecialchars($_POST['registerPrenom']), htmlspecialchars($_POST['registerMail']), htmlspecialchars($_POST['registerPassword']), 0);
                    $userReposity = new UserRepository();
                    if($userReposity->checkMailUse($user) == true){
                        $userReposity->insertDatabase($user);
                        $_SESSION['success'] = "Vous êtes bien inscrit, vous pouvez désormais vous connectez !";
                        echo "<script>window.location='?p=login'</script>";
                    } else {
                        $_SESSION['error'] = "Le mail est déjà utilisé !";
                        echo "<script>window.location='?p=register'</script>";
                    }
                } else {
                    $_SESSION['error'] = "Les mots de passes ne correspondent pas !";
                    echo "<script>window.location='?p=register'</script>";
                }
            } else {
                $_SESSION['error'] = "Veuillez remplir tous les champs !";
                echo "<script>window.location='?p=register'</script>";
            }
        }
    }
}