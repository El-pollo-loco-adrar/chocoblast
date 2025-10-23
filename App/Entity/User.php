<?php

namespace App\Entity;

use App\Entity\Entity;

class User extends Entity
{
    private ?int $id;
    private string $firstname;
    private string $lastname;
    private ?string $pseudo;
    private string $email;
    private string $password;
    private ?string $imgProfile;
    private ?array $grants;
    private ?bool $status;

    //Construct
    public function __construct(
        ?string $firstname = null,
        ?string $lastname= null,
        ?string $email= null,
        ?string $password= null
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->pseudo = null;
        $this->email = $email;
        $this->password = $password;
        $this->imgProfile = null;
        $this->grants = [];
        $this->status = null;
        $this->id = null;
    }

    //Getters et setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getimgProfile()
    {
        return $this->imgProfile;
    }
    public function setimgProfile($imgProfile)
    {
        $this->imgProfile = $imgProfile;
        return $this;
    }

    public function getGrants()
    {
        return $this->grants;
    }
    public function setGrants($grants)
    {
        $this->grants = $grants;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    //Méthodes
    public function hashPassword(): void 
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function verifPassword(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }
}