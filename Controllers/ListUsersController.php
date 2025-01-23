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
    $user = $userModel->find($id); // Récupère un utilisateur par son ID

    // Vérification si l'utilisateur existe
    if (!$user) {
        $_SESSION["error_message"] = "Utilisateur introuvable.";
        header('Location: /ListUsers/list');
        exit();
    }

    $rolesModel = new RolesModel();
    $roles = $rolesModel->findAll(); // Récupère tous les rôles

    // Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Hydrate les données
        $data = [
            'id' => $id,
            'username' => $_POST['username'] ?? $user->username,
            'email' => $_POST['email'] ?? $user->email,
            'id_role' => $_POST['id_role'] ?? $user->id_role,
        ];

        $userModel->hydrate($data);

        if ($userModel->update($id, $data)) {
            $_SESSION["success_message"] = "Utilisateur modifié avec succès.";
        } else {
            $_SESSION["error_message"] = "Erreur lors de la modification de l'utilisateur.";
        }

        // Redirection après traitement
        header('Location: /ListUsers/list');
        exit();
    }

    // Transmet les données à la vue
    $this->render('Dashboard/editUsers', [
        'user' => $user,
        'roles' => $roles,
    ]);
}


    public function delete($id) // Utiliser la méthode delete pour supp un utilisateur de la BDD
    {
        if ($id) {
            $userModel = new UserModel();
            $result = $userModel->delete($id);

            if ($result) {
                $_SESSION['success_message'] = "L'utilisateur a été supprimé avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression de l'utilisateur.";
            }
        } else {
            $_SESSION['error_message'] = "Utilisateur invalide.";
        }
        // Rediriger vers la liste des utilisateurs après la suppression
        header('Location: /ListUsers/list');
        exit();
    }
}
