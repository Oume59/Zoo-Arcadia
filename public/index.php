//INDEX PRINCIPAL (point d'entrée de l'App) > charge les classes nécessaires et instancie le routeur principal et démarre le traitement des requêtes

<?php
//Importation des classes nécessaires
use App\Autoloader;
use App\Config\Main;

//Définir une constante avec le dossier racine du projet 
define('ROOT', dirname(__DIR__));

//Importer l'autolader qui va charger automatiquement les classes
require_once ROOT . '/Autoloader.php';
Autoloader::register();

//Instanciation du main(routeur principal)
$app = new Main;

//START de l'application
$app->start();
