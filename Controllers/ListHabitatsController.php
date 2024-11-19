<?php

namespace App\Controllers;

use App\Models\HabitatsModel;

class ListHabitatsController extends Controller
{
    public function list()
    {
        $habitatsModel = new HabitatsModel();
        $habitats = $habitatsModel->findAll(); // Récupère tous les habitats

        if (isset($_SESSION['id'])) {
            $this->render(
                'Dashboard/listHabitats',
                [
                    'habitats' => $habitats // Envoie la liste complète des habitats
                ]
            );
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }

    public function edit($id)
    {
        $habitatsModel = new HabitatsModel();
        $habitat = $habitatsModel->find($id); // Récupère un habitat spécifique

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Traitement de l'image si une nouvelle image est uploadée
            $imgPath = $habitat->img; // Garde l'image actuelle par défaut
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

            // Hydratation des données
            $habitatsModel->hydrate([
                'name' => $_POST['name'] ?? $habitat->name,
                'description' => $_POST['description'] ?? $habitat->description,
                'img' => $imgPath
            ]);

            if ($habitatsModel->update($id)) {
                $_SESSION["success_message"] = 'Habitat modifié avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'habitat';
            }

            header('Location: /ListHabitats/list');
            exit();
        }

        // Transmet les données à la vue
        $this->render('Dashboard/editHabitats', [
            'habitat' => $habitat
        ]);
    }

    public function delete($id)
    {
        $habitatsModel = new HabitatsModel();
        $habitatsModel->delete($id); // Supprime un habitat

        // Rediriger vers la liste des habitats après la suppression
        header('Location: /ListHabitats/list');
        exit();
    }

    public function add()
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

                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension;
                } else {
                    $error = "Erreur lors du téléchargement de l'image.";
                }
            }

            // Hydratation des données
            $habitatsModel = new HabitatsModel();
            $habitatsModel->hydrate([
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'img' => $imgPath
            ])->create();

            $_SESSION["success_message"] = 'Habitat ajouté avec succès';
            header("Location: /ListHabitats/list");
            exit;
        }

        $this->render('Dashboard/addHabitats');
    }
}
