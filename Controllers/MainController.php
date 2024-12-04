<?php

namespace App\Controllers;

// Héritage de Controller
class MainController extends Controller
{
    // Méthode pour afficher page d'accueil
    public function index()
    {
        // Renvoyer la vue d'accueil services visiteurs
        $this->render("Accueil/index");
    }

    // Méthode pour afficher la vue des visiteurs pour les animaux
    public function animauxVisiteur()
    {
        $this->render("ViewAnimaux/index");
    }
    // Méthode pour afficher la page des habitats
    public function habitatsVisiteurs()
    {
        // Renvoyer la vue Habitats visiteurs
        $this->render("Habitats/index");
    }
}
