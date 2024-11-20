<?php

namespace App\Controllers;

use App\Models\AnimauxModel;
use App\Models\HabitatsModel;
use App\Models\SpeciesModel;

class ListAnimauxController extends Controller
{

    public function list()
    {
        $animauxModel = new AnimauxModel();
        $animaux = $animauxModel->getAnimalsWithSpeciesAndHabitat();
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
        //$speciesModel = new SpeciesModel();
        //$species = $speciesModel->findAll(); // Récupère toutes les espèces

        //$habitatsModel = new HabitatsModel();
        //$habitats = $habitatsModel->findAll(); // Récupère tous les habitats

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Traitement de l'image si une nouvelle image est uploadée
            $imgPath = $animaux->img; // Garde l'image actuelle par défaut
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/assets/img/';
                $tmpName = $_FILES['image']['tmp_name'];
                $fileName = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $image = $uploadDir . $fileName . '.' . $fileExtension;

                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension; // MAJ avec le nouveau chemin d'image
                }
            }

            // Hydratation des DATA
            $animauxModel->hydrate([
                'name' => $_POST['name'] ?? $animaux->name,
                'health_state' => $_POST['health_state'] ?? $animaux->health_state,
                'species_id' => $_POST['species_id'] ?? $animaux->species_id,
                'habitat_id' => $_POST['habitat_id'] ?? $animaux->habitat_id,
                'img' => $imgPath
            ]);

            if ($animauxModel->update($id)) {
                $_SESSION["success_message"] = 'Animal modifié avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'animal';
            }

            header('Location: /ListAnimaux/list');
            exit();
        }

        // Transmet les données à la vue
        $this->render('Dashboard/editAnimaux', [
            'animaux' => $animaux,
            'species' => $species,
            'habitats' => $habitats
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

    public function update($id) // Traiter la soumission du formulaire de la modif de l'animal (MAJ)
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
