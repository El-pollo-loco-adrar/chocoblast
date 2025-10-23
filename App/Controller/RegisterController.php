<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Repository\AbstractRepository;
use App\Entity\Entity;
use App\Entity\User;
use App\Repository\UserRepository;

class RegisterController extends AbstractController
{
    public function registerForm()
    {
        //$isSubmit =$this->formSubmit($_POST);

        if (!$this->formSubmit($_POST)) {
            $this->render("register", "Inscription");
            return;
        }
        //Vérifie les champs 
        if(
            isset($_POST['firstname']) && !empty($_POST['firstname']) &&
            isset($_POST['lastname']) && !empty($_POST['lastname']) &&
            isset($_POST['email']) && !empty($_POST['email']) &&
            //isset($_POST['pseudo']) && !empty($_POST['pseudo']) &&
            isset($_POST['password']) && !empty($_POST['password'])
        )
            {
                $firstname = htmlspecialchars(trim($_POST['firstname']));
                $lastname  = htmlspecialchars(trim($_POST['lastname']));
                $email     = htmlspecialchars(trim($_POST['email']));
                //$pseudo    = htmlspecialchars(trim($_POST['pseudo']));
                $password  = htmlspecialchars(trim($_POST['password']));
                echo('sanitaze');

                $repo = new UserRepository();
                echo('repo');
                // if($repo->emailExist($email)){
                // echo "<p style='color:red'>❌ Cet email est déjà utilisé.</p>";
                // return;
                // }
                //Créer utilisateur
                $user = new User(
                    $firstname,
                    $lastname,
                    //$pseudo,
                    $email,
                    $password
                );
                echo('add user');
                //Hash mdp
                $user->hashPassword();
                echo('hash password');
                //Valeurs par défaut
                $user->setimgProfile("default.png");
                $user->setGrants(["user"]);
                $user->setStatus(true);

                //Enregistre utilisateur
                $repo->saveUser($user);
                echo " c'est ok";
            }else{
                echo "pas ok";
            }
        }
        // public function registerPage()
        // {
        //     $this->render("register", "Inscription", []);
        // }
}