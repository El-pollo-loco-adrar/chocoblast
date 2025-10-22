<?php

namespace App\Repository;

use App\Database\MySQL;
use App\Entity\User;

class UserRepository
{
    private \PDO $connexion;

    //Constructeur
    public function __construct()   
    {
        $this->connexion = (new MySQL())->connectBdd();
    }

    //!Méthodes
    //ajouter un utilisateur
    public function saveUser(User $user): void
    {
        // 1. Ecrire la requête SQL
        $request = "INSERT INTO users(firstnamen lastname, email, pseudo, `password`, img_profile, grants, `status`) VALUE(?,?,?,?,?,?,?,?)";

        // 2. Préparation de la requête
        $req = $this->connexion->prepare($request);

        // 3. Assigner les paramètres BindValue
        $req->bindValue(1, $user->getFirstanme(), \PDO::PARAM_STR);
        $req->bindValue(2, $user->getLastname(), \PDO::PARAM_STR);
        $req->bindValue(3, $user->getEmail(), \PDO::PARAM_STR);
        $req->bindValue(4, $user->getPseudo(), \PDO::PARAM_STR);
        $req->bindValue(5, $user->getPassword(), \PDO::PARAM_STR);
        $req->bindValue(6, $user->getImgProfil(), \PDO::PARAM_STR);
        $req->bindValue(7, implode(",", $user->getGrants()), \PDO::PARAM_STR);
        $req->bindValue(8, $user->getStatus(), \PDO::PARAM_BOOL);
        
        // 4. Executer la requête
        $req->execute();
    }
    //Vérifier si utilisateur existe
    //afficher un utilisateur
    //afficher tous les utilisateurs
    //Modifier un utilisateur

}