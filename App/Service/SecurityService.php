<?php

namespace App\Service;

use App\Repository\UserRepository;

use App\Controller\AbstractController;
use App\Repository\AbstractRepository;
use App\Entity\Entity;
use App\Entity\User;
use App\Tools\StringTools;

class SecurityService
{
    private readonly UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    //Logique métier de la création de compte
    public function addUser(array $post): string {
        
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
                dump('sanitaze');

                //$repo = new UserRepository();
                dump('repo');
                // if($repo->emailExist($email)){
                // dump "<p style='color:red'>❌ Cet email est déjà utilisé.</p>";
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
                dump('add user');
                //Hash mdp
                $user->hashPassword();
                dump('hash password');
                //Valeurs par défaut
                $user->setimgProfile("default.png");
                $user->setGrants(["user"]);
                $user->setStatus(true);

                //Enregistre utilisateur
                $this->userRepository->saveUser($user);
                return "c'est ok";
            }
                return "pas ok";
            }
            // public function registerPage()
        // {
        //     $this->render("register", "Inscription", []);
        // }
        
        
    

    //Logique métier de la connexion
    public function connexion(array $post): string | array {
        //Vérifie les champs
        if(
            isset($_POST['email']) && isset($_POST['password'])
        ) 
        {
            if (empty($_POST['email']) && empty($_POST['password'])){
                return"Données vides";
            }
            //vérifie format mail
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                return "email pas bon";
            }

            //Nettoyer les données
            $email = StringTools::sanitize($_POST['email']);
            $password = StringTools::sanitize($_POST['password']);

            //dump($email);
            //Vérifier si mail est dans bdd
            $emailExist = $this->userRepository->emailExist($email);
            if ($emailExist === false){
                return "Mail introuvable";
            }
            //dump($emailExist);

            //Récup du mdp de l'utilisateur
            $recupPassword = $this->userRepository->passwordByEmail($email);

            //Vérifier correspondance avec mdp dans la bdd
            if (!password_verify($password, $recupPassword['password'])){
                return "❌ Mot de passe incorrect";
            }

            //Récup utilisateur connecté
            $dataUser = $this->userRepository->getUserByEmail($email);
            $_SESSION['id']= $dataUser['id'];
            $_SESSION['lastname']= $dataUser['lastname'];
            $_SESSION['firstname']= $dataUser['firstname'];
            $_SESSION['email']= $dataUser['email'];
            //$_SESSION['password']= $dataUser['password'];
            $_SESSION['grant']= $dataUser['grant'];
            $_SESSION['pseudo']= $dataUser['pseudo'];
            $_SESSION['status']= $dataUser['status'];
            $_SESSION['imgProfil']= $dataUser['imgProfil'];

            header("Location:profil");
            
            //dd($dataUser);
            return $dataUser;
        }
        return'bite';        
    }

    //Logique métier de la déconnexion
    public function deconnexion() {
        session_destroy();
        header("Location:/");
    }
    }
