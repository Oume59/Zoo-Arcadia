<?php

namespace App\Models;

class ReportsModel extends Model
{
    protected $id_report;
    protected $date_report;
    protected $details;
    protected $health_state;
    protected $food;
    protected $animal_id; // Pour faire le lien avec la table Animals

    public function __construct() // Initialise le nom de la table
    {
        $this->table = "Veterinary_report";
    }

    // Récupère les rapports vétos avec les informations de l'animal concerné
    public function getReportsWithAnimals()
    {
        $sql = "
            SELECT 
                r.id_report, 
                r.date_report, 
                r.details, 
                r.health_state, 
                r.food, 
                a.name AS animal_name, 
                a.health_state AS current_health_state
            FROM 
                {$this->table} r
            LEFT JOIN 
                Animals a ON r.animal_id = a.id
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

    public function setAnimalId($animal_id)
    {
        $this->animal_id = $animal_id;
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

    public function getAnimalId()
    {
        return $this->animal_id;
    }
}
