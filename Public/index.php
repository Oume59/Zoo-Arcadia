<?php
// Importation des classes nécessaires
use App\Autoloader;
use App\Config\Main;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';
// Charger les variables d'environnement
if (file_exists(__DIR__ . '/../.env')) {
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load(); // Charge les variables d'environnement
}

// Définir une constante avec le dossier racine du projet 
define('ROOT', dirname(__DIR__));

// Importer l'autolader qui va charger automatiquement les classes
require_once ROOT . '/Autoloader.php';
Autoloader::register();

// Instanciation du main routeur principal
$app = new Main();

// START de l'application
$app->start();
