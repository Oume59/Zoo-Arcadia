<?php

namespace App\Controllers;

use App\Models\AnimauxModel;
use App\Models\ReportsModel;

class AnimauxController extends Controller
{
    public function index()
    {
        $animauxModel = new AnimauxModel();
    $reportsModel = new ReportsModel();

    //Récup tous les animaux avec le nom des espèces et des habitats
    $animaux = $animauxModel->getAnimalsWithSpeciesAndHabitat();

    //Add l'état de santé pour chaque animal 
    foreach ($animaux as $animal) {
        $reports = $reportsModel->getReportsByAnimalId($animal->id);
        $animal->health_state = !empty($reports) ? $reports[0]->health_state : 'Inconnu';
    }

    $this->render("Animaux/index", [
        'animaux' => $animaux
    ]);
    }

    public function viewAnimal($id)
    {
        $animauxModel = new AnimauxModel();
        $animal = $animauxModel->find($id); 

        //Si aucun animal n'est trouvé, afficher une erreur 
        if (!$animal) {
            http_response_code(404);
            echo "Animal non trouvé.";
            exit;
        }

        //vue "viewAnimal" avec les détails de l'animal
        $this->render("Animaux/viewAnimal", [
            'animal' => $animal
        ]);
    }
}
