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

    public function __construct() // Définition de la table des utilisateurs
    {
        $this->table = 'Utilisateurs';
    }

    // Recherche un role précis en fonction du nom du role fourni
    public function selectionRole($role)
    {
        return $this->req("SELECT id_roles FROM Roles WHERE role = :role", ['role' => $role])->fetch();
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
        u.id_users,
        u.username,
        u.email,
        u.password,
        r.role AS role
        FROM
        {$this->table} u
        JOIN
        Roles r ON u.id_role = r.id_roles";
        return $this->req($sql)->fetchAll();
    }


    // Obtient la valeur de l'identifiant de l'utilisateur
    public function getIdUsers()
    {
        return $this->id_users;
    }

    // Définit la valeur de l'identifiant de l'utilisateur
    public function setIdUsers($id_users): self
    {
        $this->id_users = $id_users;

        return $this;
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
    public function getIdRole()
    {
        return $this->id_role;
    }

    // Définit la valeur de l'identifiant du role
    public function setIdRole($id_role): self
    {
        $this->id_role = $id_role;

        return $this;
    }
}
