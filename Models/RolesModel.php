<?php

namespace App\Models;

class RolesModel extends Model
{
    protected $id_roles; // Identifiant du rôle
    protected $role; // Description du role (administrateur, veterinaire ou employe)

    public function __construct() // Définition de la table dans la BDD
    {
        $this->table = "Roles";
    }


    // Récupère la valeur de id_roles
    public function getIdRoles()
    {
        return $this->id_roles;
    }

    // Définit la valeur de id_roles
    public function setIdRoles($id_roles): self
    {
        $this->id_roles = $id_roles;
        return $this;
    }

    // Récupère la valeur de role
    public function getRole()
    {
        return $this->role;
    }

    // Définit la valeur de role
    public function setRole($role): self
    {
        $this->role = $role;
        return $this;
    }
}
