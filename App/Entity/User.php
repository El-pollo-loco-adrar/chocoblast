<?php

namespace App\Entity;

class User
{
    private int $id;
    private string $firstanme;
    private string $lastname;
    private ?string $pseudo;
    private string $email;
    private string $password;
    private ?string $imgProfil;
    private ?array $grants;
    private ?bool $status;

    //Construct
    public function __construct(
        string $firstanme,
        string $lastname,
        string $email,
        string $password
    ) {
        $this->firstanme = $firstanme;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
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

    public function getFirstanme()
    {
        return $this->firstanme;
    }
    public function setFirstanme($firstanme)
    {
        $this->firstanme = $firstanme;
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

    public function getImgProfil()
    {
        return $this->imgProfil;
    }
    public function setImgProfil($imgProfil)
    {
        $this->imgProfil = $imgProfil;
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