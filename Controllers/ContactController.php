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
            // Récupération des données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $messageContent = $_POST['message'];

            // Validation des champs
            if (empty($nom) || empty($prenom) || empty($email) || empty($messageContent)) {
                echo json_encode(["status" => "error", "message" => 'Tous les champs sont obligatoires.']);
                exit;
            }

            // Validation stricte
            if (!preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $nom)) {
                echo json_encode(["status" => "error", "message" => 'Le nom contient des caractères non autorisés.']);
                exit;
            }

            if (!preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $prenom)) {
                echo json_encode(["status" => "error", "message" => 'Le prénom contient des caractères non autorisés.']);
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(["status" => "error", "message" => 'Adresse email non valide.']);
                exit;
            }

            if (strlen($nom) > 50 || strlen($prenom) > 50) {
                echo json_encode(["status" => "error", "message" => 'Nom ou prénom trop long. Maximum 50 caractères.']);
                exit;
            }

            if (strlen($messageContent) > 250) {
                echo json_encode(["status" => "error", "message" => 'Le message est trop long. Maximum 250 caractères.']);
                exit;
            }

            // Envoi de l'email via PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Configuration SMTP (UTILISER LES DATA DU .ENV)
                $mail->isSMTP();
                $mail->Host = $_ENV['SMTP_CONTACT_HOST'];
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['SMTP_CONTACT_USER'];
                $mail->Password = $_ENV['SMTP_CONTACT_PASS'];
                $mail->SMTPSecure = $_ENV['SMTP_CONTACT_SECURE'];
                $mail->Port = $_ENV['SMTP_CONTACT_PORT'];
                $mail->CharSet = $_ENV['SMTP_CHARSET'];

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
                echo json_encode(["status" => "success", "message" => 'Votre message a été envoyé avec succès.']);
                exit;
            } catch (Exception $e) {
                echo json_encode(["status" => "error", "message" => "Une erreur est survenue lors de l'envoi de votre message. Erreur : {$mail->ErrorInfo}"]);
                exit;
            }
        }

        $this->render('Contact/index', compact('message'));
    }
}
