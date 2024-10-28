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
    public function connexion()
    {
        //verification de la methode en post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Vérification du token  hash_equals fonciton php comparaison 2 chaines de manière sécurisé evite attaque de timing
            if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                $_SESSION['error_message'] = "Token CSRF invalide.";
                header("Location: /User");
                exit();
            }

            //nettoyage des entrées utilisateurs
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';

            //validation de l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_message'] = "Email non valide";
                exit();
            }

            //préparation de la requette pour retouver l'email des utilsateurs
            $UserModel = new UserModel();
            $user = $UserModel->recherche($email);

            // Vérification du mot de passe
            if ($user && password_verify($password, $user->password)) {

                //regénération de l'id de session
                session_regenerate_id(true);

                // Stockage des informations  dans la session
                $_SESSION['id_users'] = $user->id;
                $_SESSION['username'] = htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8');
                $_SESSION['email'] = htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8');
                $_SESSION['id_role'] = htmlspecialchars($user->id_role, ENT_QUOTES, 'UTF-8');

                //On regénère le token pour la sécurisation des futurs entrées (vétérinaire, employé)
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

                // Redirection vers la page du dashboard
                header("Location: /Dashboard");
                exit();
            } else {
                $_SESSION['error_message'] = "Email ou mot de passe incorrect";
                header("Location:/login");
                exit();
            }
        }
    }
}
