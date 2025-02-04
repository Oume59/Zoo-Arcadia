<?php

namespace App\Config;

use PDO;

class ConnexionDb extends PDO
{
    //Instance statique de la connexion à la DB
    private static $instance = null;
    //Infos de connexion à la DB
    private function __construct()
    {
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
        parent::__construct($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //Méthode statique pour obtenir l'instance unique de la connexion
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self(); //Création de l'instance si n'existe pas
        }
        return self::$instance;
    }
}
