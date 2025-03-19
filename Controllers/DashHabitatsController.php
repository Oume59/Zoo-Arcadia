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

    public function list()
    {
        // Liste des habitats
        $habitatsModel = $this->habitatsModel ?? new HabitatsModel();
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
                // Validation du type MIME (pour + de sécurité côté client + côté serveur)
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $tmpName);
                finfo_close($finfo);

                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($mimeType, $allowedMimeTypes)) {
                    echo "Type de fichier non autorisé. Seuls les fichiers JPEG, PNG et GIF sont acceptés.";
                    exit;
                }

                // Déplacement de l'image vers le dossier cible
                $image = $uploadDir . $fileName . '.' . $fileExtension;
                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension; // Enregistre le nom du fichier
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
            header("Location: /DashHabitats/List");
            exit;
        }
    }

    public function edit($id)
    {
        $habitatsModel = new HabitatsModel();
        $habitat = $habitatsModel->find($id); // Récupère un habitat spécifique

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Traitement de l'image si une nouvelle image est uploadée
            $imgPath = $habitat->img; // Garde l'image actuelle par défaut
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/assets/img/';
                $tmpName = $_FILES['img']['tmp_name'];
                $fileName = pathinfo($_FILES['img']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                // Validation du type MIME (pour + de sécurité côté client + côté serveur)
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $tmpName);
                finfo_close($finfo);

                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($mimeType, $allowedMimeTypes)) {
                    echo "Type de fichier non autorisé. Seuls les fichiers JPEG, PNG et GIF sont acceptés.";
                    exit;
                }

                $image = $uploadDir . $fileName . '.' . $fileExtension;

                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension; // MAJ avec le nouveau chemin d'image
                }
            }

            $data = [
                'id' => $id,
                'name' => $_POST['name'] ?? $habitat->name,
                'description' => $_POST['description'] ?? $habitat->description,
                'commentaire' => $_POST['commentaire'] ?? $habitat->commentaire,
                'img' => $imgPath,
            ];

            $habitatsModel->hydrate($data);

            if ($habitatsModel->update($id, $data)) {
                $_SESSION["success_message"] = 'Habitat modifié avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'habitat';
            }

            header('Location: /DashHabitats/list');
            exit();
        }

        $this->render('Dashboard/editHabitats', [
            'habitat' => $habitat,
        ]);
    }

    public function delete($id)
    {
        if ($id) {
            $habitatsModel = new HabitatsModel();
            $result = $habitatsModel->delete($id);

            if ($result) {
                $_SESSION['success_message'] = "L'habitat a été supprimé avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression de l'habitat.";
            }
        } else {
            $_SESSION['error_message'] = "ID invalide.";
        }

        header('Location: /DashHabitats/list');
        exit();
    }

    private $habitatsModel;

    public function setHabitatsModel($model)
    {
        $this->habitatsModel = $model;
    }
}
