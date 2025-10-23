<?php

namespace App\Repository;

use App\Database\MySQL;
use App\Entity\Entity;

abstract class AbstractRepository
{
    //Attibuts pour la protection
    protected \PDO $connexion;

    //Constructeur
    // protected function __construct()
    // {
    //     $this->connexion = (new MySQL())->connectBdd();
    // }

    //Initialisation de la connexion à la BDD
    protected function setConnexion()
    {
        return $this->connexion = (new MySQL())->connectBdd();
    }

    //Methodes
    /**
     * @param int $id ID de l'entité à rechercher
     */
    abstract public function find(int $id):?Entity;
    
    /**
     * @return array<EntityInterface>
     */
    
    abstract public function findAll():array;
}