<?php

namespace App\Config;

use MongoDB\Client;
use MongoDB\Database;

class MongoDbConfig
{
    private static ?MongoDbConfig $instance = null;
    private Client $client;
    private Database $db;

public function __construct(){$this->client = $this->connect();$this->db = $this->client->selectDatabase($_ENV['MONGODB_DB']);}

protected function connect(){
    try {// Connect to MongoDB Atlas via URI
        return new Client($_ENV['MONGODB_URI']);} catch (\Exception $e) {
        die("Erreur de connexion à MongoDB : " . $e->getMessage());}}

public static function getInstance(): MongoDbConfig {
    if (self::$instance === null) {self::$instance = new MongoDbConfig();}
    return self::$instance;}

public function getDatabase(): Database {
    return $this->db;}
}