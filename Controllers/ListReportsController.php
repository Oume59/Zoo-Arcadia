<?php

namespace App\Controllers;

use App\Models\ReportsModel;
use App\Models\AnimauxModel;

class ListReportsController extends Controller
{
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

    public function edit($id)
    {
        $reportsModel = new ReportsModel();
        $animauxModel = new AnimauxModel();

        // Récupérer le rapport par ID
        $report = $reportsModel->find($id);
        $animals = $animauxModel->findAll();

        if (!$report) {
            $_SESSION['error_message'] = "Rapport introuvable.";
            header("Location: /ListReports/list");
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
                $reportsModel->hydrate($data);
            // MAJ DES DATA
            if ($reportsModel->update($id, $data)) {
                $_SESSION['success_message'] = "Les modifications ont été enregistrées avec succès.";
                header("Location: /ListReports/list");
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

        header("Location: /ListReports/list");
        exit();
    }
}
