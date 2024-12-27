<?php

namespace App\Models;

class ReportsModel extends Model
{
    protected $id;
    protected $date_report;
    protected $details;
    protected $health_state;
    protected $food;
    protected $animal_id;
    protected $daily_food;

    public function __construct()
    {
        $this->table = "Veterinary_report";
    }

    // Récupère les rapports vétérinaires avec toutes les infos nécessaires
    public function getReportsWithAnimals()
    {
        $sql = "
            SELECT 
                r.id, 
                r.date_report, 
                r.details, 
                r.health_state,
                r.food, 
                r.animal_id,
                r.daily_food, 
                a.name AS animal_name
            FROM 
                {$this->table} r
            LEFT JOIN 
                Animals a ON r.animal_id = a.id
        ";
        return $this->req($sql)->fetchAll();
    }

    // Récupérer un rapport par l'ID de l'animal
    public function getReportsByAnimalId($animal_id)
    {
        $sql = "
            SELECT 
                r.id, 
                r.date_report, 
                r.details, 
                r.health_state,
                r.food,
                r.daily_food
            FROM 
                {$this->table} r
            WHERE 
                r.animal_id = :animal_id
        ";
        return $this->req($sql, ['animal_id' => $animal_id])->fetchAll();
    }

    // Setters pour definir/modifier et Getters pour obtenir :
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDate_Report()
    {
        return $this->date_report;
    }

    public function setDate_Report($date_report): self
    {
        $this->date_report = $date_report;
        return $this;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details): self
    {
        $this->details = $details;
        return $this;
    }

    public function getHealth_State()
    {
        return $this->health_state;
    }

    public function setHealth_State($health_state): self
    {
        $this->health_state = $health_state;
        return $this;
    }

    public function getFood()
    {
        return $this->food;
    }

    public function setFood($food): self
    {
        $this->food = $food;
        return $this;
    }

    public function getAnimal_Id()
    {
        return $this->animal_id;
    }

    public function setAnimal_Id($animal_id): self
    {
        $this->animal_id = $animal_id;
        return $this;
    }

    public function getDailyFood()
{
    return $this->daily_food;
}

public function setDailyFood($daily_food): self
{
    $this->daily_food = $daily_food;
    return $this;
}
}
