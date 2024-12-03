<?php

namespace App\Models;

class SpeciesModel extends Model
{
    protected $id;
    protected $species;

    public function __construct()
    {
        $this->table = "Species";
    }

    // Récupère toutes les espèces dispo dans la table 'Species'
    // Setters pour definir/modifier et Getters pour obtenir :
    public function getSpecies()
    {
        return $this->req('SELECT * FROM Species')->fetchAll();
    }

    public function setSpecies($species): self
    {
        $this->species = $species;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }
}
