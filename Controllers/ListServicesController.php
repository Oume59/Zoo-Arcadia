<?php

namespace App\Controllers;

use App\Models\ServicesModel;

class ListServicesController extends Controller
{
    public function list()
    {
        $servicesModel = new ServicesModel();
        $services = $servicesModel->findAll();

        if (isset($_SESSION['id'])) {
            $this->render(
                'Dashboard/listServices',
                [
                    'services' => $services // Envoi de la liste des services
                ]
            );
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }

    public function edit($id)
    {
        $servicesModel = new ServicesModel();
        $service = $servicesModel->find($id); // Récupération d'un service spécifique

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Traitement de l'image si upload
            $imgPath = $service->img; // Image actuelle par défaut
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
                    die("Type de fichier non autorisé. Seuls les fichiers JPEG, PNG et GIF sont acceptés.");
                }
                $image = $uploadDir . $fileName . '.' . $fileExtension;

                if (move_uploaded_file($tmpName, $image)) {
                    $imgPath = $fileName . '.' . $fileExtension;
                }
            }

            $data = [
                'id' => $id,
                'name' => $_POST['name'] ?? $service->name,
                'description' => $_POST['description'] ?? $service->description,
                'img' => $imgPath,
            ];

            $servicesModel->hydrate($data);

            if ($servicesModel->update($id, $data)) {
                $_SESSION["success_message"] = 'Service modifié avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification du service';
            }

            header('Location: /ListServices/list');
            exit();
        }

        $this->render('Dashboard/editServices', [
            'service' => $service,
        ]);
    }

    public function delete($id)
    {
        if ($id) {
            $servicesModel = new ServicesModel();
            $result = $servicesModel->delete($id);

            if ($result) {
                $_SESSION['success_message'] = "Le service a été supprimé avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression du service.";
            }
        } else {
            $_SESSION['error_message'] = "Service invalide.";
        }
           // Rediriger vers la liste des services après la suppression
        header('Location: /ListServices/list');
        exit();
    }

    private $servicesModel;

    public function setServicesModel($model)
    {
        $this->servicesModel = $model;
    }
}
