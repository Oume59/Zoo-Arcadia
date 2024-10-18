<?php

namespace App\Models;

use App\Config\ConnexionDb;

class Model
{
    //Table de la base de données liée au model
    protected $table;

    //Instance de connexion à la DB
    private $db;

    //Méthode qui récupère toutes les données de ma table
    public function findAll()
    {
        $query = $this->req("SELECT * FROM  {$this->table}");
        return $query->fetchAll();
    }

    //Méthode qui exécute une requête SQL avec des paramètres (pour trouver des élements basés sur des critères spécifiques > exemple un ID)
    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        //Boucle pour parcourir des critères fournis afin de construire la requête SQL
        foreach ($criteres as $champ => $valeur) {
            //Sécurisation des paramètres avec des placeholders
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }
        //Transformation du tableau de critères "champs" en une STRING
        $liste_champs = implode(' AND ', $champs);
        //Exécution de la requete et retourne des resultats
        return $this->req(' SELECT * FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs)->fetchAll();
    }

    //Méthode pour trouver un élément spécifique par son Id
    public function find(int $id)
    {
        //Utilisation d'une requête préparée pour éviter les injections SQL
        return $this->req("SELECT * FROM {$this->table} WHERE id = $id ")->fetch(); //Execution de la requête pour récup Id
    }

    //Méthode pour créer un nouvel élément dans la DB
    public function create()
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        //Boucle pour parcourir les propriétés de l'object pour préparer la requête INSERT
        foreach ($this as $champ => $valeur) {
            if ($valeur != null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ; //Colonnes de la table
                $inter[] = "?"; //Valeurs ajoutées + tard pour éviter injection SQL (placeholders)
                $valeurs[] = $valeur; //Valeurs à ajouter
            }
        }

        //Transformation des tableaux en STRING pour construire les parties de la requête SQL (colonnes et valeurs)
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        //Exécution de la requete INSERT 
        return $this->req("INSERT INTO {$this->table} ({$liste_champs}) VALUES ({$liste_inter})", $valeurs);
    }

    //Méthode pour mettre à jour un élément éxistant dans la DB
    public function update(int $id)
    {
        $champs = [];
        $valeurs = [];

        //Boucle afin de parcourir les propriétés de l'objet pour préparer les colonnes à mettre à jour 
        foreach ($this as $champ => $valeur) {
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }

        $valeurs[] = $id; //Ajout Id pour condition WHERE

        //Construction de la chaîne de colonnes et valeurs à mettre à jour
        $liste_champs = implode(', ', $champs);

        //Exécution de la requete
        return $this->req("UPDATE {$this->table} SET {$liste_champs} WHERE id = ?", $valeurs);
    }

    //Méthode pour supprimer un élément de la DB par son Id (avec une requête préparée)
    public function delete(int $id)
    {
        return $this->req("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    //Méthode pour executer une requête SQL avec des paramètres (pour éviter injection SQL) + la fonction va instancier ma connexion DB
    public function req(string $sql, array $attributs = null)
    {
        if ($this->db === null) { //Si connexion BDD non faite, on récupère
            $this->db = ConnexionDb::getInstance();
        }

        if ($attributs !== null) {
            //Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            //SINON Requête simple
            return $this->db->query($sql);
        }
    }

    //Méthode pour hydrater un objet avec les données fournies + Boucle pour associer des valeurs à des propriétés via des setter
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) { // Parcours des data pour appeler le setter qui correspond à chaque clé
            //Construction du nom du setter en fonction de la clé
            $setter = 'set' . ucfirst($key);

            //Si le setter existe dans l'objet, on l'appelle avec la valeur correspondante
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }
}
