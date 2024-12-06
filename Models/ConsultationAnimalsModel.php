<?php

namespace App\Models;

use App\Config\MongoDbConfig;

class ConsultationModel
{
    private $collection;

    public function __construct()
    {
        $db = MongoDbConfig::getDatabase();
        $this->collection = $db->selectCollection('consultations_clics_animals');
    }

    public function incrementViewCount($animalName)
    {
        $this->collection->updateOne(
            ['name' => $animalName],
            ['$inc' => ['views' => 1]],
            ['upsert' => true] // Crée un document s'il n'existe pas encore
        );
    }

    public function getViewCount($animalName)
    {
        $document = $this->collection->findOne(['name' => $animalName]);

        return $document ? $document['views'] : 0;
    }
}
