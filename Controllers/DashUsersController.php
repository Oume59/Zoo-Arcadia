<?php

namespace App\Controllers;

use Exception;
use App\Models\UserModel;
use App\Models\RolesModel;
use PHPMailer\PHPMailer\PHPMailer;

class DashUsersController extends Controller
{
    public function index()
    {
        // Récupération de la liste des rôles pour affichage dans le formuliare
        $rolesModel = new RolesModel();
        $roles = $rolesModel->findAll();

        $this->render('Dashboard/addUsers', ['roles' => $roles]);
    }

    public function list()
    {
        $userModel = new UserModel();
        $users = $userModel->selectAllRole();
        if (isset($_SESSION['id'])) {
            // Affiche la vue avec la liste des utilisateurs
            $this->render('Dashboard/listUsers', ['users' => $users]);  // Envoie la liste cimplète des utilisateurs
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }

    public function addUsers()
    {

        $userModel = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation des données POST
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            // Vérification des champs requis
            if (empty($username) || empty($email) || empty($password) || empty($role)) {
                $_SESSION['error_message'] = "Tous les champs sont requis.";
                header("Location: /addUsers");
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
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'id_role' => $role
            ];
            $userModel->hydrate($data);
            $result = $userModel->create($data); // Appel du modèle pour l'insertion

            if ($result) {
                // Envoi de l'email à l'utilisateur (sans le mot de passe)
                $clientSubject = "Votre compte a été créé";
                $clientMessage = "Bonjour $username,\n\n";
                $clientMessage .= "Votre compte STAFF Zoo Arcadia a été créé avec succès. Vous pouvez maintenant vous connecter avec votre email : $email.\n";
                $clientMessage .= "Veuillez vous rapprocher de la Direction pour obtenir votre mot de passe .";

                // Envoi de l'email
                if ($this->sendEmail($email, $clientSubject, $clientMessage)) {
                    $_SESSION['success_message'] = "Utilisateur ajouté et email envoyé avec succès.";
                } else {
                    $_SESSION['error_message'] = "Utilisateur ajouté, mais l'email n'a pas pu être envoyé.";
                }
            } else {
                $_SESSION['error_message'] = "Erreur lors de l'ajout de l'utilisateur.";
            }
        } else {
            $_SESSION['error_message'] = "Tous les champs sont requis.";
        }
        // Redirection après ajout
        header("Location: /DashUsers/list");
        exit;
    }

    private function sendEmail($to, $subject, $message)
    {
        $mail = new PHPMailer(true);
        try {

            // Configuration du serveur SMTP (UTILISER LES DATA DU .ENV)
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_USERS_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERS_USER'];
            $mail->Password = $_ENV['SMTP_USERS_PASS'];
            $mail->SMTPSecure = $_ENV['SMTP_USERS_SECURE'];
            $mail->Port = $_ENV['SMTP_USERS_PORT'];
            $mail->CharSet = $_ENV['SMTP_CHARSET'];

            // Utiliser une adresse email valide
            $mail->setFrom("joseoumearcadia@gmail.com", "ZOO ARCADIA");
            $mail->addAddress($to);

            // Contenu de l'email
            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Envoyer l'email
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Erreur lors de l'envoi de l'email : " . $mail->ErrorInfo);
            return false;
        }
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id); // Récupère un utilisateur par son ID

        // Vérification si l'utilisateur existe
        if (!$user) {
            $_SESSION["error_message"] = "Utilisateur introuvable.";
            header("Location: /DashUsers/list");
            exit();
        }

        $rolesModel = new RolesModel();
        $roles = $rolesModel->findAll(); // Récupère tous les rôles

        // Traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Hydrate les données
            $data = [
                'id' => $id,
                'username' => $_POST['username'] ?? '',
                'email' => $_POST['email'] ?? '',
                'id_role' => $_POST['id_role'] ?? '',
            ];

            $userModel->hydrate($data);

            if ($userModel->update($id, $data)) {
                $_SESSION["success_message"] = "Utilisateur modifié avec succès.";
            } else {
                $_SESSION["error_message"] = "Erreur lors de la modification de l'utilisateur.";
            }

            // Redirection après traitement
            header("Location: /DashUsers/list");
            exit();
        }

        // Transmet les données à la vue
        $this->render('Dashboard/editUsers', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function delete($id)
    {
        // Utiliser la méthode delete pour supprimer un utilisateur de la BDD
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
        header("Location: /DashUsers/list");
        exit();
    }
}
