<?php

namespace App\Models;

// Les propriétés protégées (protected) signifient que ces variables sont accessibles uniquement dans cette classe et dans les classes qui en héritent (sous-classes).
class AnimauxModel extends Model
{
    protected $id;
    protected $name;
    protected $health_state;
    protected $species_id;
    protected $habitat_id;
    protected $img;

    public function __construct() // Initialise le nom de la table
    {
        $this->table = "Animals";
    }

    // Setters pour definir
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


    public function setHealth_State($health_state)
    {
        $this->health_state = $health_state;
        return $this;
    }

    public function setSpecies_Id($species_id)
    {
        $this->species_id = $species_id;
        return $this;
    }

    public function setHabitat_Id($habitat_id)
    {
        $this->habitat_id = $habitat_id;
        return $this;
    }

    public function setImg($img)
    {
        $this->img = $img;
        return $this;
    }

    // Getters pour obtenir
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHealth_State()
    {
        return $this->health_state;
    }

    public function getSpecies_Id()
    {
        return $this->species_id;
    }

    public function getHabitat_Id()
    {
        return $this->habitat_id;
    }

    public function getImg()
    {
        return $this->img;
    }

    // Méthode pour récupérer toutes les espèces disponibles dans la table Species
    public function getSpecies()
    {
        $sql = "SELECT id, species AS animal_species FROM Species";
        return $this->req($sql)->fetchAll();
    }

    // Méthode pour récupérer tous les habitats disponibles dans la table Habitats
    public function getHabitats()
    {
        $sql = "SELECT id, name FROM Habitats";
        return $this->req($sql)->fetchAll();
    }
}
