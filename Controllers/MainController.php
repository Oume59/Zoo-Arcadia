<?php

namespace App\Controllers;

use App\Models\ServicesModel;

// Héritage de Controller
class MainController extends Controller
{
    // Méthode pour afficher page d'accueil
    public function index()
    {
        // Renvoyer la vue d'accueil services visiteurs
        $servicesModel = new ServicesModel();
        $services = $servicesModel->findAll(); // Récupération de la liste des services
        $this->render("Accueil/index");
    }
}
