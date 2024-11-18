<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RolesModel;

class AddUsersController extends Controller
{
    public function index()
    {
        // Récupération de la liste des rôles pour affichage dans le for
        $rolesModel = new RolesModel();
        $roles = $rolesModel->findAll();

        $this->render('Dashboard/addUsers', ['roles' => $roles]);
    }


    public function addUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation des données POST
            $username = $_POST['username'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $role_id = $_POST['role'] ?? null;

            // Vérification des champs requis
            if (!$username || !$email || !$password || !$role_id) {
                $_SESSION['error_message'] = "Tous les champs sont requis.";
                header("Location: /Dashboard/addUsers");
                exit;
            }

            // Validation de l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_message'] = "Email non valide.";
                header("Location: /Dashboard/addUsers");
                exit;
            }

            // Hashage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Récup et hydratation des données
            $userModel = new UserModel();
            $userModel->hydrate([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'id_role' => $role_id
            ])->create();

            // Message de succès et redirection
            $_SESSION['success_message'] = "L'utilisateur a été ajouté avec succès.";
            header("Location: /Dashboard");
            exit;
        }

        // En cas d'erreur ou de requête autre que POST
        $_SESSION['error_message'] = "Une erreur s'est produite.";
        header("Location: /Dashboard/addUsers");
        exit;
    }
}
