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

    public function list()
    {
        // Liste des animaux avec leurs espèces et habitats
        $animauxModel = $this->animauxModel ?? new AnimauxModel(); // $this->animauxModel  permet de passer un model personnalisé (mock ou autre (test unitaire)) au lieu de toujours instantanément AnimauxModeldirectement.
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

    public function addAnimal()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement de l'image
            $imgPath = null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/assets/img/'; // Chemin absolu vers le dossier upload
                $tmpName = $_FILES['img']['tmp_name'];
                $fileName = pathinfo($_FILES['img']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

                // Validation du type MIME (pour + de sécurité côté client + côté serveur)
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $tmpName);
                finfo_close($finfo);

                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($mimeType, $allowedMimeTypes)) {
                    // Affiche une erreur OU redirige en cas de type MIME non autorisé
                    echo "Type de fichier non autorisé. Seuls les fichiers JPEG, PNG et GIF sont acceptés.";
                    exit;
                }

                $image = $uploadDir . $fileName . '.' . $fileExtension;
                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension; // MAJ avec le nouveau chemin d'image enregistré
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
            header("Location: /DashAnimaux/list");
            exit;
        }
    }

    public function edit($id)
    {
        $animauxModel = new AnimauxModel();
        $animaux = $animauxModel->find($id); // Récupération d'un animal spécifique
        $species = $animauxModel->getSpecies(); // Récupère les espèces disponibles
        $habitats = $animauxModel->getHabitats(); // Récupère les habitats disponibles

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Traitement de l'image si une nouvelle image est uploadée
            $imgPath = $animaux->img; // Garde l'image actuelle par défaut
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/assets/img/'; // chemin absolu vers le dossier upload
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
                'name' => $_POST['name'] ?? $animaux->name,
                'species_id' => $_POST['species_id'] ?? $animaux->species_id,
                'habitat_id' => $_POST['habitat_id'] ?? $animaux->habitat_id,
                'img' => $imgPath,
            ];

            $animauxModel->hydrate($data);

            if ($animauxModel->update($id, $data)) {
                $_SESSION["success_message"] = 'Animal modifié avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'animal';
            }

            header('Location: /DashAnimaux/list');
            exit();
        }

        $this->render('Dashboard/editAnimaux', [
            'animaux' => $animaux,
            'species' => $species,
            'habitats' => $habitats,
        ]);
    }

    public function delete($id)
    {
        if ($id) {
            $animauxModel = new AnimauxModel();

            $result = $animauxModel->deleteById($id);

            if ($result) {
                $_SESSION['success_message'] = "L'animal a été supprimé avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression de l'animal.";
            }
        } else {
            $_SESSION['error_message'] = "Animal invalide.";
        }

        header("Location: /DashAnimaux/list");
        exit();
    }

    private $animauxModel;

    public function setAnimauxModel($model)
    {
        $this->animauxModel = $model;
    }
}

