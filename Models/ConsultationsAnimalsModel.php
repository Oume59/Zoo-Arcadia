<?php

namespace App\Models;

use App\Config\MongoDbConfig;

class ConsultationsAnimalsModel
{
    private $collection;

    public function __construct()
    {
        $db = MongoDbConfig::getDatabase(); // Connexion à MongoDB
        $this->collection = $db->selectCollection('consultations_views'); // collection
    }

    // Incrémenter les consultations (clic/animal)
    public function incrementViewCount($animal)
    {
        $this->collection->updateOne(
            ['animals' => $animal], // Rechercher l'animal
            ['$inc' => ['views_consultations' => 1]], // Incrémenter views_consultations
            ['upsert' => true] // Créer le document si l'animal n'existe pas
        );
    }

    // Obtenir nombre de consult pour un animal donné
    public function getViewCount($animal)
    {
        $document = $this->collection->findOne(['animals' => $animal]);
        return $document ? $document['views_consultations'] : 0; // Retourne 0 si aucun résultat
    }

    // Obtenir toutes les stat pour le dashboard
    public function getAllViewCounts()
    {
        $cursor = $this->collection->find([]);
        return iterator_to_array($cursor); // Convertir le curseur MongoDB en tableau
    }
}
