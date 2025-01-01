<?php

namespace App\Controllers;

use App\Models\ServicesModel;

// Héritage de Controller
class MainController extends Controller
{
    // Méthode pour afficher page d'accueil
    public function index()
    {
        $servicesModel = new ServicesModel();
        $services = $servicesModel->findAll(); // Récupération de la liste des services
        $this->render("Accueil/index", [
            'services' => $services // Passage de la variable à la vue
        ]);
    }

    public function accueil()
    {
        $servicesModel = new ServicesModel();
        $services = $servicesModel->findAll(); // Récupère tous les services
    
        $this->render('accueil', [
            'services' => $services // Renvoi à la vue
        ]);
    }
}
