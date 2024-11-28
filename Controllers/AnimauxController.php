<?php

namespace App\Controllers;

use App\Models\AnimauxModel;
use App\Models\HabitatsModel;
use App\Models\SpeciesModel;

class AnimauxController extends Controller
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
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/assets/img/';
                $tmpName = $_FILES['image']['tmp_name'];
                $fileName = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $image = $uploadDir . $fileName . '.' . $fileExtension;

                // Déplacement de l'image vers le dossier cible
                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension;
                } else {
                    $error = "Erreur lors du téléchargement de l'image.";
                }
            }

            // Récupération et hydratation des données (hydrate directement en passant les data en arguments)
            $animauxModel = new AnimauxModel();
            $animauxModel->hydrate([
                'name' => $_POST['name'] ?? null,
                'health_state' => $_POST['health_state'] ?? null,
                'species_id' => $_POST['species_id'] ?? null,
                'habitat_id' => $_POST['habitat_id'] ?? null,
                'img' => $imgPath
            ])->create();

            // Redirection après succès
            header("Location: /Animaux");
            exit;
        }
    }

    private $animauxModel;
    public function setAnimauxModel(AnimauxModel $model): void //méthode pour test unitaire (le controller utilise le mock(version similée du Model Animaux))
{
    $this->animauxModel = $model;
}
}
