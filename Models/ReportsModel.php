<?php

namespace App\Models;

class ReportsModel extends Model
{
    protected $id_report;
    protected $date_report;
    protected $details;
    protected $health_state;
    protected $food;
    protected $animal_name; // Utilisation directe du nom de l'animal

    public function __construct()
    {
        $this->table = "Veterinary_report";
    }

    /**
     * Récupère les rapports vétérinaires avec les informations de l'animal
     */
    public function getReportsWithAnimals()
    {
        $sql = "
            SELECT 
                r.id_report, 
                r.date_report, 
                r.details, 
                r.health_state, 
                r.food, 
                r.animal_name, 
                a.health_state AS current_health_state
            FROM 
                {$this->table} r
            LEFT JOIN 
                Animals a ON r.animal_name = a.name
        ";
        return $this->req($sql)->fetchAll();
    }

    // Setters
    public function setIdReport($id_report)
    {
        $this->id_report = $id_report;
        return $this;
    }

    public function setDateReport($date_report)
    {
        $this->date_report = $date_report;
        return $this;
    }

    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }

    public function setHealthState($health_state)
    {
        $this->health_state = $health_state;
        return $this;
    }

    public function setFood($food)
    {
        $this->food = $food;
        return $this;
    }

    public function setAnimalName($animal_name)
    {
        $this->animal_name = $animal_name;
        return $this;
    }

    // Getters
    public function getIdReport()
    {
        return $this->id_report;
    }

    public function getDateReport()
    {
        return $this->date_report;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function getHealthState()
    {
        return $this->health_state;
    }

    public function getFood()
    {
        return $this->food;
    }

    public function getAnimalName()
    {
        return $this->animal_name;
    }
}
