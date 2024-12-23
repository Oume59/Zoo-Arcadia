<?php

namespace App\Controllers;

use App\Models\HabitatsModel;

class HabitatsController extends Controller
{

    public function index()
    {
        // Renvoyer la vue d'Animaux visiteurs
        $this->render("Habitats/index");
    }

    public function showHabitatsCards($id)
    {
        $habitatsModel = new HabitatsModel();
        $habitat = $habitatsModel->find($id); // Récupère les données de l'habitat via son ID

        if (!$habitat) {
            // Si aucun habitat trouvé, renvoie une erreur 404
            http_response_code(404);
            echo "Habitat introuvable.";
            exit;
        }

        // Rendu de la vue avec les données de l'habitat
        $this->render('Habitats/showHabitatsCards', [
            'habitat' => $habitat
        ]);
    }
}
