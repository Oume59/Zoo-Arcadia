<?php

namespace App\Config;

use MongoDB\Client;
use MongoDB\Database;

class MongoDbConfig
{
    private static ?MongoDbConfig $instance = null;
    private Client $client; // client Mongo (connexion)
    private Database $db; // BDD séléctionnée

    public function __construct() // initialise la connexion et sélectionne la base
    {
        $this->client = $this->connect(); // Appelle la méthode connect pour créer le client MongoDB
        $this->db = $this->client->selectDatabase($_ENV['MONGODB_DB']); // Sélect la BDD définie dans .env
    }

    protected function connect()  // Connect MongoDB via l'URI
    {
        try { 
            return new Client($_ENV['MONGODB_URI']);
        } catch (\Exception $e) {
            die("Erreur de connexion à MongoDB : " . $e->getMessage());
        }
    }

    //Méthode statique pour obtenir l'instance unique de la connexion "PATTERN SINGLETON"
    public static function getInstance(): MongoDbConfig
    {
        if (self::$instance === null) { // si pas d'instance : création
            self::$instance = new MongoDbConfig();
        }
        return self::$instance;
    }

    // permet de récup la BDD connecté pour l'utiliser dans l'app
    public function getDatabase(): Database
    {
        return $this->db;
    }
}
