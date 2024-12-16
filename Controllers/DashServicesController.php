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
            // Traitement de l'image
            $imgPath = null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../Public/assets/img/';
                $tmpName = $_FILES['img']['tmp_name'];
                $fileName = pathinfo($_FILES['img']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $image = $uploadDir . $fileName . '.' . $fileExtension;

                // Déplacement de l'image
                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension;
                }
            }

            // Hydratation des données et ajout
            $servicesModel = new ServicesModel();
            $servicesModel->hydrate([
                'name' => $_POST['name'] ?? null,
                'description' => $_POST['description'] ?? null,
                'img' => $imgPath
            ])->create();

            // Redirection après succès
            header("Location: /Services");
            exit;
        }
    }
}
