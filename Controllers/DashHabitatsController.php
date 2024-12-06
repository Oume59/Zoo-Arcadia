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

            // Hydratation et création du nouvel habitat
            $habitatsModel = new HabitatsModel();
            $habitatsModel->hydrate([
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'img' => $imgPath
            ])->create();

            // Redirection après succès
            header("Location: /DashHabitats");
            exit;
        }
    }

    public function edit($id)
    {
        $habitatsModel = new HabitatsModel();
        $habitat = $habitatsModel->find($id); // Récupère l'habitat spécifique

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement de l'image
            $imgPath = $habitat->img; // Conserve l'image actuelle par défaut
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/assets/img/';
                $tmpName = $_FILES['image']['tmp_name'];
                $fileName = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $image = $uploadDir . $fileName . '.' . $fileExtension;

                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension; // Met à jour le chemin de l'image
                }
            }

            // Hydratation des données de l'habitat
            $habitatsModel->hydrate([
                'name' => $_POST['name'] ?? $habitat->name,
                'description' => $_POST['description'] ?? $habitat->description,
                'img' => $imgPath
            ]);

            if ($habitatsModel->update($id)) {
                $_SESSION["success_message"] = 'Habitat modifié avec succès.';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'habitat.';
            }

            // Redirection après mise à jour
            header("Location: /DashHabitats");
            exit();
        }

        // Rendu de la vue avec les données de l'habitat
        $this->render('Dashboard/editHabitats', [
            'habitat' => $habitat
        ]);
    }

    public function delete($id)
    {
        $habitatsModel = new HabitatsModel();
        $habitatsModel->delete($id); // Supprime l'habitat par son ID

        // Redirection après suppression
        header("Location: /DashHabitats");
        exit();
    }
}
