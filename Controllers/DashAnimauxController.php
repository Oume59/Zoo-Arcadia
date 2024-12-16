<?php

namespace App\Controllers;

use App\Models\AnimauxModel;
use App\Models\HabitatsModel;
use App\Models\SpeciesModel;

class DashAnimauxController extends Controller
{

    public function index()
    {
        // Récupération de la liste des animaux avec leurs espèces et habitats
        $animauxModel = new AnimauxModel();
        $animaux = $animauxModel->findAll();
        $speciesModel = new SpeciesModel();
        $species = $speciesModel->findAll();
        $habitatsModel = new HabitatsModel();
        $habitats = $habitatsModel->findAll();
        $this->render('Dashboard/addAnimaux', [
            'animaux' => $animaux,
            'species' => $species,
            'habitats' => $habitats
        ]);
    }

    public function addAnimal()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement de l'image
            $imgPath = null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../assets/img/';
                $tmpName = $_FILES['img']['tmp_name'];
                $fileName = pathinfo($_FILES['img']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $image = $uploadDir . $fileName . '.' . $fileExtension;

                // Déplacement de l'image vers le dossier cible
                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension;
                } else {
                    $error = "Erreur lors du téléchargement de l'image.";
                }
            }

            // Hydratation et enregistrement des données (hydrate directement en passant les data en arguments)
            $animauxModel = new AnimauxModel();
            $animauxModel->hydrate([
                'name' => $_POST['name'] ?? null,
                'health_state' => $_POST['health_state'] ?? null,
                'species_id' => $_POST['species_id'] ?? null,
                'habitat_id' => $_POST['habitat_id'] ?? null,
                'img' => $imgPath
            ])->create();

            // Redirection après succès
            header("Location: /DashAnimaux");
            exit;
        }
    }
}
