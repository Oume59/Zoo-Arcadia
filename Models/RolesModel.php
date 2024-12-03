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

    // Setters pour definir/modifier et Getters pour obtenir :
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
}
