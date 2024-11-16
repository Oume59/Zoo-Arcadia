<?php

namespace App\Models;

class HabitatsModel extends Model
{
    protected $id;
    protected $name;
    protected $img;
    protected $description;
    
    public function __construct()
    {
        $this->table = "Habitats";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name): self {
        $this->name = $name;
        return $this;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($img): self {
        $this->img = $img;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description): self {
        $this->description = $description;
        return $this;
    }
}