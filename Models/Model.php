<?php

namespace App\Models;

use App\Config\ConnexionDb;

class Model extends ConnexionDb
{
    // Table de la base de données
    protected $table;

    // Instance de DB
    private $db;

    // Récupère toutes les entrées de la table
    public function findAll()
    {
        $query = $this->req('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    // Récupère les entrées selon certains critères
    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        // On parcourt (via la boucle) chaque critère pour créer les conditions de la requête
        foreach ($criteres as $champ => $valeur) {
            // SELECT * FROM annonces WHERE id = ? and signale
            //bindValue(1, valeur)
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }
        // Transforme le tableau champ en une chaine de caractères
        $liste_champs = implode(' AND ', $champs);
        // Exécution la requete et renvoie le resultat
        return $this->req(' SELECT * FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs)->fetchAll();
    }

    // Récup une entrée par son identifiant
    public function find(int $id)
    {
        return $this->req("SELECT * FROM {$this->table} WHERE id = $id ")->fetch();
    }


    public function create() // Créer uen nouvelle entrée dans la table (Create du CRUD)
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        // Parcourt les propriétés pour préparer l'insertion
        foreach ($this as $champ => $valeur) {
            // INSERT INTO annonce (titre, description, prix, ...) VALUES (?, ?, ?)
            if ($valeur != null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }

        // Concatène les champs et valeurs pour la requête
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        // Exécution de la requete
        return $this->req('INSERT INTO ' . $this->table . ' (' . $liste_champs . ') VALUES(' . $liste_inter . ')', $valeurs);
    }


    public function update(int $id, array $data)
    {
        $champs = [];
        $valeurs = [];

        foreach ($data as $champ => $valeur) {
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;
        $listChamps = implode(', ', $champs);

        return $this->req('UPDATE ' . $this->table . ' SET ' . $listChamps . ' WHERE id = ?', $valeurs);
    }


    public function delete(int $id) // Supprime une entrée en fonction de son identifiant
    {
        return $this->req("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }


    public function req(string $sql, array $attributs = null) // Exécute une requête SQL avec ou sans paramètres
    {

        $this->db = ConnexionDb::getInstance();


        if ($attributs !== null) {
            // Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            // Requête simple
            return $this->db->query($sql);
        }
    }


    public function hydrate($data) // Remplit les propriétés de l'objet à partir d'un tableau de données en utilisant les méthodes set(si elles existent).
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }
}
