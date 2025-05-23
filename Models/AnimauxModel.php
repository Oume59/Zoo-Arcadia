<?php

namespace App\Models;

// Les propriétés protégées (protected) signifient que ces variables sont accessibles uniquement dans cette classe et dans les classes qui en héritent (sous-classes).
class AnimauxModel extends Model
{
    protected $id;
    protected $name;
    protected $species_id;
    protected $habitat_id;
    protected $img;

    public function __construct() // Initialise le nom de la table
    {
        $this->table = "Animals";
    }

    public function getAnimalsWithSpeciesAndHabitat() // Récup tous les animaux avec leurs espèces et habitats associés
    {
        $sql = "
            SELECT 
                a.id, 
                a.name, 
                a.img, 
                s.species AS animal_species, 
                h.name AS habitat_name
            FROM 
                {$this->table} a
            LEFT JOIN 
                Species s ON a.species_id = s.id
            LEFT JOIN 
                Habitats h ON a.habitat_id = h.id
        ";
        return $this->req($sql)->fetchAll();
    }

    // Setters pour modifier et Getters pour lire la valeur :
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSpecies_Id($species_id)
    {
        $this->species_id = $species_id;
        return $this;
    }

    public function getSpecies_Id()
    {
        return $this->species_id;
    }

    public function setHabitat_Id($habitat_id)
    {
        $this->habitat_id = $habitat_id;
        return $this;
    }

    public function getHabitat_Id()
    {
        return $this->habitat_id;
    }

    public function setImg($img)
    {
        $this->img = $img;
        return $this;
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
        $sql = "SELECT id, name AS habitat_name FROM Habitats";
        return $this->req($sql)->fetchAll();
    }

    public function deleteById($id)
    {
        return $this->delete($id);
    }
}
