<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RolesModel;

class AddUsersController extends Controller
{
    public function index()
    {
        $this->render('Dashboard/addUsers');
    }

    // Methode pour Ajouter un utilisateur
    public function addUsers()
    {
        $UserModel = new UserModel();
        $RolesModel = new RolesModel();
        $Users = $UserModel->findAll();
        $Roles = $RolesModel->findAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? '';

            if (!empty($username) && !empty($email) && !empty($password) && !empty($role)) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error_message'] = "Email non valide";
                    header('Location: /Dashboard/addUsers');
                    exit;
                }
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


                $result = $UserModel->addUsers($username, $email, $hashedPassword, $role);

                if ($result) {
                    $_SESSION['success_message'] = "L'Utilisateur est ajouté avec succès";
                    header('Location: /Dashboard');
                    exit;
                } else {
                    $_SESSION['error_message'] = "Erreur lors de l'ajout de l'utilisateur";
                    header('Location: /Dashboard/addUsers');
                    exit;
                }
            } else {
                $_SESSION['error_message'] = "Tous les champs sont requis !";
                header('Location: /Dashboard/addUsers');
                exit;
            }
        }
    }
}
