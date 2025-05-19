<?php

namespace App\Models;

class UserModel extends Model
{
    // Protection des data de la classe grace a l'utilisation des propriétés protected
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $id_role;

    public function __construct() // Définition de la table des utilisateurs
    {
        $this->table = 'Utilisateurs';
    }


    // Récupère tous les roles dispo dans la table 'Roles'
    public function getRoles()
    {
        return $this->req('SELECT * FROM Roles')->fetchAll();
    }

    // Sélectionne toutes les infos des utilisateurs avec leurs roles respectifs
    public function selectAllRole()
    {
        $sql = "
        SELECT
        u.id,
        u.username,
        u.email,
        u.password,
        r.role AS user_role
        FROM
        {$this->table} u
        JOIN
        Roles r ON u.id_role = r.id";
        return $this->req($sql)->fetchAll();
    }

public function searchByEmail(string $email)
{
    $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
    $stmt = $this->req($sql, ['email' => $email]);
    return $stmt->fetch(); // retourne un objet
}

    // Getters et Setters pour les propriétés
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    // Obtient la valeur du nom d'utilisateur
    public function getUsername()
    {
        return $this->username;
    }

    // Définit la valeur du nom d'utilisateur
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    // Obtient la valeur du mot de passe
    public function getPassword()
    {
        return $this->password;
    }

    // Définit la valeur du mot de passe
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    // Obtient la valeur de email
    public function getEmail()
    {
        return $this->email;
    }

    // Définit la valeur de email
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    // Obtient la valeur de l'identifiant du role
    public function getId_Role()
    {
        return $this->id_role;
    }

    // Définit la valeur de l'identifiant du role
    public function setId_Role($id_role): self
    {
        $this->id_role = $id_role;

        return $this;
    }
}
