<?php

namespace App\Controllers;

use App\Models\ReportsModel;
use App\Models\AnimauxModel;

class DashReportsController extends Controller
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

    public function list()
    {
        $reportsModel = new ReportsModel();
        $reports = $reportsModel->getReportsWithAnimals();

        if (isset($_SESSION['id'])) {
            $this->render('Dashboard/listReports', [
                'reports' => $reports,
            ]);
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }

    public function addReport()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reportsModel = new ReportsModel();

            // Vérifier le rôle de l'utilisateur
            if ($_SESSION['role'] === 'veterinaire') {
                // Ajouter un rapport vétérinaire
                $reportsModel->hydrate([
                    'date_report' => $_POST['date_report'] ?? null,
                    'details' => $_POST['details'] ?? null,
                    'health_state' => $_POST['health_state'] ?? null,
                    'food' => $_POST['food'] ?? null,
                    'animal_id' => $_POST['animal_id']

                ])->create();


                $_SESSION['success_message'] = "Le rapport vétérinaire a été ajouté avec succès.";

            } elseif ($_SESSION['role'] === 'employe') {
                // Ajouter une consommation alimentaire
                $reportsModel->hydrate([
                    'animal_id' => $_POST['animal_id'],
                    'daily_food' => $_POST['daily_food'] ?? null,
                    'daily_food_date' => $_POST['daily_food_date'] ?? null,
                    'daily_food_time' => $_POST['daily_food_time'] ?? null
                ])->create();

                $_SESSION['success_message'] = "La consommation alimentaire a été ajoutée avec succès.";
            } else {
                $_SESSION['error_message'] = "Accès non autorisé.";
                header("Location: /Dashboard");
                exit;
            }

            header("Location: /DashReports/list");
            exit;
        }
    }

    public function edit($id)
    {
        $reportsModel = new ReportsModel();
        $animauxModel = new AnimauxModel();

        // Récupérer le rapport par ID
        $report = $reportsModel->find($id);
        $animals = $animauxModel->findAll();

        if (!$report) {
            $_SESSION['error_message'] = "Rapport introuvable.";
            header("Location: /DashReports/list");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mise à jour des champs pour le vétérinaire

            $data = [
                'id' => $id,
                'date_report' => $_POST['date_report'] ?? $report->date_report,
                'details' => $_POST['details'] ?? $report->details,
                'health_state' => $_POST['health_state'] ?? $report->health_state,
                'food' => $_POST['food'] ?? $report->food,
                'animal_id' => $_POST['animal_id'] ?? $report->animal_id,
                'daily_food' => $_POST['daily_food'] ?? $report->daily_food,
                'daily_food_date' => $_POST['daily_food_date'] ?? $report->daily_food_date,
                'daily_food_time' => $_POST['daily_food_time'] ?? $report->daily_food_time,
            ];
            $reportsModel->hydrate($data); // Préparation des données pour la mise à jour
            // MAJ DES DATA dans la bdd
            if ($reportsModel->update($id, $data)) {
                $_SESSION['success_message'] = "Les modifications ont été enregistrées avec succès.";
                header("Location: /DashReports/list");
                exit();
            } else {
                $_SESSION['error_message'] = "Erreur lors de la modification.";
            }
        }

        // RENVOI A VIEW
        $this->render('Dashboard/editReports', [
            'report' => $report,
            'animals' => $animals,
        ]);
    }

    public function delete($id)
    {
        if ($id) {
            $reportsModel = new ReportsModel();
            $result = $reportsModel->delete($id);

            if ($result) {
                $_SESSION['success_message'] = "Le rapport a été supprimé avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression du rapport.";
            }
        } else {
            $_SESSION['error_message'] = "Rapport invalide.";
        }

        header("Location: /DashReports/list");
        exit();
    }

    public function showAnimalReports($id)
    {
        // Récupération des rapports spécifiques à un animal sélectionné
        $reportsModel = new ReportsModel();
        $reports = $reportsModel->getReportsByAnimalId($id);
        // Récupération des informations sur l'animal
        $animauxModel = new AnimauxModel();
        $animal = $animauxModel->find($id);
        
        if (!$animal) {
            http_response_code(404);
            echo "Animal non trouvé.";
            exit;
        }
    
        $this->render('Reports/showAnimalReports', [ // RENVOI à la vue avec les rapports et les informations de l'animal
            'reports' => $reports,
            'animal' => $animal
        ]);
    }    
}
