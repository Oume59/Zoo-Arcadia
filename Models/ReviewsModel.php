<?php

namespace App\Models;

use App\Models\MongoModel;

class ReviewsModel extends MongoModel
{
    public function __construct()
    {
        parent::__construct('reviews'); // collection MongoDb 
    }

    // Ajoute un avis avec la date incluse pour une meilleure User Experience
    public function createReview(array $data): string
    {
        // Ajout de la date actuelle 
        $data['date'] = (new \DateTime())->format('Y-m-d');

        // Utilise la méthode 'create' de MongoModel
        return $this->create($data);
    }

    // Récupère tous les avis validés
    public function getValidatedReviews(): array
    {
        return $this->findBy(['validated' => true]);
    }

    // Récupère tous les avis en attente de validation par l'employé
    public function getPendingReviews(): array
    {
        return $this->findBy(['validated' => false]);
    }

    // Valide un avis en fonction de son ID
    public function validateReview(string $id): bool
    {
        return $this->update($id, ['validated' => true]) > 0;
    }

    public function deleteReview(string $id): bool
    {
        return $this->delete($id) > 0;
    }
}
