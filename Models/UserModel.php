<?php

namespace App\Models;

class UserModel extends Model
{
    // Protection des data de la classe grace a l'utilisation des propriétés privées
    private $id_users;
    private $username;
    private $password;
    private $email;
    private $id_role;

    public function __construct()
    {
        $this->table = 'Utilisateurs';
    }

    // Methode connexion utilisateurs + insertion des infos utilisateur dans la BDD
    public function login()
    {
        return $this->req("INSERT INTO Utilisateurs (username, email, password, id_role) VALUES (:username, :email, :password, :id_role)");
    }

    public function recherche($email)
    {
        return $this->req(
            "SELECT u.id_users, u.username, u.email, u.password, r.label
    FROM Utilisateurs u
    JOIN Roles r ON u.id_role = r.id
    WHERE u.email = :email",
            ["email" => $email]
        )->fetch();
    }

    // Methode de récup de la valeur id_users
    public function getIdUsers()
    {
        return $this->id_users;
    }

    // Methode qui définie de la valeur id_users
    public function setIdUsers($id_users): self
    {
        $this->id_users = $id_users;

        return $this;
    }

    // Methode qui récup la valeur de username
    public function getUsername()
    {
        return $this->username;
    }

    // Methode qui définie la valeur de username
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    // Methode de récup de la valeur du MDP
    public function getPassword()
    {
        return $this->password;
    }

    // Methode qui définie la valeur du MDP
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    // Methode de récup de la valeur email
    public function getEmail()
    {
        return $this->email;
    }

    // Methode qui définie la valeur email
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    // Methode de récup de la valeur id_role
    public function getIdRole()
    {
        return $this->id_role;
    }

    // Methode qui définie la valeur id_role
    public function setIdRole($id_role): self
    {
        $this->id_role = $id_role;

        return $this;
    }
}
