<?php

namespace Controllers;
use Models\Repository\CategorieRepository;
use Models\Repository\UserRepository;

class LoginController{
    public function index(){
        $categories = New CategorieRepository();
        $categorieAll = $categories->createObjectDatabase();
        require_once 'Views/view-login.php';
        if(isset($_POST['validLogin'])){
            if(!empty($_POST['loginMail']) && !empty($_POST['loginPassword'])){
                $userRepository = new UserRepository();
                $result = $userRepository->connectUser(htmlspecialchars($_POST['loginMail']), htmlspecialchars($_POST['loginPassword']));
                if($result['password']){
                    $_SESSION['user'] = $result['user'];
                    $_SESSION['success'] = "Vous êtes bien connecté";
                    echo "<script>window.location='?p=compte'</script>";
                } else {
                    $_SESSION['error'] = "Identifiants incorrects";
                    echo "<script>window.location='?p=login'</script>";
                }
            } else {
                $_SESSION['error'] = "Veuillez remplir tous les champs !";
                echo "<script>window.location='?p=login'</script>";
            }
        }
    }
}