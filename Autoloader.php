<?php

//Utilisation de l'Autoloader pour charger automatiquement les classes nécessaires sa,s avoir à inclure à la mano chaque fichier. 
//Namespace de la classe qui va permettre d'organiser le code et éviter les conflits de noms
namespace App;

class Autoloader
{

    //Méthode statique donc pas besoin de créer une instance de classe pour être appelée + Fonction qui va servir à autoloader les classes lors de leur instanciation. 
    static function register()
    {
        spl_autoload_register([__CLASS__, 'Autoload']);
    }

    //Méthode qui SI elle trouve une classe, elle la charge. SINON, elle affiche un message d'erreur.
    static function Autoload($class)
    {
        $class = str_replace(__NAMESPACE__ . '\\', '', $class); // Const spéciale qui renvoie le nom complet de la classe actuelle y compris le namespace.
        $class = str_replace('\\', '/', $class); //str_replace : fonction qui va remplacer toutes les occurences d'une chaîne par 1 autre dans 1 chaîne de données.
        $file = __DIR__ . '/' . $class . '.php'; //Peux importe où le script est exécuté, la const DIR me donne le chemin vers le dossier du fichier où DIR est utilisé.
        if (file_exists($file)) {
            require_once $file;
        } else {
            echo "Erreur";
        }
    }
}
