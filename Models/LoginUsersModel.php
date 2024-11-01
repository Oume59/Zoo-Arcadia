<?php

namespace App\Models;

// Les propriétés protégées (protected) signifient que ces variables sont accessibles seulement dans cette classe et ses sous-classes
class LoginUsersModel extends Model
{
    protected $id_users;
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
        return $this->req(
            "SELECT u.id_users, u.username, u.email, u.password, r.role
FROM Utilisateurs u
JOIN Roles r ON u.id_role = r.id_roles
WHERE u.email = :email",
            ["email" => $email]
        )->fetch();
    }


    // Obtenir la valeur de id_users
    public function getIdUsers()
    {
        return $this->id_users;
    }

    // Modifier la valeur de id_users
    public function setIdUsers($id_users): self
    {
        $this->id_users = $id_users;
        return $this;
    }

    // Obtenir la valeur de username
    public function getUsername()
    {
        return $this->username;
    }

    // Modifier la valeur de username
    public function setUsername($username): self
    {
        $this->username = $username;
        return $this;
    }

    // Obtenir la valeur de password
    public function getPassword()
    {
        return $this->password;
    }

    // Modifier la valeur de password
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    // Obtenir la valeur de email
    public function getEmail()
    {
        return $this->email;
    }

    // Modifier la valeur de email
    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    // Obtenir la valeur de id_role
    public function getIdRole()
    {
        return $this->id_role;
    }

    // Modifier la valeur de id_role
    public function setIdRole($id_role): self
    {
        $this->id_role = $id_role;
        return $this;
    }
}
