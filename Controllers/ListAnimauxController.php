<?php

namespace App\Controllers;

use App\Models\AnimauxModel;

class ListAnimauxController extends Controller
{

    public function list()
    {
        $animauxModel = new AnimauxModel();
        $animaux = $animauxModel->findAll();
        if (isset($_SESSION['id'])) {
            $this->render(
                'Dashboard/listAnimaux',
                [
                    'animaux' => $animaux // envoi la liste complète des animaux
                ]
            );
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }
    public function edit($id)
    {
        $animauxModel = new AnimauxModel();
        $animaux = $animauxModel->find($id); // Récupère un animal spécifique
        $species = $animauxModel->getSpecies(); // Récupère toutes les espèces
        $habitats = $animauxModel->getHabitats(); // Récupère tous les habitats
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $animauxModel->hydrate($_POST);
            if ($animauxModel->update($id)) {
                $_SESSION["success_message"] = 'Animal modifié avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'animal';
            }
            header('Location: /ListAnimaux/list');
            exit();
        }
    
        $this->render('Dashboard/editAnimaux', [
            'animaux' => $animaux,
            'species' => $species, // Transmet les espèces à la vue
            'habitats' => $habitats, // Transmet les habitats à la vue
        ]);
    }

    public function delete($id) // Utiliser la méthode delete pour supp un animal de la BDD
    {
        $animauxModel = new AnimauxModel();
        $animauxModel->delete($id); // héritée de Model principal

        // Rediriger vers la liste des animaux après la suppression
        header('Location: /ListAnimaux/list');
        exit();
    }

    public function update($id) // Traiter la soumission du formulaire de la modif de la animal (MAJ)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $animauxModel = new AnimauxModel();
            $animauxModel->setId($id)
            ->setName($_POST['name'] ?? null) 
                ->setHealth_State($_POST['health_state'] ?? null) 
                ->setSpecies_Id($_POST['species_id'] ?? null) 
                ->setHabitat_Id($_POST['habitat_id'] ?? null) 
                ->setImg($_POST['img'] ?? null);
            
            if ($animauxModel->update($id)) { // Appelle la méthode update héritée de Model
                $_SESSION["success_message"] = 'Animal mis à jour avec succès.';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la mise à jour de l\'animal.';

            // Rediriger vers la liste des espèces après la MAJ
            header('Location: /Dashboard/editAnimaux');
            exit();
        }
    }
}
}