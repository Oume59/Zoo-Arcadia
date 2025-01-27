<?php

namespace App\Controllers;

use App\Models\LoginUsersModel;

class LoginUsersController extends Controller
{
    // Methode pour afficher le formulaire de connexion
    public function index()
    {
        // $this render = fonction de mon controlleur principal / Affiche la vue User/login (formulaire de connexion)
        $this->render('Connexion/index');
    }

    // Connexion utilisateur
    public function connexion()
    {
        // Vérif de la methode en post
        if ($_SERVER['REQUEST_METHOD'] === 'POST')

            // Nettoyage des entrées utilisateurs
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = "Email non valide";
            header('Location: /LoginUsers');
            exit();
        }

        // Préparation de la requette pour retouver l'email des utilsateurs
        $LoginUsersModel = new LoginUsersModel();
        $user = $LoginUsersModel->recherche($email);

        // Vérif du mot de passe
        if ($user && password_verify($password, $user->password)) {

            // Stockage des infos  dans la session
            $_SESSION['id'] = $user->id;
            $_SESSION['username'] = htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8');
            $_SESSION['email'] = htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8');
            $_SESSION['role'] = htmlspecialchars($user->role, ENT_QUOTES, 'UTF-8');

            // Redirection vers la page du dashboard
            header('Location: /Dashboard');
            exit();
        } else {
            $_SESSION['error_message'] = "Email ou mot de passe incorrect";
            header('Location:/LoginUsers');
            exit();
        }
    }

    // Efface toutes les variables de session pour déconnecter l'utilisateur, puis les redirige vers la page principale (la fonction ne renvoi rien (pas de return))
    public function deconnexion()
    {
        session_unset();

        header("Location: /"); // Cela redirige vers la racine donc vers l'accueil grace au routage
        exit();
    }
}
