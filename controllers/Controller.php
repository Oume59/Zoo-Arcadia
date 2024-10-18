<?php

namespace App\Controllers;

//Classe abstraite (ne peux instancier directement) "controller" qui sert de base à tous les controleurs
abstract class Controller
{
    //Méthode pour renvoyer/afficher une vue
    public function render(string $file, array $donnees = [])
    {

        //On extrait avec la méthode "extract" le contenu des données dans des variables
        extract($donnees);
        ob_start(); //START la mise en tampon de sortie
        require_once ROOT . "/Views/" . $file . ".php"; //Inclut le fichier de la vue
        $contenu = ob_get_clean(); //récupération du contenu mis en tampon (prend la donee et la garde en mémoire)
        require_once ROOT . "/Views/Default.php"; //Inclut le fichier par defaut qui peut contenir le layout general de l'APP
    }
}
