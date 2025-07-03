<?php

//Namespace de la class qui va permettre d'organiser le code et éviter les conflits de noms
namespace App;

class Autoloader
{

    // Enregistrer l autoloader personnalisé + celui de Composer
    public static function register()
    {
        require_once __DIR__ . "/vendor/autoload.php"; // autoload de Composer
        spl_autoload_register([__CLASS__, 'Autoload']); // si une class inconnue est utilisée, prendre function Autoload pour trouver et inclure son fichier
    }

    //  Charge automatiquement une class du namespace "App" si elle existe SINON erro affiché dans les logs
    public static function Autoload($class)
    {
        if (strpos($class, __NAMESPACE__) === 0) { // Verif si la class appartient au namespace App
            $class = str_replace(__NAMESPACE__ . '\\', '', $class); // Supp "App\" du nom complet de la class
            $class = str_replace('\\', '/', $class); // Remplace \ du namespace en / pour former le chemin du fichier (Controllers/Controller.php)
            $file = __DIR__ . '/' . $class . '.php'; // Construit le chemin vers le bon fichier PHP a partir du nom de classe
            if (file_exists($file)) { // SI fichier existe, on l'inclut SINON log utile pour debug
                require_once $file;
            } else {
                error_log("autoloader error $file");
            }
        }
    }
}
