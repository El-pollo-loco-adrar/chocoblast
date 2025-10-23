<?php
namespace App\Controller;

use App\Controller\AbstractController;
use App\Repository\UserRepository;

class HomeController extends AbstractController
{
    // public function index()
    // {
         // Test du repository
    //     $userRepo = new UserRepository();

    //     $result = $userRepo->updateLastname(1, "GrosseBite");
        
    //     if ($result) {
    //         echo "✅ Changement de nom ok<br>";

    //         $updatedUser = $userRepo->find(1);

    //         echo "<pre>";
    //         dd($updatedUser);
    //         echo "</pre>";
    //     } else {
    //         echo "❌ Échec de la mise à jour.";
    //     }

    //     exit; // Empêche le reste du code de s'exécuter
    // }

    // public function __construct()
    // {
    //     $this->userRepository 
    // }
    
    
    public function index()
    {
        $this->render("home", "Accueil", []);
    }
}