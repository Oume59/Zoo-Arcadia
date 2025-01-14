<?php

namespace App\Controllers;

use App\Models\ReviewsModel;

class ReviewsController extends Controller
{
    private $reviewsModel;

    public function __construct()
    {
        $this->reviewsModel = new ReviewsModel();
    }

    private function sanitizeInput($data) // Sécurité !!
    {
        // Nettoyage des DATA utilisateur pour éviter les injections + caractères indésirables
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    // ADD avis
    public function addReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nettoyage des entrées USERS
            $pseudo = $this->sanitizeInput($_POST['pseudo']);
            $avis = $this->sanitizeInput($_POST['avis']);
            $note = filter_var($_POST['note'], FILTER_VALIDATE_INT);

            if (empty($pseudo) || empty($avis) || $note === false || $note < 1 || $note > 5) {
                $_SESSION['error_message'] = "Veuillez vérifier vos informations. Tous les champs sont obligatoires et la note doit être comprise entre 1 et 5.";
                header('Location: /#avis');
                exit();
            }

            $this->reviewsModel->createReview([
                'pseudo' => $pseudo,
                'avis' => $avis,
                'note' => $note,
                'validated' => false
            ]);

            // Redirection après ajout
            $_SESSION['success_message'] = "Votre avis a été soumis avec succès. Il est en attente de validation.";
            header('Location: /#avis');
            exit();
        }
    }

    // Afficher les avis en attente (dashboard employé)
    public function pending()
    {
        $pendingReviews = $this->reviewsModel->getPendingReviews();

        $this->render('Dashboard/editReviews', [
            'pendingReviews' => $pendingReviews
        ]);
    }

    // Afficher les avis validés par l'employé
    public function validated()
    {
        $validatedReviews = $this->reviewsModel->getValidatedReviews();

        $this->render('Reviews/validated', [
            'validatedReviews' => $validatedReviews
        ]);
    }

    public function validateReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id && $this->reviewsModel->validateReview($id)) {
                $_SESSION['success_message'] = "L'avis a été validé avec succès.";
            } else {
                $_SESSION['error_message'] = "Une erreur s'est produite lors de la validation.";
            }

            header('Location: /Reviews/pending');
            exit();
        }
    }

    public function deleteReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if ($id && $this->reviewsModel->deleteReview($id)) {
                $_SESSION['success_message'] = "L'avis a été supprimé avec succès.";
            } else {
                $_SESSION['error_message'] = "Une erreur s'est produite lors de la suppression.";
            }

            header('Location: /Reviews/pending');
            exit();
        }
    }

    public function listReviews()
    {
        $validatedReviews = $this->reviewsModel->getValidatedReviews();
        $this->render('Dashboard/listReviews', [
            'validatedReviews' => $validatedReviews,
        ]);
    }

    public function deleteValidatedReview($id)
    {
        // Vérifie si l'ID est valide
        if (!empty($id)) {
            if ($this->reviewsModel->deleteReview($id)) {
                $_SESSION['success_message'] = "Avis supprimé avec succès.";
            } else {
                $_SESSION['error_message'] = "Impossible de supprimer cet avis.";
            }
        } else {
            $_SESSION['error_message'] = "ID invalide.";
        }
        header('Location: /Reviews/listReviews');
        exit();
    }
}
