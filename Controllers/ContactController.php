<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    public function index()
    {
        // Affiche le formulaire de contact
        $message = ''; // Message de retour pour la vue
        $this->render('Contact/index', compact('message'));
    }

    public function sendContactMail()
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification du CSRF token
            if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Token CSRF invalide.');
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupération des données du formulaire
                $nom = htmlspecialchars(trim($_POST['nom']));
                $prenom = htmlspecialchars(trim($_POST['prenom']));
                $email = htmlspecialchars(trim($_POST['email']));
                $messageContent = htmlspecialchars(trim($_POST['message']));

                // Validation des champs
                if (empty($nom) || empty($prenom) || empty($email) || empty($messageContent)) {
                    $message = 'Tous les champs sont obligatoires.';
                    $this->render('Contact/index', compact('message'));
                    return;
                }

                // Validation stricte
                if (!preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $nom)) {
                    $message = 'Le nom contient des caractères non autorisés.';
                    $this->render('Contact/index', compact('message'));
                    return;
                }

                if (!preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $prenom)) {
                    $message = 'Le prénom contient des caractères non autorisés.';
                    $this->render('Contact/index', compact('message'));
                    return;
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $message = 'Adresse email non valide.';
                    $this->render('Contact/index', compact('message'));
                    return;
                }

                if (strlen($nom) > 50 || strlen($prenom) > 50) {
                    $message = 'Nom ou prénom trop long. Maximum 50 caractères.';
                    $this->render('Contact/index', compact('message'));
                    return;
                }

                if (strlen($messageContent) > 250) {
                    $message = 'Le message est trop long. Maximum 250 caractères.';
                    $this->render('Contact/index', compact('message'));
                    return;
                }

                // Envoi de l'email via PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Configuration SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'bulmaemployearcadia@gmail.com';
                    $mail->Password = 'mmyrlkqlcfohdjsi'; // À remplacer par un mot de passe d'application sécurisé
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;
                    $mail->CharSet = 'UTF-8';

                    // Configuration de l'expéditeur et du destinataire
                    $mail->setFrom('bulmaemployearcadia@gmail.com', 'Zoo Arcadia - Contact');
                    $mail->addAddress('bulmaemployearcadia@gmail.com', 'Zoo Arcadia');
                    $mail->addReplyTo($email, "$nom $prenom");

                    // Contenu de l'email
                    $mail->isHTML(true);
                    $mail->Subject = 'Nouvelle demande de contact';
                    $mail->Body = "
                    <h3>Nouvelle demande de contact</h3>
                    <p><strong>Nom :</strong> $nom</p>
                    <p><strong>Prénom :</strong> $prenom</p>
                    <p><strong>Email :</strong> $email</p>
                    <p><strong>Message :</strong></p>
                    <p>$messageContent</p>
                ";

                    $mail->send();
                    $message = 'Votre message a été envoyé avec succès.';
                } catch (Exception $e) {
                    $message = "Une erreur est survenue lors de l'envoi de votre message. Erreur : {$mail->ErrorInfo}";
                }
            }

            $this->render('Contact/index', compact('message'));
        }
    }
}
