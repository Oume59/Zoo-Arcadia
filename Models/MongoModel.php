<?php

namespace App\Models;

use App\Config\MongoDbConfig; // USE la class de config MongoDB pour se connecter à la BDD
use MongoDB\BSON\ObjectId; // USE type BSON ObjectId pour manipuler les identifiants MongoDB

class MongoModel
{
    protected $collection;

    // Initialisation de la connexion à la collection MongoDB spécifique
    public function __construct(string $collectionName)
    {
        $this->collection = MongoDbConfig::getInstance()->getDatabase()->selectCollection($collectionName);
    }

    // CRUD NOSQL
   
    public function create(array $data): string
    {
        $result = $this->collection->insertOne($data);
        return (string) $result->getInsertedId(); // Retourne l'ID sous forme de chaîne
    }

    public function find(string $id): ?array
    {
        $document = $this->collection->findOne(['_id' => new ObjectId($id)]);
        return $document ? (array) $document : null;
    }

    public function findBy(array $criteres = [], array $options = []): array
    {
        $cursor = $this->collection->find($criteres, $options);
        return iterator_to_array($cursor); // Convertit le résultat en tableau PHP
    }

    public function findAll(): array
    {
        $cursor = $this->collection->find([]);
        return iterator_to_array($cursor);
    }

    public function update(string $id, array $data): int
    {
        $result = $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => $data]
        );
        return $result->getModifiedCount(); // Retourne le nombre de documents modifiés
    }

    public function delete(string $id): int
    {
        $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]);
        return $result->getDeletedCount(); // Retourne le nombre de documents supprimés
    }
}
