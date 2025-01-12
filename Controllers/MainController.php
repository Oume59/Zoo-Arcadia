<?php

namespace App\Controllers;

use App\Models\ServicesModel;
use App\Models\ReviewsModel;

// Héritage de Controller
class MainController extends Controller
{
    // Méthode pour afficher page d'accueil
    public function index()
    {
        $servicesModel = new ServicesModel();
        $reviewsModel = new ReviewsModel();

        // Récupération des services
        $services = $servicesModel->findAll();

        // Récupération des avis validés par l'employé
        $validatedReviews = $reviewsModel->getValidatedReviews();

        // Passer les données à la vue
        $this->render("Accueil/index", [
            'services' => $services,
            'validatedReviews' => $validatedReviews // Passe les avis validés à la vue
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

    public function showServicesCards($id)
    {
        $servicesModel = new ServicesModel();

        // Récupère les données du service via son ID
        $service = $servicesModel->find($id);
        if (!$service) {
            // Si aucun service trouvé, renvoie une erreur 404
            http_response_code(404);
            echo "Service introuvable.";
            exit;
        }

        // Rendu de la vue avec les données des services
        $this->render('Accueil/showServicesCards', [
            'service' => $service,
        ]);
    }
}
