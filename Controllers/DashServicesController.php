<?php

namespace App\Controllers;

use App\Models\ServicesModel;

class DashServicesController extends Controller
{
    public function index()
    {
        // Récupération de la liste des services
        $servicesModel = new ServicesModel();
        $services = $servicesModel->findAll();

        // Rendu de la vue pour ajouter un service
        $this->render('Dashboard/addServices', [
            'services' => $services
        ]);
    }

    public function addService()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imgPath = null; // Initialisation pour éviter les erreurs
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/assets/img/'; // Chemin absolu vers le dossier upload
                $tmpName = $_FILES['img']['tmp_name'];
                $fileName = pathinfo($_FILES['img']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $image = $uploadDir . $fileName . '.' . $fileExtension;
    
                // Déplacement de l'image
                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = 'assets/img/' . $fileName . '.' . $fileExtension; // Chemin relatif pour la BDD
                }
            }

            // Hydratation des données et ajout
            $servicesModel = new ServicesModel();
            $servicesModel->hydrate([
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'img' => $imgPath
            ])->create();

            $_SESSION['success_message'] = 'Service ajouté avec succès';
            // Redirection après succès
            header("Location: /ListServices/List");
            exit;
        }
        $this->render('Dashboard/addServices');
    }
}
