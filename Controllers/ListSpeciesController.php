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
            $speciesModel->hydrate($_POST);
            if ($speciesModel->update($id)) {
                $_SESSION["success_message"] = 'Espèce modifiée avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'espèce';
            }
            // Redirection après mise à jour
            header('Location: /Dashboard');
            exit();
        }

        $this->render('Dashboard/editSpecies', [
            'species' => $species, // Envoie l'espèce à la vue pour édition
        ]);
    }

    public function delete($id) // Utiliser la méthode delete pour supp une espèce de la BDD
    {
        $speciesModel = new SpeciesModel();
        $speciesModel->delete($id); // héritée de Model principal

        // Rediriger vers la liste des espèces après la suppression
        header('Location: /ListSpecies/list');
        exit();
    }

    public function update($id) // Traiter la soumission du formulaire de la modif de la liste des espèces
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $speciesModel = new SpeciesModel();
            $speciesModel->setId($id)
                ->setSpecies($_POST['species'] ?? null); // Vérifie que le champ 'species' est défini
            $speciesModel->update($id); // Appelle la méthode update héritée de Model

            // Rediriger vers la liste des espèces après la MAJ
            header('Location: /Dashboard/editSpecies');
            exit();
        }
    }
}
