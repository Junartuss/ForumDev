<?php
define("ROOT_DIR", dirname(__FILE__));
require_once 'Config/autoload.php';

// Appelle des controlleurs
use \Controllers\HomeController;
use \Controllers\CategoryController;
use \Controllers\LoginController;
use \Controllers\RegisterController;
use \Controllers\CompteController;

// Instanciation
$homeController = new HomeController();
$categoryController = new CategoryController();
$loginController = new LoginController();
$registerController = new RegisterController();
$compteController = new CompteController();

session_start();

if(!isset($_GET['p']) || $_GET['p'] == "home"){
    $homeController->index();
} else if($_GET['p'] == "forum"){
    if(isset($_GET['category'])){
        $categoryController->index();
    } else {
        header('Location: ?p=home');
    }
} else if($_GET['p'] == "login"){
    $loginController->index();
} else if($_GET['p'] == "register"){
    $registerController->index();
} else if($_GET['p'] == "compte"){
    if(isset($_SESSION['user'])){
        if(isset($_GET['action'])){
            if($_GET['action'] == "disconnect"){
                unset($_SESSION['user']);
                $_SESSION['error'] = "Vous êtes bien déconnecté";
                header('Location: ?p=login');
            } else if($_GET['action'] == "delete"){
                $compteController->deleteAccount();
            }
        }
        $compteController->index();
    } else {
        header('Location: ?p=home');
    }
}
