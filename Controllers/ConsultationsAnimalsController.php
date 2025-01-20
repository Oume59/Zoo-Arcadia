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

    // Incrémenter le compteur de views pour un animal
    public function increment($animal)
    {
        $this->consultationsAnimalsModel->incrementViewCount($animal);
        echo json_encode(['message' => "Compteur de '$animal' mis à jour."]);
    }

    // Obtenir les consult par animal donné
    public function getCount($animal)
    {
        $count = $this->consultationsAnimalsModel->getViewCount($animal);
        echo json_encode(['views_consultations' => $count]);
    }

    // Obtenir toutes les consultations (pour le dashboard)
    public function getAllCounts()
    {
        $counts = $this->consultationsAnimalsModel->getAllViewCounts(); // Récupérer les données
        $this->render('Dashboard/consultationsAnimals', ['counts' => $counts]);
    }    
}
