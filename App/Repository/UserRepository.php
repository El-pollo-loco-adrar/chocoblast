<?php

namespace App\Repository;

use App\Entity\Entity;
use App\Repository\AbstractRepository;
use App\Entity\User;

class UserRepository extends AbstractRepository
{

    //Constructeur
    public function __construct()   
    {
        // parent::__construct();
        $this->setConnexion();
    }

    //!Méthodes
    //ajouter un utilisateur
    public function saveUser(User $user): void
    {
        // 1. Ecrire la requête SQL
        $request = "INSERT INTO users(firstname, lastname, pseudo, email, `password`, img_profile, grants, `status`) VALUE(?,?,?,?,?,?,?,?)";

        // 2. Préparation de la requête
        $req = $this->connexion->prepare($request);

        // 3. Assigner les paramètres BindValue
        $req->bindValue(1, $user->getFirstname(), \PDO::PARAM_STR);
        $req->bindValue(2, $user->getLastname(), \PDO::PARAM_STR);
        $req->bindValue(3, $user->getPseudo(), \PDO::PARAM_STR);
        $req->bindValue(4, $user->getEmail(), \PDO::PARAM_STR);
        $req->bindValue(5, $user->getPassword(), \PDO::PARAM_STR);
        $req->bindValue(6, $user->getimgProfile(), \PDO::PARAM_STR);
        $req->bindValue(7, implode(",", $user->getGrants()), \PDO::PARAM_STR);
        $req->bindValue(8, $user->getStatus(), \PDO::PARAM_BOOL);
        
        // 4. Executer la requête
        $req->execute();
    }

    //afficher un utilisateur
    public function find(int $id): ?Entity
    {
        $request = "SELECT firstname, lastname, pseudo, email, `password`, img_profile, grants, `status` FROM users WHERE id= ?";
        $req = $this->connexion->prepare($request);
        $req->execute([$id]);//bind param
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        if(!$data){
            return null;
        }

        return new User(
            $data['firstname'],
            $data['lastname'],
            $data['pseudo'],
            $data['email'],
            $data['password'],
            $data['img_profile'],
            explode(",", $data['grants']),
            (bool)$data['status']
        );
    }

    //afficher tous les utilisateurs
    public function findAll(): array
    {
        $request = "SELECT firstname, lastname, email, pseudo, img_profile, grants, `status` FROM users";
        $req = $this->connexion->prepare($request);
        $req->execute();
        $datas = $req->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];

        foreach($datas as $data){
            $users[]= new User(
                $data['firstname'],
                $data['lastname'],
                $data['email'],
                $data['pseudo'],
                $data['img_profil'],
                explode(",", $data['grants']),
                (bool)$data['status']
            );
        }
        return $users;
    }
    
    //Modifier un utilisateur
    public function updateLastname(int $id, string $lastname): bool 
    {
        $request = "UPDATE users SET lastname = ? WHERE id =?";
        $req = $this->connexion->prepare($request);
        $req->bindValue(1, $lastname, \PDO::PARAM_STR);
        $req->bindValue(2, $id, \PDO::PARAM_INT);

        return $req->execute();
    }

        //Vérifier si utilisateur existe
    public function emailExist(string $email): bool
    {

        $sql = "SELECT email FROM users WHERE email=? ";

        $req = $this->connexion->prepare($sql);

        $req->bindValue(1, $email, \PDO::PARAM_INT);

        $req->execute();

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        if (empty($data["email"])) {
            return false;
        }

        return true;
    }
        //Récupérer le mdp via l'email
    public function passwordByEmail(string $email){

        $sql = "SELECT `password` FROM users WHERE email=? ";

        $req = $this->connexion->prepare($sql);

        $req->bindValue(1, $email, \PDO::PARAM_INT);

        $req->execute();

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }

    //Récupérer l'utilisateur via l'email
    public function getUserByEmail(string $email): ?array
    {
        $request = "SELECT id, firstname, lastname, email, `password`, grants AS `grant`, pseudo, `status`, img_profile AS imgProfil
        FROM users WHERE email = ?";
        $req = $this->connexion->prepare($request);
        $req->bindValue(1, $email, \PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }
}