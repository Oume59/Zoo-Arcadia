<?php

namespace App\Controllers;

use App\Models\ConsultationsAnimalsModel;

class ConsultationsAnimalsController extends Controller

{
    private $consultationsAnimalsModel;

    public function __construct()
    {
        $this->consultationsAnimalsModel = new ConsultationsAnimalsModel();
    }

    // Incrémente le compteur de vues pour un animal spécifique
    public function increment($animal)
    {
        if (empty($animal)) {
            echo json_encode(['error' => "Le nom de l'animal est requis."]);
            return;
        }

        $this->consultationsAnimalsModel->incrementViewCount($animal); // Appel model pour incrémenter le compteur
        // Retourne une réponse JSON pour indiquer le succès de l'opération
        echo json_encode(['message' => "Compteur de '$animal' mis à jour."]);
    }

    //Récupère le nombre de consultations pour un animal donné
    public function getCount($animal)
    {
        if (empty($animal)) {
            echo json_encode(['error' => "Le nom de l'animal est requis."]);
            return;
        }

        // Récupère le compteur depuis le modèle
        $count = $this->consultationsAnimalsModel->getViewCount($animal);
        // Retourne le nombre de consultations
        echo json_encode(['views_consultations' => $count]);
    }

    // Récupère toutes les consultations pour le dashboard
    public function getAllCounts()
    {
        // Récup les données depuis le model
        $counts = $this->consultationsAnimalsModel->getAllViewCounts();

        // Passe les données à la vue pour les afficher dans le tableau de bord
        $this->render('Dashboard/consultationsAnimals', ['counts' => $counts]);
    }
}
