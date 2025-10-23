<?php
session_start();
//Import de l'autoloader

include __DIR__ . "../../vendor/autoload.php";

//Analyse de l'URL avec parse_url() et retourne ses composants
// $url = parse_url($_SERVER['REQUEST_URI']);
// //test soit l'url a une route sinon on renvoi à la racine
// $path = isset($url['path']) ? $url['path'] : '/';

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
use App\Controller\RegisterController;
use App\Controller\SecurityController;
use App\Service\SecurityService;

$errorController = new ErrorController();

//Bloc router
use Mithridatem\Routing\Route;
use Mithridatem\Routing\Router;
use Mithridatem\Routing\Exception\RouterException;

$router = new Router();

//Ajout des routes
// $router->map(Route::controller('GET', '/', HomeController::class, 'index'));
// $router->map(Route::controller('GET', '/register', RegisterController::class, 'registerPage'));
// $router->map(Route::controller('POST', '/register', RegisterController::class, 'registerPage'));

$router->map(Route::Controller('GET','/', HomeController::class, 'index'));
$router->map(Route::Controller('GET','/register', SecurityController::class, 'register'));
$router->map(Route::Controller('POST','/register', SecurityController::class, 'register'));

$router->map(Route::Controller('GET','/login', SecurityController::class, 'login'));
$router->map(Route::Controller('POST','/login', SecurityController::class, 'login'));

$router->map(Route::Controller('GET','/profil', SecurityController::class, 'profil'));
$router->map(Route::Controller('POST','/profil', SecurityController::class, 'profil'));

$router->map(Route::Controller('GET','/logout', SecurityController::class, 'logout'));
$router->map(Route::Controller('POST','/logout', SecurityController::class, 'logout'));

try{
    $router->dispatch();
}catch(RouterException $e){
    $errorController->error404();
}


//Créer des objets controller
// $homeController = new HomeController();
// $errorController = new ErrorController();
// $registerController = new RegisterController();

//dd($url, $path);

//ROUTER
// switch ($path) {
//     case '/':
//         $homeController->index();
//         break;
//     case '/login';
//         echo "Login";
//         break;
//     case '/register';
//         $registerController->registerPage();
//         //$registerController->register();
//         break;
//     case "/logout";
//         echo 'Deconnexion';
//         break;
//     case '/chocoblast/add';
//         echo 'Ajoute un chocoblast';
//         break;
//     case '/chocoblast/all';
//         echo 'affiche un chocoblast';
//         break;
//     case '/chocoblast/id';
//         echo 'affiche un chocoblast par son ID';
//         break;
//     case '/chocoblast/update/id';
//         echo 'Modifie un chocoblast par son ID';
//         break;
//     case '/chocoblast/delete/id';
//         echo 'Supprime un chocoblast par son ID';
//         break;

//     default:
//         $errorController->error404();
//         break;
// }

//$userRepo = new UserRepository();
// $user = $userRepo->find(1);
// $allUser = $userRepo->findAll();
// echo "<pre>";
// var_dump($allUser);
// echo "</pre>";


// $result = $userRepo->updateLastname(1, "Grosse");
// if($result){
//     echo "Changement de nom ok";

//     $updateUser = $userRepo->find(1);

//     echo "<pre>";
//     DD($updateUser);
//     echo "</pre>";
// } else {
//     echo "❌ Échec de la mise à jour.";
// }
// exit;

