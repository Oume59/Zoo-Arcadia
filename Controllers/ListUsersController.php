<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RolesModel;

class ListUsersController extends Controller
{


    public function list()
    {
        $userModel = new UserModel();
        $users = $userModel->selectAllRole();
        if (isset($_SESSION['id'])) {
            $this->render( // Affiche la vue
                'Dashboard/listUsers',
                [
                    'users' => $users // Envoie la liste cimplète des utilisateurs
                ]
            );
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id); // Récupère un utilisateur spécifique

        $RolesModel = new RolesModel();
        $roles = $RolesModel->findAll(); // Récupère tous les rôles pour le choix dans le formulaire

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel->hydrate($_POST);
            if ($userModel->update($id)) {
                $_SESSION["success_message"] = 'Utilisateur modifié avec succès';
            } else {
                $_SESSION["error_message"] = 'Erreur lors de la modification de l\'utilisateur';
            }
            // Redirection après mise à jour
            header('Location: /Dashboard');
            exit();
        }

        $this->render('Dashboard/editUsers', [
            'user' => $user, // Envoie l'utilisateur à la vue pour édition
            'roles' => $roles // Envoie les rôles à la vue pour le choix du rôle
        ]);
    }

    public function delete($id) // Utiliser la méthode delete pour supp un utilisateur de la BDD
    {
        $userModel = new UserModel();
        $userModel->delete($id); // héritée de Model.php

        // Rediriger vers la liste des utilisateurs après la suppression
        header('Location: /ListUsers/list');
        exit();
    }

    public function update($id) // Traiter la soumission du formulaire de la modif de la liste des utilisateurs
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel();
            $userModel->setIdUsers($id)
                ->setUsername($_POST['username'])
                ->setEmail($_POST['email'])
                ->setId_Role($_POST['role']);

            $userModel->update($id); // Appelle la méthode update héritée de Model

            // Rediriger vers la liste des utilisateurs après la MAJ
            header('Location: /Dashboard/editUsers');
            exit();
        }
    }
}
