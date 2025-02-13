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
    protected $daily_food_date;
    protected $daily_food_time;

    public function __construct()
    {
        $this->table = "Veterinary_report";
    }

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
                r.daily_food_date, 
                r.daily_food_time,
                a.name AS animal_name
            FROM 
                {$this->table} r
            LEFT JOIN 
                Animals a ON r.animal_id = a.id
        ";
        return $this->req($sql)->fetchAll();
    }

    public function getReportsByAnimalId($animal_id)
    {
        $sql = "
            SELECT 
                r.id, 
                r.date_report, 
                r.details, 
                r.health_state,
                r.food,
                r.daily_food,
                r.daily_food_date, 
                r.daily_food_time
            FROM 
                {$this->table} r
            WHERE 
                r.animal_id = :animal_id
        ";
        return $this->req($sql, ['animal_id' => $animal_id])->fetch();
    }

    public function getAllReportsByAnimalId($animal_id)
    {
        $sql = "
            SELECT 
                r.id, 
                r.date_report, 
                r.details, 
                r.health_state,
                r.food,
                r.daily_food,
                r.daily_food_date, 
                r.daily_food_time
            FROM 
                {$this->table} r
            WHERE 
                r.animal_id = :animal_id
        ";
        return $this->req($sql, ['animal_id' => $animal_id])->fetchAll();
    }

    public function getFoodConsumptionsByAnimalId($animal_id)
    {
        $sql = "
            SELECT 
                r.daily_food_date AS date, 
                r.daily_food_time AS time, 
                r.daily_food AS food 
            FROM 
                {$this->table} r
            WHERE 
                r.animal_id = :animal_id 
                AND r.daily_food IS NOT NULL
        ";
        return $this->req($sql, ['animal_id' => $animal_id])->fetchAll();
    }

    // Setters et Getters


    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     */
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

    /**
     * Get the value of daily_food
     */
    public function getDaily_Food() {
        return $this->daily_food;
    }

    /**
     * Set the value of daily_food
     */
    public function setDaily_Food($daily_food): self {
        $this->daily_food = $daily_food;
        return $this;
    }

    /**
     * Get the value of daily_food_date
     */
    public function getDaily_Food_Date() {
        return $this->daily_food_date;
    }

    /**
     * Set the value of daily_food_date
     */
    public function setDaily_Food_Date($daily_food_date): self {
        $this->daily_food_date = $daily_food_date;
        return $this;
    }

    /**
     * Get the value of daily_food_time
     */
    public function getDaily_Food_Time() {
        return $this->daily_food_time;
    }

    /**
     * Set the value of daily_food_time
     */
    public function setDaily_Food_Time($daily_food_time): self {
        $this->daily_food_time = $daily_food_time;
        return $this;
    }
}
