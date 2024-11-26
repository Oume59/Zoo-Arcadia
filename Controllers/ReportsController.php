<?php

namespace App\Controllers;

use App\Models\ReportsModel;
use App\Models\AnimauxModel;

class ReportsController extends Controller
{
    // Affiche la liste des rapports vétérinaires avec les animaux liés
    public function index()
    {
        // Récup des rapports avec les infos des animaux
        $reportsModel = new ReportsModel();
        $reports = $reportsModel->getReportsWithAnimals();

        // Récup de la liste des animaux pour le formulaire
        $animauxModel = new AnimauxModel();
        $animals = $animauxModel->findAll();

        // Rendu de la vue avec les DATA
        $this->render('Dashboard/addReports', [
            'reports' => $reports,
            'animals' => $animals
        ]);
    }

    public function addReport()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération et validation des données du formulaire
            $reportsModel = new ReportsModel();
            $reportsModel->hydrate([
                'date_report' => $_POST['date_report'] ?? null,
                'details' => $_POST['details'] ?? null,
                'health_state' => $_POST['health_state'] ?? null,
                'food' => $_POST['food'] ?? null,
                'animal_id' => $_POST['animal_id'] ?? null,
            ])->create();

            // Redirection après l'ajout
            header("Location: /Reports");
            exit;
        }
    }
}
