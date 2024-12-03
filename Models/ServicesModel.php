<?php

namespace App\Models;

class ServicesModel extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $img;

    public function __construct()
    {
        $this->table = "Services";
    }

    // Setters pour definir/modifier et Getters pour obtenir :
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setImg($img): self
    {
        $this->img = $img;
        return $this;
    }

    public function getImg()
    {
        return $this->img;
    }
}
