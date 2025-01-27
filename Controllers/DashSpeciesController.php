<?php

namespace App\Controllers;

use App\Models\SpeciesModel;

class DashSpeciesController extends Controller
{

    public function index()
    {
          // Récupération de la liste des espèces
        $speciesModel = new SpeciesModel();
        $species = $speciesModel->findAll();

        // Rendu de la vue avec la add des espèces
        $this->render('Dashboard/addSpecies', [
            'species' => $species,
        ]);
    }

    public function list()
    {
        // Liste des espèces
        $speciesModel = new SpeciesModel();
        $species = $speciesModel->findAll(); // Récupère toutes les espèces

        if (isset($_SESSION['id'])) {
            $this->render(
                'Dashboard/listSpecies',
                [
                    'species' => $species // Envoi de la liste complète des espèces
                ]
            );
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }

    public function addSpecies()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $speciesModel = new SpeciesModel();
            $speciesModel->hydrate([
                'species' => $_POST['species'] ?? null,
            ])->create();

            $_SESSION['success_message'] = 'Espèce ajoutée avec succès';

            // Redirection après succès
            header("Location: /DashSpecies/list");
            exit();
        }

        $this->render('DashSpecies/addSpecies');
    }

    public function edit($id)
    {
        $speciesModel = new SpeciesModel();
        $species = $speciesModel->find($id); // Récupère une espèce spécifique

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'species' => $_POST['species'] ?? $species->species,
            ];

            $speciesModel->hydrate($data);

            if ($speciesModel->update($id, $data)) {
                $_SESSION["success_message"] = 'Espèce modifiée avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'espèce';
            }

            header('Location: /DashSpecies/list');
            exit();
        }

        $this->render('Dashboard/editSpecies', [
            'species' => $species,
        ]);
    }

    public function delete($id)
    {
        if ($id) {
            $speciesModel = new SpeciesModel();
            $result = $speciesModel->delete($id);

            if ($result) {
                $_SESSION['success_message'] = "L'espèce a été supprimée avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression de l'espèce.";
            }
        } else {
            $_SESSION['error_message'] = "Espèce invalide.";
        }

        header('Location: /DashSpecies/list');
        exit();
    }
}
