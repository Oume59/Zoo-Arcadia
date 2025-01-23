<?php

namespace App\Controllers;

use App\Models\SpeciesModel;

class ListSpeciesController extends Controller
{


    public function list()
    {
        $speciesModel = new SpeciesModel();
        $species = $speciesModel->findAll(); // Récupère toutes les espèces
        if (isset($_SESSION['id'])) {
            $this->render( // Affiche la vue
                'Dashboard/listSpecies',
                [
                    'species' => $species // Envoie la liste complète des espèces
                ]
            );
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }

    public function edit($id)
    {
        $speciesModel = new SpeciesModel();
        $species = $speciesModel->find($id); // Récupère une espèce spécifique

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'name' => $_POST['name'] ?? $species->name,
                'description' => $_POST['description'] ?? $species->description,
            ];

            $speciesModel->hydrate($data);

            if ($speciesModel->update($id, $data)) {
                $_SESSION["success_message"] = 'Espèce modifiée avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'espèce';
            }

            header('Location: /ListSpecies/list');
            exit();
        }

        $this->render('Dashboard/editSpecies', [
            'species' => $species,
        ]);
    }

    public function delete($id) // Utiliser la méthode delete pour supp une espèce de la BDD
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
        // Rediriger vers la liste des espèces après la suppression
        header('Location: /ListSpecies/list');
        exit();
    }
}
