<?php

namespace App\Models;

// Les propriétés protégées (protected) signifient que ces variables sont accessibles uniquement dans cette classe et dans les classes qui en héritent (sous-classes).
class AnimauxModel extends Model
{
    protected $id;
    protected $name;
    protected $health_state;
    protected $species_id;

    // Initialise le nom de la table
    public function __construct()
    {
        $this->table = "Animals";
    }

    public function getAnimalsWithSpecies() // jointure table Animal et Species
    {
        $sql = "
            SELECT 
                a.id, 
                a.name, 
                a.health_state, 
                s.species AS species_name 
            FROM 
                {$this->table} a
            JOIN 
                Species s ON a.species_id = s.id
        ";
        return $this->req($sql)->fetchAll();
    }

    // Méthode pour définir l'espèce de l'animal
    public function setSpecies_Id($species_id)
    {
        $this->species_id = $species_id;
        return $this;
    }

    // Méthode pour définir le nom de l'animal
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    // Méthode pour définir l'état de santé de l'animal
    public function setHealth_State($health_state)
    {
        $this->health_state = $health_state;
        return $this;
    }

    // Méthode pour ajouter un nouvel animal dans la BDD
    public function addAnimal()
    {
        $sql = "INSERT INTO {$this->table} (name, health_state, species_id) VALUES (:name, :health_state, :species_id)";
        return $this->req($sql, [
            'name' => $this->name,
            'health_state' => $this->health_state,
            'species_id' => $this->species_id
        ]);
    }

    // Méthode pour récupérer toutes les espèces dispos dans la table Species
    public function getSpecies()
    {
        $sql = "SELECT id, species FROM Species";
        return $this->req($sql)->fetchAll();
    }
}
