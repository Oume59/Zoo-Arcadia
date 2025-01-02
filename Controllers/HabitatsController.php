<?php

namespace App\Controllers;

use App\Models\HabitatsModel;
use App\Models\AnimauxModel;
use App\Models\SpeciesModel;

class HabitatsController extends Controller
{

    public function index()
    {
        $habitatsModel = new HabitatsModel();
        $habitats = $habitatsModel->findAll(); // Récupère tous les habitats

        $this->render('Habitats/index', [
            'habitats' => $habitats
        ]);
    }

    public function showHabitatsCards($id)
    {
        $habitatsModel = new HabitatsModel();
        $animauxModel = new AnimauxModel();
        $speciesModel = new SpeciesModel(); // Ajoute une instance de SpeciesModel

        // Récupère les données de l'habitat via son ID
        $habitat = $habitatsModel->find($id);
        if (!$habitat) {
            // Si aucun habitat trouvé, renvoie une erreur 404
            http_response_code(404);
            echo "Habitat introuvable.";
            exit;
        }

        // Récupère les animaux liés à cet habitat
        $animalsInHabitat = $animauxModel->findBy(['habitat_id' => $id]);

        // Récupère toutes les espèces
        $species = $speciesModel->getSpecies();

        // Associe chaque animal à son espèce
        foreach ($animalsInHabitat as &$animal) {
            $animal->species_name = 'Inconnue'; // Valeur par défaut si aucune espèce trouvée
            foreach ($species as $specie) {
                if ($animal->species_id == $specie->id) {
                    $animal->species_name = $specie->species;
                    break;
                }
            }
        }

        // Rendu de la vue avec les données de l'habitat et des animaux
        $this->render('Habitats/showHabitatsCards', [
            'habitat' => $habitat,
            'animals' => $animalsInHabitat
        ]);
    }
}
