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
        return parent::create($data);
    }

    // Récupère tous les avis validés
    public function getValidatedReviews(): array
    {
        return $this->collection->find(['validated' => true])->toArray();
    }

    // Récupère tous les avis en attente de validation par l'employé
    public function getPendingReviews(): array
    {
        return $this->collection->find(['validated' => false])->toArray();
    }

    // Valide un avis en fonction de son ID
    public function validateReview(string $id): bool
    {
        $result = $this->collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => ['validated' => true]]
        );
        return $result->getModifiedCount() > 0;
    }

    public function deleteReview(string $id): bool
    {
        $result = $this->collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
        return $result->getDeletedCount() > 0;
    }
}
