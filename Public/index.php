<!-- INDEX PRINCIPAL (point d'entrée de l'App) > charge les classes nécessaires et instancie le routeur principal et démarre le traitement des requêtes -->

<?php
// Importation des classes nécessaires
use App\Autoloader;
use App\Config\Main;
use Dotenv\Dotenv;

// Définir une constante avec le dossier racine du projet 
define('ROOT', dirname(__DIR__));

// Importer l'autolader qui va charger automatiquement les classes
require_once ROOT . '/Autoloader.php';
Autoloader::register();

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load(); // Charge les variables d'environnement

// Instanciation du main routeur principal
$app = new Main();

// START de l'application
$app->start();
