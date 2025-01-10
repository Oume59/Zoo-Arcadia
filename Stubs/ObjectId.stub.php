<?php

namespace MongoDB\BSON;

//Class "stub" (bouchon) pour corriger/éviter les erreurs d'intellisense dans les IDE > ObjectId.

final class ObjectId
{
// Constructeur fictif de la classe ObjectId.
    public function __construct(string $id = '')
    {
        // NO CODE HERE ! c'est uniquement pour IntelliSense.
    }

    // Methode magique __toString() appelée automatiquement lorsqu'un objet de type ObjectId (utilisé comme une string)
    public function __toString(): string
    {
        // RETURN une valeur (exemple, fictif) pour éviter les erreurs dans les IDE.
        return '507f1f77bcf86cd799439011';
    }

    // Methode pour convertir un objet ObjectId en JSON 
    public function jsonSerialize(): string
    {
        // RETURN une valeur fictive en string
        return '507f1f77bcf86cd799439011'; 
    }
}
