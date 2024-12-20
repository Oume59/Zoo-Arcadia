<?php

namespace App\Controllers;

use App\Models\HabitatsModel;

class DashHabitatsController extends Controller
{
    public function index()
    {
        // Récupération de la liste des habitats
        $habitatsModel = new HabitatsModel();
        $habitats = $habitatsModel->findAll();

        // Rendu de la vue avec les habitats
        $this->render('Dashboard/addHabitats', [
            'habitats' => $habitats
        ]);
    }

    public function addHabitat()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement de l'image
            $imgPath = null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/assets/img/';
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

            // Hydratation et création du nouvel habitat
            $habitatsModel = new HabitatsModel();
            $habitatsModel->hydrate([
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'img' => $imgPath
            ])->create();

            // Redirection après succès
            header("Location: /ListHabitats/List");
            exit;
        }
    }
}
