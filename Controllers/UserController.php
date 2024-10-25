<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends Controller
{
    // Methode pour afficher le formulaire de connexion
    public function index()
    {
        // Affiche la vue User/login (formulaire de connexion)
        $this->render("Users/userLogin");
    }

    // Ajouter un nouvel utilisateur
    public function addUser()
    {
        // Récup des données envoyées depuis le formulaire (addUsers.php)
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hachage du mot de passe avant de le stocker en BDD
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $UserModel = new UserModel();
        $UserModel->login($username, $email, $hashedPassword);
    }
}
