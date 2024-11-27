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
            a.name,
            a.id AS idAnimal
        FROM 
            {$this->table} r
        LEFT JOIN 
            Animals a ON r.animal_id = a.id
        ";
        return $this->req($sql)->fetchAll();
    }

    public function getId() {
        return $this->id;
    }


    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of date_report
     */
    public function getDate_Report() {
        return $this->date_report;
    }

    /**
     * Set the value of date_report
     */
    public function setDate_Report($date_report): self {
        $this->date_report = $date_report;
        return $this;
    }

    /**
     * Get the value of details
     */
    public function getDetails() {
        return $this->details;
    }

    /**
     * Set the value of details
     */
    public function setDetails($details): self {
        $this->details = $details;
        return $this;
    }

    /**
     * Get the value of health_state
     */
    public function getHealth_State() {
        return $this->health_state;
    }

    /**
     * Set the value of health_state
     */
    public function setHealth_State($health_state): self {
        $this->health_state = $health_state;
        return $this;
    }

    /**
     * Get the value of food
     */
    public function getFood() {
        return $this->food;
    }

    /**
     * Set the value of food
     */
    public function setFood($food): self {
        $this->food = $food;
        return $this;
    }

    /**
     * Get the value of animal_id
     */
    public function getAnimal_Id() {
        return $this->animal_id;
    }

    /**
     * Set the value of animal_id
     */
    public function setAnimal_Id($animal_id): self {
        $this->animal_id = $animal_id;
        return $this;
    }
}
