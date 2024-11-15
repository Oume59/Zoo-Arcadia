<?php

namespace App\Controllers;

use App\Models\AnimauxModel;

class AnimauxController extends Controller
{
    private $animauxModel;

    public function __construct()
    {
        // Initialisation du modèle
        $this->animauxModel = new AnimauxModel();
    }

    public function index()
    {
        // Récupération de la liste des animaux avec leurs espèces et habitats
        $animaux = $this->animauxModel->getAnimalsWithSpeciesAndHabitat();
        $this->render('Dashboard/addAnimaux', ['animaux' => $animaux]);
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

            // Récupération et hydratation des données
            $data = [
                'name' => $_POST['name'] ?? null,
                'health_state' => $_POST['health_state'] ?? null,
                'species_id' => $_POST['species_id'] ?? null,
                'habitat_id' => $_POST['habitat_id'] ?? null,
                'img' => $imgPath
            ];
            $this->animauxModel->hydrate($data)->create();

            // Redirection après succès
            header("Location: /Animaux");
            exit;
        }

        // Chargement de la vue avec les espèces et habitats disponibles pour le formulaire
        $species = $this->animauxModel->getSpecies();
        $habitats = $this->animauxModel->getHabitats();
        $this->render('Dashboard/addAnimaux', [
            'species' => $species,
            'habitats' => $habitats,
            'error' => $error ?? null
        ]);
    }
}
