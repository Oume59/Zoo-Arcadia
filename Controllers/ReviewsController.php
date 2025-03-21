<?php

namespace App\Controllers;

use App\Models\ReviewsModel;

class ReviewsController extends Controller
{
    private $reviewsModel;

    public function __construct()
    {
        // Initialise le modèle ReviewsModel pour interagir avec la base de données NoSQL (MongoDB)
        $this->reviewsModel = new ReviewsModel();
    }

    private function sanitizeInput($data) // Sécurité !! Sécurise une entrée utilisateur pour éviter les injections XSS et les caractères indésirables.
    {
        // Nettoyage des DATA users pour éviter les injections + caractères indésirables
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    // ADD avis par un visiteur qui est stocké dans la BDD NoSQL et marqué comme non validé par défaut.
    public function addReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des DATA
            $pseudo = $this->sanitizeInput($_POST['pseudo'] ?? '');
            $avis = $this->sanitizeInput($_POST['avis'] ?? '');
            $note = filter_var($_POST['etoiles'] ?? null, FILTER_VALIDATE_INT);

            // Validation des DATA
            if (empty($pseudo) || empty($avis) || $note === null || $note < 1 || $note > 5) {
                header('Location: /#avis');
                exit();
            }

            // Enregistrement review avec le statut non validé
            $this->reviewsModel->createReview([
                'pseudo' => $pseudo,
                'avis' => $avis,
                'note' => $note,
                'validated' => false
            ]);

            header('Location: /#avis'); // Redirection vers la section des avis après soumission
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

    // Change le statut l'avis en validé
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

    // Supprime l'avis de la BDD NoSQL
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

    // Liste des avis VALIDÉS
    public function listReviews()
    {
        $validatedReviews = $this->reviewsModel->getValidatedReviews();
        $this->render('Dashboard/listReviews', [
            'validatedReviews' => $validatedReviews,
        ]);
    }

    // Supprime un avis déjà validé
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
