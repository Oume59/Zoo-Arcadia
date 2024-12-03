<?php

namespace App\Models;

// Les propriétés protégées (protected) signifient que ces variables sont accessibles seulement dans cette classe et ses sous-classes
class LoginUsersModel extends Model
{
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $id_role;


    public function __construct() // Initialise le nom de la table 
    {
        $this->table = "Utilisateurs";
    }

    public function recherche($email) // Rechercher un utilisateur par email
    {
        return $this->req( //MODIF de u.id_users en u.id et r.id_roles en id seul
            "SELECT u.id, u.username, u.email, u.password, r.role 
FROM Utilisateurs u
JOIN Roles r ON u.id_role = r.id
WHERE u.email = :email",
            ["email" => $email]
        )->fetch();
    }

    // Setters pour definir/modifier et Getters pour obtenir :
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getIdRole()
    {
        return $this->id_role;
    }

    public function setIdRole($id_role): self
    {
        $this->id_role = $id_role;
        return $this;
    }
}
