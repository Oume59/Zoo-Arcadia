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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getSpecies()
    {
        return $this->species;
    }

    public function setSpecies($species): self
    {
        $this->species = $species;
        return $this;
    }
}
