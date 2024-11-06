<?php

namespace App\Models;

class RolesModel extends Model
{
    protected $id; // Identifiant du rôle
    protected $role; // Description du role (administrateur, veterinaire ou employe)

    public function __construct() // Définition de la table dans la BDD
    {
        $this->table = "Roles";
    }

    // Getter pour l'ID
    public function getId()
    {
        return $this->id;
    }

    // Setter pour l'ID
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    // Getter pour le rôle
    public function getRole()
    {
        return $this->role;
    }

    // Setter pour le rôle
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
}
