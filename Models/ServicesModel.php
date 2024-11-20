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

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setImg($img): self
    {
        $this->img = $img;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImg()
    {
        return $this->img;
    }
}
