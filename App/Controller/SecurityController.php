<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Service\SecurityService;

class SecurityController extends AbstractController
{
    private readonly SecurityService $securityService;

    public function __construct()
    {
        $this->securityService = new SecurityService();
    }

    //Méthode login (se connecter)
    public function login() {
        if($this->formSubmit($_POST)){
            $message = [];
            $message = $this->securityService->connexion($_POST);
        }
        
        $this->render('login','connexion', [$message??'']);
    }

    public function profil(){
        $this->render('profil', 'profil');
    }

    //Méthode logout (se déconnecter)
    public function logout() {
        
            $this->securityService->deconnexion();
    }

    //Méthode register (créer un compte User)
    public function register() {
        if($this->formSubmit($_POST)){
        $message = $this->securityService->addUser($_POST);
            
        }
        $this->render('register','inscription', [$message??'']);
        
    }
}
