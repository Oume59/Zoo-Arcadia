<?php

namespace App\Models;

use App\Config\MongoDbConfig; // USE la class de config MongoDB pour se connecter à la BDD
use MongoDB\BSON\ObjectId; // USE type BSON ObjectId pour manipuler les identifiants MongoDB

class MongoModel
{
    protected $collection;

    //Initialise la connexion à la collection MongoDB spécifique
    public function __construct(string $collection)
    {
        $this->collection = MongoDbConfig::getInstance()->getDatabase()->selectCollection($collection);
    }
    // CRUD NO SQL

    public function create(array $data): string
    {
        $result = $this->collection->insertOne($data); // Insère le document dans la collection
        return (string) $result->getInsertedId(); // Retourne l'identifiant du document inséré sous forme de chaîne
    }

    public function find(string $id): ?array
    {
        $result = $this->collection->findOne(['_id' => new ObjectId($id)]); // Recherche par ObjectId
        return $result ? $result->getArrayCopy() : null; // Retourne le doc en tableau PHP ou null si non existant
    }

    //Récupère tous les documents de la collection et liste de tous les doc en tableau PHP.
    public function findAll(): array
    {
        return iterator_to_array($this->collection->find());
    }
    
    public function update(string $id, array $data): int
    {
        $result = $this->collection->updateOne(
            ['_id' => new ObjectId($id)], // ID du doc
            ['$set' => $data] // MAJ les champs spécifiés
        );
        return $result->getModifiedCount(); // Retourne le nombre de documents modifiés
    }

    public function delete(string $id): int
    {
        $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]); // Supprime le document par son identifiant
        return $result->getDeletedCount(); // Retourne le nombre de documents supprimés
    }
}