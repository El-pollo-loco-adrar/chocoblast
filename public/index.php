<?php

//Import de l'autoloader



include __DIR__ . "../../vendor/autoload.php";

//Analyse de l'URL avec parse_url() et retourne ses composants
$url = parse_url($_SERVER['REQUEST_URI']);
//test soit l'url a une route sinon on renvoi à la racine
$path = isset($url['path']) ? $url['path'] : '/';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__,'../.env');
$dotenv->load();
//dd($_ENV, $dotenv);

//Appel bdd Test de connexion
// use App\Database\MySQL;
// $bdd = new MySQL();
// $bdd->connectBdd();
//dd($_ENV);


//Import de classe
use App\Controller\HomeController;
use App\Controller\ErrorController;

//Créer des objets controller
$homeController = new HomeController();
$errorController = new ErrorController();

//dd($url, $path);


//ROUTER
switch ($path) {
    case '/':
        $homeController->index();
        break;
    case '/login';
        echo "Login";
        break;
    case "/logout";
        echo 'Deconnexion';
        break;
    case '/chocoblast/add';
        echo 'Ajoute un chocoblast';
        break;
    case '/chocoblast/all';
        echo 'affiche un chocoblast';
        break;
    case '/chocoblast/id';
        echo 'affiche un chocoblast par son ID';
        break;
    case '/chocoblast/update/id';
        echo 'Modifie un chocoblast par son ID';
        break;
    case '/chocoblast/delete/id';
        echo 'Supprime un chocoblast par son ID';
        break;

    default:
        $errorController->error404();
        break;
}