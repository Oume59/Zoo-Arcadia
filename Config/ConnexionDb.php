<?php

namespace App\Config;

use PDO;

class ConnexionDb extends PDO // class hérite de PDO pour gestion BDD (fournit les methodes de connexion sql)
{
    //décla d'une variable statique pour stocker l'insatnce unique de la connexion DB
    private static $instance = null;
    //constructeur privé pour empecher l instanciation direct
    private function __construct()
    {
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME']; // Connexion à la DB avec les variables d'env stockées dans $_ENV
        parent::__construct($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']); // appel au constructeur parent de la class pdo pour la connexion avec les identifiants
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // Définit mode de récup des résultats /default : les données sont retournée sous forme d'obj
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active le mode exception pour la gestion des erreurs SQL, facilite le débogage
    }

    //Méthode statique pour retourner l’unique instance de connexion Pattern Singleton
    public static function getInstance(): self
    {
        if (self::$instance === null) { // vérifie si instance existe
            self::$instance = new self(); //Création de l'instance si n'existe pas
        }
        return self::$instance;
    }
}
