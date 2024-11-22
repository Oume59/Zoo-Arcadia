<?php

namespace App\Controllers;


use Exception;
use App\Models\UserModel;
use App\Models\RolesModel;
use PHPMailer\PHPMailer\PHPMailer;

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

        $userModel = new UserModel();
        $roleModel = new RolesModel();


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

            // Appel du modèle pour l'insertion
            $result = $userModel->create($username, $email, $password, $role);

            // Récup et hydratation des données
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'id_role' => $role
            ];
            $userModel->hydrate($data);
            $userModel->create($data);

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
        header("Location: /Dashboard");
        exit;
    }
    private function sendEmail($to, $subject, $message)
    {
        $mail = new PHPMailer(true);
        try {

            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP de Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'joseoumearcadia@gmail.com';
            $mail->Password = 'MRJNNELSQNEUNLXB';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465; // voir lors du deploiement 587
            $mail->CharSet = "UTF-8";

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
}
